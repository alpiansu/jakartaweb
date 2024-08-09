<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    use HasFactory;
    protected $table = 'sub_services';

    protected $fillable = [
        'menu_name',
        'url_menu',
        'heading',
        'sub_heading',
    ];
}
