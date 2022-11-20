<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

        $loggedUser = User::all()->where('student_id', $request->student_id)->first();

        if($loggedUser->acc_status) {

        $request->authenticate();

        $request->session()->regenerate();

        activity('Login')->by($request->user)->event('login')->withProperties(['ip_address' => $request->ip()])->log('Login Successful');

        return redirect()->intended(RouteServiceProvider::HOME);

        } else {
            Alert::error('Account Deactivated', "Your account was deactivated. Please contact the administrator.")->showConfirmButton('OK', '#2678c5')->autoClose(6000);
            
            return redirect()->back();
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        activity('Logout')->by($request->user)->event('logout')->withProperties(['ip_address' => $request->ip()])->log('Logout Successful');
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
