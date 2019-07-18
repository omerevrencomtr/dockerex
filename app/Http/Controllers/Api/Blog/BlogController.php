<?php

namespace App\Http\Controllers\Api\Blog;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = BlogCategory::select('id', 'order', 'title', 'slug', 'meta_key', 'meta_description', 'icon', 'created_at', 'updated_at')->where('active', true)->orderBy('order', 'ASC')->get();
        return response()->json(['categories' => $categories], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $posts = BlogCategory::select('id')->where(['slug' => $slug, 'active' => true])->first();
        if ($posts) {
            return response()->json(['posts' => $posts->posts]);
        } else {
            return response()->json(['posts' => []]);
        }
    }
}
