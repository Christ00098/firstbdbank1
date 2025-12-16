<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $welcomeMessage = "✅ Welcome, " . Auth::user()->name;
        $balance = "Your balance: £" . number_format(Auth::user()->balance, 2, '.', ','); // Example balance value
        $othersText = "• What's my balance? 
                      • Show recent transactions? 
                      • Last transaction? 
                      • Branch hours? 
                      • Register? 
                      • My profile 
                      • Dublicate transactions";
       
        return view('home', compact('welcomeMessage', 'balance', 'othersText'));
        //return view('home');
    }
}
