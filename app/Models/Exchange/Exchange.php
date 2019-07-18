<?php

namespace App\Models\Exchange;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use DB;

class Exchange extends Model
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
    public function buying()
    {
        return $this->hasOne('App\Models\Currency\Currency', 'id', 'currency_buying_id');
    }

    public function selling()
    {
        return $this->hasOne('App\Models\Currency\Currency', 'id', 'currency_selling_id');
    }


    public function buyingOrders(){
        return $this->hasMany('App\Models\Exchange\ExchangeOrder','exchange_id','id')->select(DB::raw('(sum(amount)) as amount,price,(sum(amount)*price) as total'))->groupBy('price')->orderBy('price','DESC')->where('direction','buy')->groupby(['price'])->offset(0)->limit(100);

    }

    public function sellingOrders(){
        return $this->hasMany('App\Models\Exchange\ExchangeOrder','exchange_id','id')->select(DB::raw('(sum(amount)) as amount,price,(sum(amount)*price) as total'))->groupBy('price')->orderBy('price','ASC')->where('direction','sell')->groupby(['price'])->offset(0)->limit(100);


    }
    public function orderCompleteds(){
        return $this->hasMany('App\Models\Exchange\ExchangeOrderCompleted');
    }
}
