<?php

namespace App\Utility;

use Illuminate\Support\Facades\Hash;

class Utility {
    
    public static function generatePassword($password) {
        return Hash::make($password);
    }

}
