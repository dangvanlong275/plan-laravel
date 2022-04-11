<?php

namespace App\Helpers;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

class RouteHelper
{
    private static $route = null;

    public static function handleParamName(string $nameRoute)
    {
        return self::$route->name($nameRoute);
    }

    public static function handleParamWhere(string $name, $expression = null)
    {
        return self::$route->where($name, $expression);
    }

    public static function handleParamMiddleware($middleware)
    {
        return self::$route->middleware($middleware);
    }

    public static function handleParams(array $param)
    {
        try {
            if (!empty($param['name']))
                self::handleParamName($param['name']);
            if (!empty($param['where']))
                self::handleParamWhere($param['where'][0], $param['where'][1]);
            if (!empty($param['middleware']))
                self::handleParamMiddleware($param['middleware']);
        } catch (\Throwable $th) {
            new \Exception($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public static function handleRoutes(string $method, array $param = [])
    {
        try {
            switch ($method) {
                case 'get':
                    self::handleRouteGet($param);
                    break;
                case 'post':
                    self::handleRoutePost($param);
                    break;
                case 'put':
                    self::handleRoutePut($param);
                    break;
                case 'patch':
                    self::handleRoutePatch($param);
                    break;
                case 'delete':
                    self::handleRouteDelete($param);
                    break;
                case 'any':
                    self::handleRouteAny($param);
                    break;
                case 'match':
                    self::handleRouteMatch($param);
                default:
                    throw new \Exception('Method invalid', 500);
            }
        } catch (\Throwable $th) {
            new \Exception($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * GET: lay du lieu tu co so du lieu
     */
    public static function handleRouteGet(array $param = [])
    {
        try {
            return collect($param)->each(function (array $item, string $baseController) {
                collect($item)->each(function (array $param, string $uri) use ($baseController) {
                    self::$route = Route::get($uri, [$baseController, $param['use']])->middleware();
                    self::handleParams($param);
                });
            });
        } catch (\Throwable $th) {
            new \Exception($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * POST: thuc hien cac tuong tac voi co so du lieu: them, sua, xoa
     */
    public static function handleRoutePost(array $param = [])
    {
        try {
            return collect($param)->each(function (array $item, string $baseController) {
                collect($item)->each(function (array $param, string $uri) use ($baseController) {
                    self::$route = Route::post($uri, [$baseController, $param['use']]);
                    self::handleParams($param);
                });
            });
        } catch (\Throwable $th) {
            new \Exception($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * PUT: thuc hien thao tac update
     */
    public static function handleRoutePut(array $param = [])
    {
        try {
            return collect($param)->each(function (array $item, string $baseController) {
                collect($item)->each(function (array $param, string $uri) use ($baseController) {
                    self::$route = Route::put($uri, [$baseController, $param['use']]);
                    self::handleParams($param);
                });
            });
        } catch (\Throwable $th) {
            new \Exception($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Patch: thuc hien thao tac update
     */
    public static function handleRoutePatch(array $param = [])
    {
        try {
            return collect($param)->each(function (array $item, string $baseController) {
                collect($item)->each(function (array $param, string $uri) use ($baseController) {
                    self::$route = Route::patch($uri, [$baseController, $param['use']]);
                    self::handleParams($param);
                });
            });
        } catch (\Throwable $th) {
            new \Exception($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete: thuc hien thao tac delete
     */
    public static function handleRouteDelete(array $param = [])
    {
        try {
            return collect($param)->each(function (array $item, string $baseController) {
                collect($item)->each(function (array $param, string $uri) use ($baseController) {
                    self::$route = Route::delete($uri, [$baseController, $param['use']]);
                    self::handleParams($param);
                });
            });
        } catch (\Throwable $th) {
            new \Exception($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Any: chap nhan tat ca cac method su dung url
     */
    public static function handleRouteAny(array $param = [])
    {
        try {
            return collect($param)->each(function (array $item, string $baseController) {
                collect($item)->each(function (array $param, string $uri) use ($baseController) {
                    self::$route = Route::any($uri, [$baseController, $param['use']]);
                    self::handleParams($param);
                });
            });
        } catch (\Throwable $th) {
            new \Exception($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Match: loc cac method muon su dung cho url
     */
    public static function handleRouteMatch(array $param = [])
    {
        try {
            return collect($param)->each(function (array $item, string $baseController) {
                collect($item)->each(function (array $param, string $uri) use ($baseController) {
                    self::$route = Route::match($param['method'], $uri, [$baseController, $param['use']]);
                    self::handleParams($param);
                });
            });
        } catch (\Throwable $th) {
            new \Exception($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Options: kiem tra cac method duoc su dung trong url or server
     */
    public static function handleRouteOptions(array $param = [])
    {
        try {
            return collect($param)->each(function (array $item, string $baseController) {
                collect($item)->each(function (array $param, string $uri) use ($baseController) {
                    self::$route = Route::options($uri, [$baseController, $param['use']]);
                    self::handleParams($param);
                });
            });
        } catch (\Throwable $th) {
            new \Exception($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
