<?php

namespace Webkul\Admin\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Webkul\Core\Tree;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        Route::middleware('web')->group(__DIR__ . '/../Routes/web.php');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'admin');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'admin');

        Blade::anonymousComponentPath(__DIR__ . '/../Resources/views/components', 'admin');

        $this->composeView();

        $this->registerACL();

        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/menu.php',
            'menu.admin'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/acl.php',
            'acl'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php',
            'core'
        );
    }

    /**
     * Bind the data to the views.
     *
     * @return void
     */
    protected function composeView()
    {
        view()->composer([
            'admin::components.layouts.header.index',
            'admin::components.layouts.sidebar.index',
            'admin::components.layouts.tabs',
        ], function ($view) {
            $tree = Tree::create();

            $permissionType = auth()->guard('admin')->user()->role->permission_type;

            $allowedPermissions = auth()->guard('admin')->user()->role->permissions;

            foreach (config('menu.admin') as $index => $item) {
                if (! bouncer()->hasPermission($item['key'])) {
                    continue;
                }

                if (
                    $index + 1 < count(config('menu.admin'))
                    && $permissionType != 'all'
                ) {
                    $permission = config('menu.admin')[$index + 1];

                    if (
                        substr_count($permission['key'], '.') == 2
                        && substr_count($item['key'], '.') == 1
                    ) {
                        foreach ($allowedPermissions as $key => $value) {
                            if ($item['key'] != $value) {
                                continue;
                            }

                            $neededItem = $allowedPermissions[$key + 1];

                            foreach (config('menu.admin') as $key1 => $menu) {
                                if ($menu['key'] == $neededItem) {
                                    $item['route'] = $menu['route'];
                                }
                            }
                        }
                    }
                }

                $tree->add($item, 'menu');
            }

            $tree->items = core()->sortItems($tree->items);

            $view->with('menu', $tree);
        });

        view()->composer([
            'admin::settings.roles.create',
            'admin::settings.roles.edit',
        ], function ($view) {
            $view->with('acl', $this->createACL());
        });
    }

    /**
     * Register ACL to entire application.
     *
     * @return void
     */
    protected function registerACL()
    {
        $this->app->singleton('acl', function () {
            return $this->createACL();
        });
    }

    /**
     * Create ACL tree.
     *
     * @return mixed
     */
    protected function createACL()
    {
        static $tree;

        if ($tree) {
            return $tree;
        }

        $tree = Tree::create();

        foreach (config('acl') as $item) {
            $tree->add($item, 'acl');
        }

        $tree->items = core()->sortItems($tree->items);

        return $tree;
    }
}
