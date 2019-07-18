<?php

namespace App\Models\Announcement;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class AnnouncementPost extends Model
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

    public function createdDate()
    {
        return $this->created_at->formatLocalized('%d %B %Y %A %H:%M');
    }
}
