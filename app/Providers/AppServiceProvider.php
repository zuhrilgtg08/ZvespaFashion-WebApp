<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        
        Blade::directive('currency', function ($input) {
            return "Rp. <?php echo number_format($input,0,',','.'); ?>";
        });

        Blade::directive('star', function ($input) {
            return "<?php echo number_format($input,1,'.',''); ?>";
        });

        Gate::define('admin', function (User $user) {
            return $user->roles_type == 1;
        });

        Gate::define('karyawan', function (User $user) {
            return $user->roles_type == 2;
        });
    }
}
