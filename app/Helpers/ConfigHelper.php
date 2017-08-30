<?php
/**
 * Created by PhpStorm.
 * User: Morgan Lane
 * Date: 30/08/2017
 * Time: 15:39
 */

namespace App\Helpers;

use App\Config;

class ConfigHelper
{
    public static function getValue($item) {
        return Config::where('item', $item)->first(['value']);
    }
}