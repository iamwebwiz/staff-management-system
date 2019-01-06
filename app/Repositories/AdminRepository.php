<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 20/12/2018
 * Time: 7:43 AM
 */

namespace App\Repositories;


use App\Jobs\SendAdminLoginJob;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminRepository
{


    /**
     * @param Request $request
     * @return
     */
    public function createAdmin(Request $request)
    {
        list($create_admin_details, $generate_password) = $this->buildAdminProperties($request);
        $create_admin = User::create($create_admin_details);
        SendAdminLoginJob::dispatch($create_admin, $password = ['password' => $generate_password]);
        return $create_admin;
    }


    /**
     * @param Request $request
     * @return array
     */
    public function buildAdminProperties(Request $request)
    {
        $create_admin_details = ['name' => $request->get('name'), 'email' => $request->get('email')];
        $generate_password = str_random(5);
        $create_admin_details = array_add($create_admin_details, 'password', bcrypt($generate_password));
        if ($request->get('is_admin')) {
            $create_admin_details = array_add($create_admin_details, 'is_admin', true);
        }
        return [$create_admin_details, $generate_password];
    }


    /**
     * @param Request $request , $id
     * @return
     */
    public function updateAdmin(Request $request, $id)
    {
        $update_details = ['name' => $request->get('name'), 'email' => $request->get('email')];
        if ($request->get('is_admin')) {
            $update_details = array_add($update_details,'is_admin', true);
        }
        User::where('id', $id)->update($update_details);

        return  User::where('id', $id)->first();
    }


}