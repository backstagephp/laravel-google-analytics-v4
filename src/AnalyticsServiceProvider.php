<?php

namespace Backstage\Analytics;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AnalyticsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-google-analytics')
            ->hasConfigFile();

        if (app()->runningUnitTests()) {
            return;
        }

        $package->hasInstallCommand(function (InstallCommand $command) {
            $command->publishConfigFile()
                ->askToStarRepoOnGitHub('backstage/laravel-google-analytics');
        });
    }
}
