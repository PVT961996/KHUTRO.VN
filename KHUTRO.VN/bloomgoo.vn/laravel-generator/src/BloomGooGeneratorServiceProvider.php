<?php

namespace BloomGoo\Generator;

use Illuminate\Support\ServiceProvider;
use BloomGoo\Generator\Commands\API\APIControllerGeneratorCommand;
use BloomGoo\Generator\Commands\API\APIGeneratorCommand;
use BloomGoo\Generator\Commands\API\APIRequestsGeneratorCommand;
use BloomGoo\Generator\Commands\API\TestsGeneratorCommand;
use BloomGoo\Generator\Commands\APIScaffoldGeneratorCommand;
use BloomGoo\Generator\Commands\Common\MigrationGeneratorCommand;
use BloomGoo\Generator\Commands\Common\ModelGeneratorCommand;
use BloomGoo\Generator\Commands\Common\RepositoryGeneratorCommand;
use BloomGoo\Generator\Commands\Publish\GeneratorPublishCommand;
use BloomGoo\Generator\Commands\Publish\LayoutPublishCommand;
use BloomGoo\Generator\Commands\Publish\PublishTemplateCommand;
use BloomGoo\Generator\Commands\Publish\VueJsLayoutPublishCommand;
use BloomGoo\Generator\Commands\RollbackGeneratorCommand;
use BloomGoo\Generator\Commands\Scaffold\ControllerGeneratorCommand;
use BloomGoo\Generator\Commands\Scaffold\RequestsGeneratorCommand;
use BloomGoo\Generator\Commands\Scaffold\ScaffoldGeneratorCommand;
use BloomGoo\Generator\Commands\Scaffold\ViewsGeneratorCommand;
use BloomGoo\Generator\Commands\VueJs\VueJsGeneratorCommand;

class BloomGooGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__.'/../config/laravel_generator.php';

        $this->publishes([
            $configPath => config_path('bloomgoo/laravel_generator.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('bloomgoo.publish', function ($app) {
            return new GeneratorPublishCommand();
        });

        $this->app->singleton('bloomgoo.api', function ($app) {
            return new APIGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.scaffold', function ($app) {
            return new ScaffoldGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.publish.layout', function ($app) {
            return new LayoutPublishCommand();
        });

        $this->app->singleton('bloomgoo.publish.templates', function ($app) {
            return new PublishTemplateCommand();
        });

        $this->app->singleton('bloomgoo.api_scaffold', function ($app) {
            return new APIScaffoldGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.migration', function ($app) {
            return new MigrationGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.model', function ($app) {
            return new ModelGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.repository', function ($app) {
            return new RepositoryGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.api.controller', function ($app) {
            return new APIControllerGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.api.requests', function ($app) {
            return new APIRequestsGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.api.tests', function ($app) {
            return new TestsGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.scaffold.controller', function ($app) {
            return new ControllerGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.scaffold.requests', function ($app) {
            return new RequestsGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.scaffold.views', function ($app) {
            return new ViewsGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.rollback', function ($app) {
            return new RollbackGeneratorCommand();
        });

        $this->app->singleton('bloomgoo.vuejs', function ($app) {
            return new VueJsGeneratorCommand();
        });
        $this->app->singleton('bloomgoo.publish.vuejs', function ($app) {
            return new VueJsLayoutPublishCommand();
        });

        $this->commands([
            'bloomgoo.publish',
            'bloomgoo.api',
            'bloomgoo.scaffold',
            'bloomgoo.api_scaffold',
            'bloomgoo.publish.layout',
            'bloomgoo.publish.templates',
            'bloomgoo.migration',
            'bloomgoo.model',
            'bloomgoo.repository',
            'bloomgoo.api.controller',
            'bloomgoo.api.requests',
            'bloomgoo.api.tests',
            'bloomgoo.scaffold.controller',
            'bloomgoo.scaffold.requests',
            'bloomgoo.scaffold.views',
            'bloomgoo.rollback',
            'bloomgoo.vuejs',
            'bloomgoo.publish.vuejs',
        ]);
    }
}
