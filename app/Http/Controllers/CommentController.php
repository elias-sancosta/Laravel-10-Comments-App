<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* use App\Models\User;
use App\Models\Comment; */

class CommentController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'body' =>'required',
        ]);
        
        auth()->user()->comments()->create(['body' => $request->body]);
        
        return back();
    }
}