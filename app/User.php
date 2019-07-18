<?php

namespace App;

use App\Models\Currency\Currency;
use App\Models\User\UserBalance;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;
use stdClass;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'email_confirmed', 'email_login_active', 'phone', 'phone_confirmed', 'phone_login_active', 'google2fa_login_active', 'login_default_type', 'deposit_id','confirmed_level', 'confirmed', 'admin', 'admin_level', 'language_code', 'country_code', 'active', 'google2fa_ts'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'google2fa_secret'
    ];

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'uuid';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
            $model->deposit_id = strtoupper(str_random(8));
        });
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getGravatarAttribute()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email) . '?d=mp';
    }

    /**
     * Ecrypt the user's google_2fa secret.
     *
     * @param  string $value
     * @return string
     */
    public function setGoogle2FASecretAttribute($value)
    {
        $this->attributes['google2fa_secret'] = encrypt($value);
    }

    /**
     * Decrypt the user's google_2fa secret.
     *
     * @param  string $value
     * @return string
     */
    public function getGoogle2faSecretAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * Get the comments for the blog post.
     */
    public function userAccountActivity()
    {
        return $this->hasMany('App\Models\User\UserAccountActivity');
    }

    /**
     * Get the comments for the blog post.
     */
    public function userBalanceCryptoPending()
    {
        return $this->hasMany('App\Models\User\UserCurrencyTransferOrder', 'user_id', 'id')->where('status', 'waiting')->where('crypto', true)->select('id', 'currency_id', 'created_at', 'direction', 'address', 'transfer_code', 'amount', 'commission', 'description');
    }

    /**
     * Get the comments for the blog post.
     */
    public function userBalanceCryptoHistory()
    {
        return $this->hasMany('App\Models\User\UserCurrencyTransferOrder', 'user_id', 'id')->where('status', 'processed')->where('crypto', true)->select('id', 'currency_id', 'created_at', 'direction', 'address', 'transfer_code', 'amount', 'commission', 'description');
    }

    /**
     * Get the comments for the blog post.
     */
    public function userBalanceLocalPending()
    {
        return $this->hasMany('App\Models\User\UserCurrencyTransferOrder', 'user_id', 'id')->where('status', 'waiting')->where('crypto', false)->select('id', 'currency_id', 'created_at', 'direction', 'address', 'transfer_code', 'amount', 'commission', 'description');
    }

    /**
     * Get the comments for the blog post.
     */
    public function userBalanceLocalHistory()
    {
        return $this->hasMany('App\Models\User\UserCurrencyTransferOrder', 'user_id', 'id')->where('status', 'processed')->where('crypto', false)->select('id', 'currency_id', 'created_at', 'direction', 'address', 'transfer_code', 'amount', 'commission', 'description');
    }

    public function userBalanceFieldCheck()
    {
        $userBalanceFields = Currency::select('currencies.id', 'user_balances.user_id', 'user_balances.balance')
            ->leftJoin('user_balances', function ($join) {
                $join->on('currencies.id', '=', 'user_balances.currency_id')
                    ->where('user_balances.user_id', '=', $this->id);
            })
            ->get();

        foreach ($userBalanceFields as $userBalanceField) {
            if ($userBalanceField->balance === null) {
                $userBalance = new UserBalance;
                $userBalance->user_id = $this->id;
                $userBalance->currency_id = $userBalanceField->id;
                $userBalance->balance = 0;
                $userBalance->save();
            }
        }

        return true;
    }
}
