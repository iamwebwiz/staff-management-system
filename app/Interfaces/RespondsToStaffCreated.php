<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 18/12/2018
 * Time: 7:17 AM
 */

namespace App\Interfaces;


interface RespondsToStaffCreated
{
    public function staffCreatedSuccessfully($message);

    public function staffCreatedUnSuccessfully($message);

}