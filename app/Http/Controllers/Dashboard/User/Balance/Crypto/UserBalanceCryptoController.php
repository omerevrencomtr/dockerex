<?php

namespace App\Http\Controllers\Dashboard\User\Balance\Crypto;

use App\Http\Controllers\Auth\TwoStepVerificationController;
use App\Http\Controllers\System\SystemController;
use App\Http\Requests\Dashboard\Balance\Verify\DashboardBalanceVerifyConfirmWithdrawRequest;
use App\Http\Requests\Dashboard\Balance\Verify\DashboardBalanceVerifyWithdrawRequest;
use App\Models\Currency\Currency;
use App\Models\Currency\CurrencyTransferAddress;
use App\Models\Currency\CurrencyTransferCommission;
use App\Models\User\UserBalance;
use App\Models\User\UserCurrencyTransferOrder;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserBalanceCryptoController extends Controller
{

    protected $user;


    public function withdrawCancel(Request $request)
    {
        $user = Auth::user();
        $userCurrencyTransferOrder = UserCurrencyTransferOrder::where('direction','withdraw')->where('user_id', $user->id)->where('id', $request->id)->where('status', 'waiting')->where('crypto', true)->first();

        if (!$userCurrencyTransferOrder) {
            return response()->json(['errors' => ['Bu işlemi iptal edemezsiniz']], 422);
        }

        if ($userCurrencyTransferOrder->admin_id != null) {
            return response()->json(['errors' => ['İşlem yönetici tarafından beklemeye alındı']], 422);
        }
        $userCurrencyTransferOrder->status = 'processed';
        $userCurrencyTransferOrder->description = 'İşlem kullanıcı tarafından iptal edildi.';
        $userCurrencyTransferOrder->save();


        $userBalance = UserBalance::where('user_id',$userCurrencyTransferOrder->user_id)->where('currency_id',$userCurrencyTransferOrder->currency_id)->first();
        $userBalance->balance = $userCurrencyTransferOrder->amount + $userBalance->balance;
        $userBalance->save();

        if (!$userBalance){
            return response()->json(['errors'=>['Destek birimleri ile irtibata geçin']],422);
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
            ->userBalanceCryptoHistory()
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $totalFiltered = User::where('id', $user->id)
            ->select('id')
            ->first()
            ->userBalanceCryptoHistory()
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
            ->userBalanceCryptoPending()
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $totalFiltered = User::where('id', $user->id)
            ->select('id')
            ->first()
            ->userBalanceCryptoPending()
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
                if ($r->direction=='withdraw'){
                    $nestedData[] = '<button onclick="withdrawCancel(\'' . $r->id . '\')" class="btn btn-danger btn-sm"><i class="material-icons">close</i> İptal</button>';

                }else{
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
            ->where('currencies.crypto', true)
            ->leftJoin('user_balances', function ($join) {
                $join->on('currencies.id', '=', 'user_balances.currency_id')
                    ->where('user_balances.user_id', '=', $this->user->id);
            })
            ->orderby('currencies.order', 'ASC')
            ->get();


        return view('dashboard.user.balance.crypto.index', compact('currencies'));
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

    public function convertToValidPrice($price)
    {
        $price = str_replace(['-', ',', '$', ' '], '', $price);
        if (!is_numeric($price)) {
            $price = null;
        } else {
            if (strpos($price, '.') !== false) {
                $dollarExplode = explode('.', $price);
                $dollar = $dollarExplode[0];
                $cents = $dollarExplode[1];
                if (strlen($cents) === 0) {
                    $cents = '00';
                } elseif (strlen($cents) === 1) {
                    $cents = $cents . '0';
                } elseif (strlen($cents) > 2) {
                    $cents = substr($cents, 0, 8);
                }
                $price = $dollar . '.' . $cents;
            } else {
                $cents = '00';
                $price = $price . '.' . $cents;
            }
        }

        return $price;
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
        $userCurrencyTransfer->crypto = true;
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

        $user = Auth::user();
        $name = $request->name;
        $currency = Currency::select('id', 'name', 'icon')
            ->where('name', $name)
            ->where('active', true)
            ->where('deposit', true)
            ->first();

        $currencyTransferAddress = CurrencyTransferAddress::select('id', 'address', 'currency_id', 'user_id')
            ->where('active', true)
            ->where('currency_id', $currency->id)
            ->where('user_id', $user->id)
            ->first();


        if (!$currencyTransferAddress) {
            $currencyTransferAddress = CurrencyTransferAddress::select('id', 'address', 'currency_id', 'user_id')
                ->where('currency_id', $currency->id)
                ->where('user_id', null)
                ->where('active', true)
                ->first();
            if (!$currencyTransferAddress) {
                return response()->json(['errors' => ['Geçiçi süre adres ataması yapılmaktadır.']], 422);
            }
            $currencyTransferAddress->user_id = $user->id;
            $currencyTransferAddress->save();
        }

        if (!$currencyTransferAddress) {
            return response()->json(['errors' => ['Geçiçi süre adres ataması yapılmaktadır.']], 422);
        }
        return response()->json([
            'message' => 'Adres getirme başarılı',
            'currency' => $currency,
            'address' => $currencyTransferAddress
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
}
