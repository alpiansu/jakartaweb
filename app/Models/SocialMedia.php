<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_media';
    protected $primaryKey = 'id';

    protected $fillable = [
        'icon',
        'name',
        'link',
    ];

    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];
}
