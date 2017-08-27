<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function files() {
        return $this->hasMany('App\File', 'folder_id');
    }

    public function owner() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function childFolders() {
        return $this->hasMany('App\Folder', 'parent_folder');
    }
}
