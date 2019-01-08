<?php

namespace App\Http\Controllers;

use App\AuditTrail;
use App\Repositories\HomeRepository;

class HomeController extends Controller
{

    public $home_repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomeRepository $home_repository)
    {
        $this->middleware('auth');
        $this->home_repository = $home_repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->home_repository->userVisitHomePage();
    }





}
