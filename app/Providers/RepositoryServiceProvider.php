<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use ReflectionClass;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->registerRepositories();
    }

    /**
     * Automatically bind interfaces to their implementations.
     */
    private function registerRepositories(): void
    {
        $repositoryPath = app_path('Repositories');
        $interfacePath = app_path('Interfaces');

        if (!File::exists($repositoryPath) || !File::exists($interfacePath)) {
            return;
        }

        $repositories = File::allFiles($repositoryPath);
        $interfaces = File::allFiles($interfacePath);

        $interfaceMap = [];

        // Map interface names to their full namespace
        foreach ($interfaces as $file) {
            $interfaceClass = 'App\\Interfaces\\' . str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathname());
            if (interface_exists($interfaceClass)) {
                $interfaceMap[class_basename($interfaceClass)] = $interfaceClass;
            }
        }

        // Bind repository classes to interfaces
        foreach ($repositories as $file) {
            $repositoryClass = 'App\\Repositories\\' . str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathname());

            if (class_exists($repositoryClass)) {
                $reflection = new ReflectionClass($repositoryClass);
                $interfaces = $reflection->getInterfaces();

                foreach ($interfaces as $interface) {
                    $interfaceClass = $interface->getName();
                    if (isset($interfaceMap[class_basename($interfaceClass)])) {
                        $this->app->bind($interfaceClass, $repositoryClass);
                    }
                }
            }
        }
    }
}
