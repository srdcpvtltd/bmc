<?php

namespace App\Helpers;

use App\Models\User;

class Helpers
{
    public static function getUserName($id)
    {
        return User::find($id)->name;
    } 

    public static function getMonths()
    {
        return [
          'Jan',  
          'Feb',  
          'March',  
          'April',  
          'May',  
          'June',  
          'July',  
          'August',  
          'Sep',  
          'Oct',  
          'Nov',  
          'Dec',  
        ];
    } 

}
