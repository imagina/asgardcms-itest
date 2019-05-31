<?php

namespace Modules\Itest\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Itest\Events\Handlers\RegisterItestSidebar;

class ItestServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterItestSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('categories', array_dot(trans('itest::categories')));
            $event->load('questions', array_dot(trans('itest::questions')));
            $event->load('results', array_dot(trans('itest::results')));
            $event->load('tests', array_dot(trans('itest::tests')));
            // append translations




        });
    }

    public function boot()
    {
        $this->publishConfig('itest', 'permissions');
        $this->publishConfig('itest', 'config');
        $this->publishConfig('itest', 'settings');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Itest\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Itest\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Itest\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Itest\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Itest\Repositories\QuestionRepository',
            function () {
                $repository = new \Modules\Itest\Repositories\Eloquent\EloquentQuestionRepository(new \Modules\Itest\Entities\Question());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Itest\Repositories\Cache\CacheQuestionDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Itest\Repositories\ResultRepository',
            function () {
                $repository = new \Modules\Itest\Repositories\Eloquent\EloquentResultRepository(new \Modules\Itest\Entities\Result());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Itest\Repositories\Cache\CacheResultDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Itest\Repositories\TestRepository',
            function () {
                $repository = new \Modules\Itest\Repositories\Eloquent\EloquentTestRepository(new \Modules\Itest\Entities\Test());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Itest\Repositories\Cache\CacheTestDecorator($repository);
            }
        );
// add bindings




    }
}
