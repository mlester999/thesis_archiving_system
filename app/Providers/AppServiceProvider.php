<?php

namespace App\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

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
        Builder::macro('search', function ($field, $string) {
            return $string ? $this->where($field[0], 'like', '%'  .$string . '%')
                                ->orWhere($field[1], 'like', '%'  .$string . '%')
                                ->orWhere($field[2], 'like', '%'  .$string . '%')
                                ->orWhere($field[3], 'like', '%'  .$string . '%') : $this;
        });
    }
}
