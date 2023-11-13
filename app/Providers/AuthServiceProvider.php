<?php

namespace App\Providers;

use App\Models\Category;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
use App\Policies\OrderPolicy;
use App\Policies\UserPolicy;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
        Category::class => CategoryPolicy::class,
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('can-productDestroy', [ProductPolicy::class, 'forceDelete']);
        Gate::define('can-productRestore', [ProductPolicy::class, 'restore']);

        Gate::define('can-orderDestroy', [OrderPolicy::class, 'forceDelete']);
        Gate::define('can-orderRestore', [OrderPolicy::class, 'restore']);

        Gate::define('can-categoryDestroy', [CategoryPolicy::class, 'forceDelete']);
        Gate::define('can-categoryRestore', [CategoryPolicy::class, 'restore']);
        //
    }
}
