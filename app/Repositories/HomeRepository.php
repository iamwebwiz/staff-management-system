<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 06/01/2019
 * Time: 11:39 AM
 */

namespace App\Repositories;


use App\AuditTrail;
use Illuminate\Support\Facades\Auth;

class HomeRepository
{

    public function userVisitHomePage(){
        $recent_activities = AuditTrail::latest()->get();
        if (Auth::user()->is_admin == false ) {
            $recent_activities = AuditTrail::where('resource_type_affected', 'admin')->where('affected_resource_id', Auth::user()->id)->latest()->get();
        }
        return view('admin-home', compact('recent_activities'));
    }


}