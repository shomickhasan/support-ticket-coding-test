<?php

namespace App\Http\CustomClass;

use Carbon\Carbon;

class OwnClass
{

    public static function DateTimeFormater($dateTime=null){
        if($dateTime != null){
            return  Carbon::parse($dateTime)->format('d M Y, h:i A');
        }
        else {
            return  null;
        }
    }

}
