<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\MainConfig;

class MainConfigComposer
{
    public function compose(View $view)
    {
        $mainConfig = MainConfig::first();
        $view->with('mainConfig', $mainConfig);
    }
}
