<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Hash;
use Ramsey\Uuid\Uuid;

class UserAuthCode extends Model
{
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
        });
    }

    /**
     * Ecrypt the login_sms's google_2fa secret.
     *
     * @param  string $value
     * @return string
     */
    public function setKeySecretAttribute($value)
    {
        $this->attributes['key_secret'] = Hash::make($value);
    }

    /**
     * Decrypt the login_sms's code secret.
     *
     * @param  string $value
     * @return string
     */
    public function getKeySecretAttribute($key = null)
    {
        $dateTime = Carbon::now();
        $created_at = $this->attributes['created_at'];
        if ($this->used == false) {
            if ($created_at >= $dateTime->subMinutes(2) && $created_at <= $dateTime->addMinutes(2)) {
                if (Hash::check($key, $this->attributes['key_secret'])) {
                    $this->attributes['used'] = true;
                    $this->save();
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getKeySecretEmailAttribute($key = null)
    {
        if ($this->used == false) {
            if (Hash::check($key, $this->attributes['key_secret'])) {
                $this->attributes['used'] = true;
                $this->save();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
