<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class LeaveApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reason_for_leave' => 'required',
            'leave_start_date' => 'required|date|after:today',
            'leave_end_date' => 'required|date|after:leave_start_date',
            'user_id' => 'required',
        ];
    }
}
