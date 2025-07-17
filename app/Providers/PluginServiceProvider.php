<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadPlugins();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->bootPlugins();
    }

    protected function loadPlugins(): void
    {
        $pluginsPath = app_path('Plugins');
        foreach (glob($pluginsPath . '/*') as $plugin) {
            if (is_dir($plugin)) {
                $pluginClass = 'App\Plugins\\' . basename($plugin) . '\\' . basename($plugin) . 'Plugin';
                if (class_exists($pluginClass)) {
                    $pluginInstance = new $pluginClass();
                    if ($this->checkDependencies($pluginInstance)) {
                        $pluginInstance->register();
                    }
                }
            }
        }
    }

    protected function bootPlugins(): void
    {
        $pluginsPath = app_path('Plugins');
        foreach (glob($pluginsPath . '/*') as $plugin) {
            if (is_dir($plugin)) {
                $pluginClass = 'App\Plugins\\' . basename($plugin) . '\\' . basename($plugin) . 'Plugin';
                if (class_exists($pluginClass)) {
                    $pluginInstance = new $pluginClass();
                    $pluginInstance->boot();
                }
            }
        }
    }

    protected function checkDependencies($pluginInstance): bool
    {
        if (method_exists($pluginInstance, 'dependencies')) {
            $dependencies = $pluginInstance->dependencies();

            foreach ($dependencies as $dependency) {
                $pluginClass = 'App\Plugins\\' . basename($dependency) . '\\' . basename($dependency) . 'Plugin';
                if (class_exists($pluginClass)) continue;
                return false;
            }
        }

        return true;
    }
}
