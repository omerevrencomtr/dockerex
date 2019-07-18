<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class BlogCategory extends Model
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
        return $this->hasMany('App\Models\Blog\BlogPost', 'blog_category_id', 'id')->select('id', 'order', 'title','content', 'slug', 'meta_key', 'meta_description', 'icon','image','url', 'created_at', 'updated_at')->where('active',true)->orderBy('order');
    }
}
