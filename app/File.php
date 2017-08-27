<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function folder() {
        return $this->belongsTo('App\Folder', 'folder_id');
    }

    public function owner() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
