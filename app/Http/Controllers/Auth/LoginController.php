<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/laralux';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Override the authenticated method to redirect based on user role.
     *
     * @param \Illuminate\Http\Request  $request
     * @param mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // dd($user);
        if ($user->role === 'guest') {
            return redirect('/home');
        } elseif ($user->role === 'owner' || $user->role === 'admin') {
            return redirect('/admin');
        } else {
            // Handle other roles or scenarios if needed
            return redirect($this->redirectTo);
        }
    }
}

