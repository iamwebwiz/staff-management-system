<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateAdminRequest;
use App\Repositories\AdminRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{
    protected $admin_repository;

    public function __construct(AdminRepository $admin_repository)
    {
        $this->admin_repository = $admin_repository;
    }


    public function index()
    {
        $admins = User::simplePaginate(50);
        return view('all-admin-members', compact('admins'));
    }

    public function create()
    {
        return view('new-admin');
    }

    public function store(CreateAdminRequest $request)
    {
        return $this->admin_repository->createAdmin($request);
    }

    public function edit(User $user)
    {
        return view("edit-admin", compact('user'));
    }


    /**
     * Update the given user
     * @param  Request  $request, $id
     * @return
     */
    public function update(Request $request, $id)
    {
        return $this->admin_repository->updateAdmin($request, $id);
    }


}
