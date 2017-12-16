<?php

namespace IceTea\Web;

use Exception;
use IceTea\View\View;
use IceTea\Routing\Router;
use IceTea\View\ViewSkeleton;
use IceTea\Routing\RouteBinding;
use IceTea\Routing\RouteCollector;
use IceTea\Exceptions\AbsoluteException;
use IceTea\Exceptions\Http\NotFoundException;
use IceTea\Foundation\Http\NotFoundFoundation;
use App\Exceptions\Handler as ExceptionHandler;
use IceTea\Foundation\Exceptions\Handler\HttpExceptionHandler;

final class Web
{


    public function __construct()
    {

    }


    public function routeHandle()
    {
        RouteCollector::loadRoutes();
        $route = new Router();
        try {
            $action = $route->fire();
        } catch (Exception $e) {
            $action = new ExceptionHandler($e);
        }

        RouteBinding::destroy();
        if ($action instanceof ViewSkeleton) {
            View::make($action);
        } elseif ($action instanceof ExceptionHandler) {
            $action->report();
        }

        RouteCollector::destroy();
    }


    public function terminate()
    {
    }
}
