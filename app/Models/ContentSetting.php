<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentSetting extends Model
{
    protected $primaryKey = 'content_key';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['content_key', 'content_value'];
}
