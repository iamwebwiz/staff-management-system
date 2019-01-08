<?php

/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 04/01/2019
 * Time: 10:34 AM
 */


function getNumberOfWeekDaysBetweenTwoDates(\Carbon\Carbon $from, \Carbon\Carbon $to){
     $week_days = $from->diffInWeekdays($to);
    if ($to->isWeekday()) {
        return $week_days + 1;
    }
     return $week_days;
}

