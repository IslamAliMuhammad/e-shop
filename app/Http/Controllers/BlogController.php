<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Http::get('https://eshop-blog.000webhostapp.com/wp-json/wp/v2/posts')->json();


        return view('client.blog', compact('posts'));

    }


}
