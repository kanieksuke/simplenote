<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Memo;
use App\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $user = \Auth::user();

            $memoModel = new Memo();
            $memos = Memo::where('user_id', \Auth::id())->where('status', 1)->orderBy('updated_at', 'DESC')->get();

            $tagModel = new Tag();
            $tags = $tagModel->where('user_id', \Auth::id())->get();

            $view->with('user', $user)->with('memos', $memos)->with('tags', $tags);
        });
    }
}
