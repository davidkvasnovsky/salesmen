<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use ReflectionMethod;
use RuntimeException;

final class MacroServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Request::macro(
            name: 'resolveFirstBoundModelClass',
            macro: function (): string {
                $route = $this->route();
                $action = $route->getAction();

                // Extract the controller and method from the 'uses' part of the action
                $uses = $action['uses'] ?? throw new RuntimeException(message: 'No controller action found.');

                [$controller, $method] = explode('@', $uses);

                // Use reflection to get the parameters of the controller method
                $reflect = new ReflectionMethod($controller, $method);
                $params = $reflect->getParameters();

                // Loop through the parameters to find the first bound model
                foreach ($params as $param) {
                    $type = $param->getType()?->getName();

                    if ($type && is_subclass_of($type, class: Model::class)) {
                        return $type;
                    }
                }

                throw new RuntimeException(message: 'No bound model found.');
            }
        );

        Str::macro(
            name: 'trimDoubleSpaces',
            macro: function ($string) {
                return preg_replace('/\s+/', ' ', $string);
            }
        );
    }
}
