<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\App;
use App\Helpers\ModernPHPHelper;

class ModernPHPServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register the ModernPHPHelper as a singleton
        $this->app->singleton('modern-php', function ($app) {
            return new ModernPHPHelper();
        });

        // Override Laravel's helper functions with modern versions
        if (!function_exists('optional')) {
            function optional($value = null, $callback = null) {
                return ModernPHPHelper::optional($value, $callback);
            }
        }

        if (!function_exists('with')) {
            function with($value = null, $callback = null) {
                return ModernPHPHelper::with($value, $callback);
            }
        }

        if (!function_exists('array_first')) {
            function array_first($array, $callback = null, $default = null) {
                return ModernPHPHelper::arrayFirst($array, $callback, $default);
            }
        }

        if (!function_exists('array_last')) {
            function array_last($array, $callback = null, $default = null) {
                return ModernPHPHelper::arrayLast($array, $callback, $default);
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Add custom Blade directives for modern PHP features
        Blade::directive('modernOptional', function ($expression) {
            return "<?php echo App\Helpers\ModernPHPHelper::optional($expression); ?>";
        });

        Blade::directive('modernWith', function ($expression) {
            return "<?php echo App\Helpers\ModernPHPHelper::with($expression); ?>";
        });

        // Register global helpers
        $this->registerGlobalHelpers();
    }

    /**
     * Register global helper functions
     */
    protected function registerGlobalHelpers(): void
    {
        // Safe container resolving helper
        if (!function_exists('safe_resolve')) {
            function safe_resolve($abstract, $parameters = []) {
                try {
                    return app($abstract, $parameters);
                } catch (\Exception $e) {
                    return null;
                }
            }
        }

        // Safe request duplicate helper
        if (!function_exists('safe_request_duplicate')) {
            function safe_request_duplicate($request, $query = null, $request_data = null, $attributes = null, $cookies = null, $files = null, $server = null) {
                $params = [];
                
                if (!is_null($query)) $params['query'] = $query;
                if (!is_null($request_data)) $params['request'] = $request_data;
                if (!is_null($attributes)) $params['attributes'] = $attributes;
                if (!is_null($cookies)) $params['cookies'] = $cookies;
                if (!is_null($files)) $params['files'] = $files;
                if (!is_null($server)) $params['server'] = $server;

                return $request->duplicate($params);
            }
        }

        // Safe when has helper
        if (!function_exists('safe_when_has')) {
            function safe_when_has($request, $key, $default = null) {
                if ($request->has($key)) {
                    return $request->input($key);
                }
                return $default;
            }
        }

        // Safe when filled helper
        if (!function_exists('safe_when_filled')) {
            function safe_when_filled($request, $key, $default = null) {
                if ($request->filled($key)) {
                    return $request->input($key);
                }
                return $default;
            }
        }

        // Safe UUID creation helper
        if (!function_exists('safe_create_uuid')) {
            function safe_create_uuid($factory = null) {
                if (is_null($factory)) {
                    return (string) \Illuminate\Support\Str::uuid();
                }
                return $factory();
            }
        }
    }
}
