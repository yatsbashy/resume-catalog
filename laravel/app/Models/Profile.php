<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    const PICTURE_PATH_PREFIX = 'production/images/users';
    const DEFAULT_PICTURE_PATH = '/0/user.svg';

    protected $fillable = [
        'user_id'
    ];

    public function getPictureUrlAttribute()
    {
        if (!$this->attributes['picture_filename']) {
            return Storage::cloud()
                ->url(self::PICTURE_PATH_PREFIX . self::DEFAULT_PICTURE_PATH);
        }

        return Storage::cloud()
            ->url(self::PICTURE_PATH_PREFIX . "/{$this->attributes['user_id']}/{$this->attributes['picture_filename']}");
    }
}
