<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 20/12/2018
 * Time: 7:43 AM
 */

namespace App\Repositories;


use App\Http\Controllers\AdminController;
use App\Jobs\SendAdminLoginJob;
use App\User;
use Illuminate\Http\Request;

class AdminRepository
{

    public function __construct()
    {

    }


    public function createAdmin(Request $request)
    {
        list($create_admin_details, $generate_password) = $this->buildAdminProperties($request);
        $create_admin = User::create($create_admin_details);

        if ($create_admin) {
            $password = ['password' => $generate_password];
            SendAdminLoginJob::dispatch($create_admin,$password);
            return redirect()->route('all-admins');
        }

        return redirect()->back();

    }


    /**
     * @param Request $request
     * @return array
     */
    public function buildAdminProperties(Request $request)
    {
        $create_admin_details = $request->except('_token');
        $generate_password = str_random(5);
        $create_admin_details = array_add($create_admin_details, 'password', bcrypt($generate_password));
        return array($create_admin_details, $generate_password);
    }




}