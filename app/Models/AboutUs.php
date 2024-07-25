<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'title2',
        'description2',
    ];
    public $timestamps = false;

    public function features()
    {
        return $this->hasMany(SubAboutUs::class);
    }
}
