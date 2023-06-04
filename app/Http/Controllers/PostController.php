<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        $channels = Channel::all();
        return view('post.create', compact('channels'));
    }


}
