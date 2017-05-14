<?php

namespace Shop\Middleware;

use John\Frame\Middleware\MiddlewareI;
use John\Frame\Request\Request;
use John\Frame\Response\Response;

class RoleMiddleware implements MiddlewareI
{

    /**
     * @param Request $request
     * @param \Closure $next
     * @param \array[] ...$args
     * @return mixed
     */
    public function handle(Request $request, \Closure $next, array ...$args): Response
    {
        $response = $next($request);
        $response->code = 404;
        $response->message = 'lalala';
        return $response;
//        return $next($request);
    }
}