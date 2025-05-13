<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected function authenticated(Request $request, $user)
    {

        if ($user->role === 'admin') {
            return redirect()->route('admin.index');
        }


        return redirect()->route('home');
    }
}


