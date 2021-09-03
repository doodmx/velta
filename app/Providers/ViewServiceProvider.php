<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\TagComposer;
use App\Http\View\Composers\RoleComposer;
use App\Http\View\Composers\StatusComposer;
use App\Http\View\Composers\PartnerComposer;
use App\Http\View\Composers\LanguageComposer;
use App\Http\View\Composers\CategoryComposer;
use App\Http\View\Composers\CurrencyComposer;
use App\Http\View\Composers\CourseTypeComposer;
use App\Http\View\Composers\MembershipComposer;
use App\Http\View\Composers\PermissionComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer(['admin.blogs.*'], TagComposer::class);
        View::composer(['admin.blogs.*'], CategoryComposer::class);

        View::composer(['admin.courses.*'], CourseTypeComposer::class);


        View::composer(['admin.payments.index', 'admin.courses.*'], CurrencyComposer::class);
        View::composer('admin.users.index', PartnerComposer::class);
        View::composer('admin.users.index', RoleComposer::class);
        View::composer(['admin.roles.create', 'admin.roles.edit'], PermissionComposer::class);
        View::composer('admin.users.*', MembershipComposer::class);


        View::composer('*', LanguageComposer::class);
        View::composer('*', StatusComposer::class);
    }
}
