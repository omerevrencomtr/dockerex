<?php

namespace App\Http\Controllers\Dashboard\User\Balance\Local;

use App\Http\Controllers\Auth\TwoStepVerificationController;
use App\Http\Controllers\System\SystemController;
use App\Http\Requests\Dashboard\Balance\Verify\DashboardBalanceVerifyConfirmWithdrawRequest;
use App\Http\Requests\Dashboard\Balance\Verify\DashboardBalanceVerifyWithdrawRequest;
use App\Models\Bank\Bank;
use App\Models\Currency\Currency;
use App\Models\Currency\CurrencyTransferAddress;
use App\Models\Currency\CurrencyTransferCommission;
use App\Models\User\UserBalance;
use App\Models\User\UserCurrencyTransferOrder;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserBalanceLocalController extends Controller
{
    protected $user;


    public function withdrawCancel(Request $request)
    {
        $user = Auth::user();
        $userCurrencyTransferOrder = UserCurrencyTransferOrder::where('direction', 'withdraw')->where('user_id', $user->id)->where('id', $request->id)->where('status', 'waiting')->where('crypto', false)->first();

        if (!$userCurrencyTransferOrder) {
            return response()->json(['errors' => ['Bu işlemi iptal edemezsiniz']], 422);
        }

        if ($userCurrencyTransferOrder->admin_id != null) {
            return response()->json(['errors' => ['İşlem yönetici tarafından beklemeye alındı']], 422);
        }
        $userCurrencyTransferOrder->status = 'processed';
        $userCurrencyTransferOrder->description = 'İşlem kullanıcı tarafından iptal edildi.';
        $userCurrencyTransferOrder->save();


        $userBalance = UserBalance::where('user_id', $userCurrencyTransferOrder->user_id)->where('currency_id', $userCurrencyTransferOrder->currency_id)->first();
        $userBalance->balance = $userCurrencyTransferOrder->amount + $userBalance->balance;
        $userBalance->save();

        if (!$userBalance) {
            return response()->json(['errors' => ['Destek birimleri ile irtibata geçin']], 422);
        }
        return response()->json(['message' => 'İşlem iptal edildi'], 200);
    }

    public function getHistory(Request $request)
    {
        $user = Auth::user();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = 'created_at';
        $dir = 'DESC';

        $posts = User::where('id', $user->id)
            ->select('id')
            ->first()
            ->userBalanceLocalHistory()
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $totalFiltered = User::where('id', $user->id)
            ->select('id')
            ->first()
            ->userBalanceLocalHistory()
            ->count();

        $data = array();

        if ($posts) {

            foreach ($posts as $r) {
                $nestedData = array();
                $nestedData[] = $r->created_at->format('d.m.Y H:i:s');
                $nestedData[] = $r->currency->name;

                if ($r->direction == 'withdraw') {
                    $nestedData[] = 'Çekme';
                } else {
                    $nestedData[] = 'Yatırma';
                }
                $nestedData[] = '<a target="_blank" href="' . $r->currency->address_url . $r->address . '">' . $r->address . '</a>';
                $nestedData[] = '<a target="_blank" href="' . $r->currency->tx_url . $r->transfer_code . '">' . $r->transfer_code . '</a>';
                $nestedData[] = $r->amount;
                $nestedData[] = $r->commission;
                $nestedData[] = $r->amount - $r->commission;
                $nestedData[] = $r->description;
                $data[] = $nestedData;
            }
        }


        return response()->json([
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalFiltered),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data]
            , 200);
    }


    public function getPending(Request $request)
    {

        $user = Auth::user();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = 'created_at';
        $dir = 'DESC';

        $posts = User::where('id', $user->id)
            ->select('id')
            ->first()
            ->userBalanceLocalPending()
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $totalFiltered = User::where('id', $user->id)
            ->select('id')
            ->first()
            ->userBalanceLocalPending()
            ->count();

        $data = array();

        if ($posts) {

            foreach ($posts as $r) {
                $nestedData = array();
                $nestedData[] = $r->created_at->format('d.m.Y H:i:s');
                $nestedData[] = $r->currency->name;

                if ($r->direction == 'withdraw') {
                    $nestedData[] = 'Çekme';
                } else {
                    $nestedData[] = 'Yatırma';
                }
                $nestedData[] = '<a target="_blank" href="' . $r->currency->address_url . $r->address . '">' . $r->address . '</a>';
                $nestedData[] = '<a target="_blank" href="' . $r->currency->tx_url . $r->transfer_code . '">' . $r->transfer_code . '</a>';
                $nestedData[] = $r->amount;
                $nestedData[] = $r->commission;
                $nestedData[] = $r->amount - $r->commission;
                if ($r->direction == 'withdraw') {
                    $nestedData[] = '<button onclick="withdrawCancel(\'' . $r->id . '\')" class="btn btn-danger btn-sm"><i class="material-icons">close</i> İptal</button>';

                } else {
                    $nestedData[] = '<button disabled onclick="withdrawCancel(\'' . $r->id . '\')" class="btn btn-danger btn-sm"><i class="material-icons">close</i> İptal</button>';

                }

                $data[] = $nestedData;
            }
        }


        return response()->json([
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalFiltered),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data]
            , 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        $this->user = $user;
        $user->userBalanceFieldCheck();


        $currencies = Currency::select('user_balances.balance', 'currencies.name', 'currencies.long_name', 'currencies.approval_number', 'currencies.deposit_min', 'currencies.order', 'currencies.id')
            ->where('currencies.active', true)
            ->where('currencies.crypto', false)
            ->leftJoin('user_balances', function ($join) {
                $join->on('currencies.id', '=', 'user_balances.currency_id')
                    ->where('user_balances.user_id', '=', $this->user->id);
            })
            ->orderby('currencies.order', 'ASC')
            ->get();


        return view('dashboard.user.balance.local.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function withdraw(DashboardBalanceVerifyConfirmWithdrawRequest $request)
    {
        $user = Auth::user();
        $session = session('withdraw');
        $currency = Currency::select('id', 'name', 'withdraw_min', 'withdraw_max')
            ->where('active', true)
            ->where('withdraw', true)
            ->where('name', $request->currency)
            ->first();

        if (!$currency) {
            return response()->json(['errors' => ['Birim seçini hatalı']], 422);
        }
        if ($currency->withdraw_min > $request->amount) {
            return response()->json(['errors' => ['Tutar minumun para çekim talebinin altında']], 422);
        }
        if ($currency->withdraw_max < $request->amount) {
            return response()->json(['errors' => ['Tutar maksimun para çekim talebinin üzerinde']], 422);
        }
        $commission = CurrencyTransferCommission::select('amount')
            ->where('currency_id', $currency->id)
            ->where('direction', 'withdraw')
            ->where('amount', $request->commission)
            ->first();
        if (!$commission) {
            return response()->json(['errors' => ['Komisyon seçimi hatalı']], 422);
        }

        $balance = UserBalance::select('id', 'balance')->where('user_id', $user->id)->where('currency_id', $currency->id)->first();

        if ($balance->balance < $request->amount) {
            return response()->json(['errors' => ['Bakiyeniz yetersiz']], 422);
        }


        if ($session['amount'] != $request->amount || $session['currency'] != $request->currency || $session['address'] != $request->address || $session['commission'] != $request->commission) {
            return response()->json(['errors' => ['Lütfen işlemi aynı oturum üzerinde yapın.']], 422);
        }

        $twoStepVerification = new TwoStepVerificationController();
        if ($user->google2fa_login_active) {
            $verification = $twoStepVerification->getGoogle2FaWithdrawVerify($user, $request->confirmation_code);
            if ($verification == false) {
                return response()->json(['errors' => ['Authenticator kodu yanlış']], 422);
            }

        } elseif ($user->phone_login_active) {
            $verification = $twoStepVerification->getUserWithdrawPhoneCode($user, $request->confirmation_code);
            if ($verification == false) {
                return response()->json(['errors' => ['Telefonuunza gönderilen doğrulama kodu yanlış']], 422);
            }
        } else {
            return response()->json(['errors' => ['Uygun doğrulama yönetimi bulunamadı']]);
        }

        $userBalance = UserBalance::find($balance->id);
        $userBalance->balance = $balance->balance - $request->amount;
        $userBalance->save();

        $userCurrencyTransfer = new UserCurrencyTransferOrder;
        $userCurrencyTransfer->user_id = $user->id;
        $userCurrencyTransfer->currency_id = $currency->id;
        $userCurrencyTransfer->direction = 'withdraw';
        $userCurrencyTransfer->crypto = false;
        $userCurrencyTransfer->address = $request->address;
        $userCurrencyTransfer->amount = $request->amount;
        $userCurrencyTransfer->commission = $request->commission;
        $userCurrencyTransfer->save();
        return response()->json(['message' => 'İşlem operatör onayına alındı.'], 200);

    }

    public function getWithdrawConfirm(DashboardBalanceVerifyWithdrawRequest $request)
    {
        $user = Auth::user();
        $amount = $request->amount;
        $address = $request->address;

        $currency = Currency::select('id', 'name', 'withdraw_min', 'withdraw_max')
            ->where('active', true)
            ->where('withdraw', true)
            ->where('name', $request->currency)
            ->first();

        if (!$currency) {
            return response()->json(['errors' => ['Birim seçini hatalı']], 422);
        }
        if ($currency->withdraw_min > $amount) {
            return response()->json(['errors' => ['Tutar minumun para çekim talebinin altında']], 422);
        }
        if ($currency->withdraw_max < $amount) {
            return response()->json(['errors' => ['Tutar maksimun para çekim talebinin üzerinde']], 422);
        }
        $commission = CurrencyTransferCommission::select('amount')
            ->where('currency_id', $currency->id)
            ->where('direction', 'withdraw')
            ->where('amount', $request->commission)
            ->first();
        if (!$commission) {
            return response()->json(['errors' => ['Komisyon seçimi hatalı']]);
        }

        $balance = UserBalance::select('balance')->where('user_id', $user->id)->where('currency_id', $currency->id)->first();

        if ($balance->balance < $request->amount) {
            return response()->json(['errors' => ['Bakiyeniz yetersiz']]);
        }


        $userGoogle2faLoginActive = (bool)$user->google2fa_login_active;
        $userPhoneLoginActive = (bool)$user->phone_login_active;

        $twoStepVerification = new TwoStepVerificationController();

        if ($userPhoneLoginActive == true && $userGoogle2faLoginActive == false) {
            $session_id = $twoStepVerification->setUserWithdrawPhoneSmsCode($user, $amount, $address, $currency->name);
            $userDefaultLoginType = 'phone';
            $session = session(['withdraw' => ['key_id' => $session_id, 'amount' => $amount, 'commission' => $commission->amount, 'address' => $address, 'currency' => $currency->name]]);
        } else {
            $userDefaultLoginType = 'google2fa';
            $session = session(['withdraw' => ['amount' => $amount, 'commission' => $commission->amount, 'address' => $address, 'currency' => $currency->name]]);
        }

        return response()->json(['key' => $userDefaultLoginType, 'data' => session('withdraw'), 'message' => 'Devam etmek için kodu giriniz']);


    }

    public function getWithdraw(Request $request)
    {
        $user = Auth::user();
        $name = $request->name;
        $currency = Currency::select('id', 'name', 'icon', 'long_name')
            ->where('name', $name)
            ->where('active', true)
            ->where('withdraw', true)
            ->first();

        $currency->withdrawCommissions;


        return response()->json([
            'message' => 'İşlem başarılı',
            'currency' => $currency,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deposit(Request $request)
    {

        $user=Auth::user();
        $name = $request->name;
        $currency = Currency::select('id', 'name', 'icon')
            ->where('name', $name)
            ->where('active', true)
            ->where('deposit', true)
            ->first();
        if (!$currency) {
            return response()->json(['errors' => ['Geçiçi süre adres ataması yapılmaktadır.']], 422);
        }
        $currencyTransferAddresses = CurrencyTransferAddress::select('id', 'name', 'address', 'currency_id')
            ->where('active', true)
            ->where('currency_id', $currency->id)
            ->get();


        $addresses = array();

        if ($currencyTransferAddresses) {

            foreach ($currencyTransferAddresses as $currencyTransferAddress) {
                $dataObj = new \stdClass;
                $bank = $this->checkIBAN($currencyTransferAddress->address);
                $dataObj->name = $bank->name;
                $dataObj->address = $currencyTransferAddress->address;
                $dataObj->icon = $bank->icon;
                $dataObj->title = $currencyTransferAddress->name;

                $addresses["$currencyTransferAddress->address"] = $dataObj;
            }
        }


        if (!$currencyTransferAddresses->count() < 0) {
            return response()->json(['errors' => ['Geçiçi süre adres ataması yapılmaktadır.']], 422);
        }
        return response()->json([
            'message' => 'Adres getirme başarılı',
            'deposit_id' => $user->deposit_id,
            'currency' => $currency,
            'addresses' => $addresses
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function checkIBAN($iban)
    {
        $iban = strtolower(str_replace(' ', '', $iban));
        $Countries = array('al' => 28, 'ad' => 24, 'at' => 20, 'az' => 28, 'bh' => 22, 'be' => 16, 'ba' => 20, 'br' => 29, 'bg' => 22, 'cr' => 21, 'hr' => 21, 'cy' => 28, 'cz' => 24, 'dk' => 18, 'do' => 28, 'ee' => 20, 'fo' => 18, 'fi' => 18, 'fr' => 27, 'ge' => 22, 'de' => 22, 'gi' => 23, 'gr' => 27, 'gl' => 18, 'gt' => 28, 'hu' => 28, 'is' => 26, 'ie' => 22, 'il' => 23, 'it' => 27, 'jo' => 30, 'kz' => 20, 'kw' => 30, 'lv' => 21, 'lb' => 28, 'li' => 21, 'lt' => 20, 'lu' => 20, 'mk' => 19, 'mt' => 31, 'mr' => 27, 'mu' => 30, 'mc' => 27, 'md' => 24, 'me' => 22, 'nl' => 18, 'no' => 15, 'pk' => 24, 'ps' => 29, 'pl' => 28, 'pt' => 25, 'qa' => 29, 'ro' => 24, 'sm' => 27, 'sa' => 24, 'rs' => 22, 'sk' => 24, 'si' => 19, 'es' => 24, 'se' => 24, 'ch' => 21, 'tn' => 24, 'tr' => 26, 'ae' => 23, 'gb' => 22, 'vg' => 24);
        $Chars = array('a' => 10, 'b' => 11, 'c' => 12, 'd' => 13, 'e' => 14, 'f' => 15, 'g' => 16, 'h' => 17, 'i' => 18, 'j' => 19, 'k' => 20, 'l' => 21, 'm' => 22, 'n' => 23, 'o' => 24, 'p' => 25, 'q' => 26, 'r' => 27, 's' => 28, 't' => 29, 'u' => 30, 'v' => 31, 'w' => 32, 'x' => 33, 'y' => 34, 'z' => 35);

        if (strlen($iban) == $Countries[substr($iban, 0, 2)]) {

            $MovedChar = substr($iban, 4) . substr($iban, 0, 4);
            $MovedCharArray = str_split($MovedChar);
            $NewString = "";

            foreach ($MovedCharArray AS $key => $value) {
                if (!is_numeric($MovedCharArray[$key])) {
                    $MovedCharArray[$key] = $Chars[$MovedCharArray[$key]];
                }
                $NewString .= $MovedCharArray[$key];
            }

            if (bcmod($NewString, '97') == 1) {
                $bank_code = substr($iban, 4, 5);
                $bank = Bank::select('name', 'icon')->where('code', $bank_code)->first();

                return $bank;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }


}
