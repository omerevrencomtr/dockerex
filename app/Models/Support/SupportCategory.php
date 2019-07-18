<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class SupportCategory extends Model
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
     * Get the comments for the blog post.
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Announcement\AnnouncementPost', 'announcement_category_id', 'id')->select('id', 'order', 'title','content', 'slug', 'meta_key', 'meta_description', 'icon', 'created_at', 'updated_at')->where('active',true)->orderBy('order');
    }
}
