<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function show(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('login');
    }
    /**
     * @throws ValidationException
     */
    public function login(): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        validator(request()->all(), [
            'email' =>['required', 'email'],
            'password' => ['required']
        ])->validate();

        if(auth()->attempt(request()->only(['email', 'password']))){
            return redirect('/dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid Credentials!']);
    }

    public function logout(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        auth()->logout();

        return redirect('/');
    }
}
