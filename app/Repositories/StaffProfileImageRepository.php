<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 18/12/2018
 * Time: 9:49 AM
 */

namespace App\Repositories;


use Illuminate\Http\Request;

class StaffProfileImageRepository
{

    public function saveProfileImage(Request $request, $path = 'app/public/staff'){
        if ($request->hasFile('image')){
            $filename = $request['name'] . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(storage_path($path), $filename);
            return $filename;
        }
        else {
            return false;
        }
    }


}