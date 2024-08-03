<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\SocialMedia;

class SocialMediaComposer
{
    public function compose(View $view)
    {
        $socialMedia = SocialMedia::all();
        $view->with('socialMedia', $socialMedia);
    }
}
