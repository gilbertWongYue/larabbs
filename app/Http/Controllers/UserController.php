<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
class UserController extends Controller
{
    //
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit()
    {

    }
}