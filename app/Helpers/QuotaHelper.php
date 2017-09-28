<?php
/**
 * Created by PhpStorm.
 * User: Morgan Lane
 * Date: 30/08/2017
 * Time: 15:39
 */

namespace App\Helpers;

use App\User;

class QuotaHelper
{
    public static function getUserQuotaUsed($userid) {
      $user = User::find($userid);

      $userQuota = $user->leftJoin('files', 'files.user_id' ,'=', 'users.id')
                        ->groupBy('disk_quota')
                        ->selectRaw('ifnull((sum(files.file_size) / 1024 / 1024), 0) disk_usage, disk_quota')
                        ->where('users.id', $userid)
                        ->first();

      return $userQuota;
    }
}
