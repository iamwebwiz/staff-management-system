<?php

namespace App\Http\Controllers;

use App\AuditTrail;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recent_activities = AuditTrail::latest()->get();
        return view('home', compact('recent_activities'));
    }





}
