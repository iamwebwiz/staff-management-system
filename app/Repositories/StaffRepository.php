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
use App\User;
use Illuminate\Http\Request;

class StaffRepository
{
    public $profile_image;
    public $admin_repository;

    public function __construct(StaffProfileImageRepository $imageRepository, UserRepository $admin_repository)
    {
        $this->profile_image = $imageRepository;
        $this->admin_repository = $admin_repository;
    }

    public function createStaff(Request $request, RespondsToStaffCreated $respondsToStaffCreated){

        $profile_image = $this->profile_image->saveProfileImage($request);
        if (!$profile_image) {
            return $respondsToStaffCreated->unSuccessfulResponse("No file selected!");
        }

        $admin = $this->admin_repository->createUser($request);
        $staff_details = $this->buildStaffProperties($request, $profile_image, $admin);
        $create_staff = Staff::create($staff_details);
        if ($create_staff) {
            return $respondsToStaffCreated->successfulResponse("Staff Created Successfully");
        }
        return $respondsToStaffCreated->unSuccessfulResponse("Unable to create Staff");
    }


    public function getAllStaff(){

        return Staff::with('user')->orderBy('created_at', 'asc')->get();
    }


    public function getOneStaff(Staff $staff){
        $staff = Staff::with('user')->whereId($staff->id)->first();
        return view("staff-show", compact('staff'));
    }


    public function updateStaffProfile(Request $request, $staff_id,RespondsToStaffCreated $respondsToStaffCreated){
        $staff = Staff::find($staff_id);
        $filename = $this->profile_image->saveProfileImage($request);

        if (!$filename) {
            $filename = $staff->image;
        }
        $admin = $this->admin_repository->updateUser($request, $request->get('user_id'));
        $staff_details = $this->buildStaffProperties($request, $filename, $admin);
        $update_staff = Staff::where('id', $staff->id)->update($staff_details);
        if ($update_staff) {
            return $respondsToStaffCreated->successfulResponse("Staff Updated Successfully");
        }
        return $respondsToStaffCreated->unSuccessfulResponse("Unable to Update Staff");
    }


    public function deleteStaff($staff_id){
        $staff = Staff::where('id', $staff_id)->first();
        $user_account = User::find($staff->user_id);
        $staff->delete();
        $user_account->delete();
        return redirect()->back()->with('message', 'Successfully removed staff member from database');
    }




    /**
     * @param Request $request
     * @param $profile_image
     * @param $admin
     * @return array
     */
    private function buildStaffProperties(Request $request, $profile_image, $admin)
    {
        $staff_details = $request->except("_token", "image", "name", "email","is_admin","_method");
        $staff_details = array_add($staff_details, "image", $profile_image);
        $staff_details = array_add($staff_details, "user_id", $admin->id);
        return $staff_details;
    }


}