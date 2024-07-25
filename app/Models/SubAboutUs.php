<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAboutUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_us_id',
        'icon',
        'title',
        'description'
    ];
    public $timestamps = false;

    public function aboutUs()
    {
        return $this->belongsTo(AboutUs::class);
    }
}
