<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateAdminRequest;
use App\Repositories\AdminRepository;
use App\User;


class AdminController extends Controller
{
    protected $admin_repository;

	public function __construct(AdminRepository $admin_repository){
		$this->middleware('auth');
		$this->admin_repository = $admin_repository;
	}


	public function index(){
	    $admins = User::all();
	    return view('all-admin-members', compact('admins'));
    }

	public function create(){
	    return view('new-admin');
    }

    public function store(CreateAdminRequest $request){
	    return $this->admin_repository->createAdmin($request);
    }



}
