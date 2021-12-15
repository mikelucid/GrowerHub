<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application Services.
     *
     * @return void
     */
    public function boot()
    {
	    $this->composeSidebarTags();

	    $this->bootMacros();
    }

    /**
     * Register any application Services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

	public function bootMacros()
	{
		require base_path('resources/macros/blade.php');
	}

	public function composeSidebarTags(): void
	{
		if ( Schema::hasTable('tags') ) {
			$sidebar_tags = Tag::withType('category')->limit(25)->get();

			View::composer('*', function ($view) use ($sidebar_tags) {
				$view->with(compact('sidebar_tags'));
			});
		}
	}

}
