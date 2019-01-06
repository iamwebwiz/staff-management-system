<?php

/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 04/01/2019
 * Time: 10:34 AM
 */


function getNumberOfWeekDaysBetweenTwoDates(\Carbon\Carbon $from, \Carbon\Carbon $to){
    return $week_days = $from->diffInWeekdays($to);
}

