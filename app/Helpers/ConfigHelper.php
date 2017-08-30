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
        $result = Config::where('item', $item)->first(['value']);

        $array = json_decode($result);

        return $array->{'value'};
    }

    public static function setValue($item, $value) {
        $config = Config::where('item', $item)->first();
        $config->value = $value;
        $config->save();
    }
}