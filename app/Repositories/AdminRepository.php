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
     * @return Response
     */
    public function createAdmin(Request $request)
    {
        list($create_admin_details, $generate_password) = $this->buildAdminProperties($request);
        $create_admin = User::create($create_admin_details);
        if ($create_admin) {
            SendAdminLoginJob::dispatch($create_admin,$password = ['password' => $generate_password]);
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
        return [$create_admin_details, $generate_password];
    }


    /**
     * @param Request $request, $id
     * @return Response
     */
    public function updateAdmin(Request $request, $id){
        $update_admin = User::where('id',$id)->update($request->except('_token','_method'));
        if ($update_admin) {
            return redirect()->route('all-admins');
        }

        return redirect()->back();
    }




}