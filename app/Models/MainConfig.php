<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainConfig extends Model
{
    use HasFactory;

    protected $table = 'main_config';
    protected $primaryKey = 'id';

    protected $fillable = [
        'logo',
        'favicon',
        'footer_logo',
        'footer_text',
    ];

    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];
}
