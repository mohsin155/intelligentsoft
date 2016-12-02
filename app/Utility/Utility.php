<?php

namespace App\Utility;

use App\Utility\Thumb;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use DateTime;
use DateInterval;

class Utility {


public static function generatePassword($password) {
        return Hash::make($password);
    }
}