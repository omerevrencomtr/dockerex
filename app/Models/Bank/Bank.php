<?php

namespace App\Models\Bank;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Bank extends Model
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
}
