<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer('include.sidebar', function (View $view) {
            $view->with('menus', Menu::with('subMenus')
                ->where('status', true)
                ->whereNull('parent_id')
                ->orderBy('display_order', 'asc')
                ->get());
        });
    }
}
