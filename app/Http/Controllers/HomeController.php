<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $data['blogs'] = Blog::with(['category'])->orderBy('id', 'desc')->limit(9)->get();
        //return $data['blogs'];

        return view('web.index')->with($data);
    }
}
