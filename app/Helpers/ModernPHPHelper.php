<?php

namespace App\Helpers;

/**
 * Modern PHP Compatibility Helper
 * Fixes deprecation warnings for Laravel 8 on PHP 8.4+
 */
class ModernPHPHelper
{
    /**
     * Modern optional() function replacement
     */
    public static function optional($value = null, $callback = null)
    {
        if (is_null($callback)) {
            return new Optional($value);
        }

        if (!is_null($value)) {
            return $callback($value);
        }

        return null;
    }

    /**
     * Modern with() function replacement
     */
    public static function with($value = null, $callback = null)
    {
        if (is_null($callback)) {
            return $value;
        }

        return $callback($value);
    }

    /**
     * Safe array first with nullable callback
     */
    public static function arrayFirst($array, $callback = null, $default = null)
    {
        if (is_null($callback)) {
            return !empty($array) ? reset($array) : $default;
        }

        foreach ($array as $key => $value) {
            if ($callback($value, $key)) {
                return $value;
            }
        }

        return $default;
    }

    /**
     * Safe array last with nullable callback
     */
    public static function arrayLast($array, $callback = null, $default = null)
    {
        if (is_null($callback)) {
            return !empty($array) ? end($array) : $default;
        }

        $last = null;
        foreach ($array as $key => $value) {
            if ($callback($value, $key)) {
                $last = $value;
            }
        }

        return $last ?? $default;
    }

    /**
     * Safe string UUID creation
     */
    public static function createUuid($factory = null)
    {
        if (is_null($factory)) {
            return (string) \Illuminate\Support\Str::uuid();
        }

        return $factory();
    }

    /**
     * Safe container resolving
     */
    public static function safeResolve($container, $abstract, $parameters = [])
    {
        try {
            return $container->resolve($abstract, $parameters);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Safe container before resolving
     */
    public static function safeBeforeResolving($container, $abstract, $callback = null)
    {
        if (!is_null($callback)) {
            $container->beforeResolving($abstract, $callback);
        }
    }

    /**
     * Safe container after resolving
     */
    public static function safeAfterResolving($container, $abstract, $callback = null)
    {
        if (!is_null($callback)) {
            $container->afterResolving($abstract, $callback);
        }
    }

    /**
     * Safe container set instance
     */
    public static function safeSetInstance($container, $instance = null)
    {
        if (!is_null($instance)) {
            $container->setInstance($instance);
        }
    }

    /**
     * Safe request duplicate
     */
    public static function safeRequestDuplicate($request, $query = null, $request_data = null, $attributes = null, $cookies = null, $files = null, $server = null)
    {
        $params = [];
        
        if (!is_null($query)) $params['query'] = $query;
        if (!is_null($request_data)) $params['request'] = $request_data;
        if (!is_null($attributes)) $params['attributes'] = $attributes;
        if (!is_null($cookies)) $params['cookies'] = $cookies;
        if (!is_null($files)) $params['files'] = $files;
        if (!is_null($server)) $params['server'] = $server;

        return $request->duplicate($params);
    }

    /**
     * Safe when has with default
     */
    public static function safeWhenHas($request, $key, $default = null)
    {
        if ($request->has($key)) {
            return $request->input($key);
        }
        return $default;
    }

    /**
     * Safe when filled with default
     */
    public static function safeWhenFilled($request, $key, $default = null)
    {
        if ($request->filled($key)) {
            return $request->input($key);
        }
        return $default;
    }
}

/**
 * Optional class for backward compatibility
 */
class Optional
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __get($key)
    {
        if (is_object($this->value)) {
            return $this->value->{$key} ?? null;
        }
        return null;
    }

    public function __call($method, $parameters)
    {
        if (is_object($this->value)) {
            return $this->value->{$method}(...$parameters);
        }
        return null;
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}

