<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateAdminRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{
    protected $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }


    public function index()
    {
        $admins = User::simplePaginate(50);
        return view('all-admin-members', compact('admins'));
    }





}
