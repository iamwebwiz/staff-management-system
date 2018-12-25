<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 18/12/2018
 * Time: 7:02 AM
 */

namespace App\Repositories;


use App\Interfaces\RespondsToStaffCreated;
use App\Staff;
use Illuminate\Http\Request;

class StaffRepository
{
    public $profile_image;

    public function __construct(StaffProfileImageRepository $imageRepository)
    {
        $this->profile_image = $imageRepository;
    }

    public function createStaff(Request $request, RespondsToStaffCreated $respondsToStaffCreated){

        $profile_image = $this->profile_image->saveProfileImage($request);
        if (!$profile_image) {
            return $respondsToStaffCreated->unSuccessfulResponse("No file selected!");
        }

        $staff_details = $request->except("_token");
        $staff_details = array_add($staff_details, "image",$profile_image);
        $create_staff = Staff::create($staff_details);
        $response = $respondsToStaffCreated->unSuccessfulResponse("Unable to create Staff");
        if ($create_staff) {
            $response = $respondsToStaffCreated->successfulResponse("Staff Created Successfully");
        }
        return $response;
    }


    public function getOneStaff(Staff $staff){
        return view("staff-show", compact('staff'));
    }


    public function updateStaffProfile(Request $request, $staff_id,RespondsToStaffCreated $respondsToStaffCreated){
        $staff = Staff::find($staff_id);
        $filename = $this->profile_image->saveProfileImage($request);

        if (!$filename) {
            $filename = $staff->image;
        }
//        dd($filename);
        $staff_details = $request->except("_token",'_method');
        $staff_details = array_add($staff_details, "image",$filename);
        $update_staff = Staff::where('id', $staff->id)->update($staff_details);
        $response = $respondsToStaffCreated->unSuccessfulResponse("Unable to Update Staff");
        if ($update_staff) {
            $response = $respondsToStaffCreated->successfulResponse("Staff Updated Successfully");
        }
        return $response;
    }



    public function deleteStaff($staff_id){
        $staff = Staff::where('id', $staff_id)->first();
        $staff->delete();
        return redirect()->back()->with('message', 'Successfully removed staff member from database');
    }



}