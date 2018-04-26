<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('destroy');
    }

    public function create() {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $user = User::where('name', $request->name)
            ->orWhere('email', $request->name)
            ->first();
        if ($user) {
            if (\Hash::check($request->password, $user->password)) {
                if ($request->remember) {
                    auth()->login($user, true);
                    return redirect($request->redirect);
                }
                auth()->login($user);
                return redirect($request->redirect);
            }
            return back();
        }
        return back();
    }

    public function destroy() {
        auth()->logout();
        return back();
    }
}
