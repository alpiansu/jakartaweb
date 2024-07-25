<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    protected $fillable = ['image_url', 'title', 'description', 'button_text', 'button_link'];
    public $timestamps = false;
}
