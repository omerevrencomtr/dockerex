<?php

namespace App\Models\Currency;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Currency extends Model
{

    /**
     * Get the comments for the blog post.
     */
    public function withdrawCommissions()
    {
        return $this->hasMany('App\Models\Currency\CurrencyTransferCommission')->select('amount','key')->orderBy('amount','asc');
    }

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
     * Get the phone record associated with the user.
     */
    public function userBalances($query)
    {
       return $query->leftjoin('crime_name as cn','cn.id', '=', 'crime_reports.crime_name_id');
        return Currency::leftJoin('user_balances', function($join) {
            $join->on('currencies.id', '=', 'user_balances.currency_id');
        })
            ->get();
    }
}
