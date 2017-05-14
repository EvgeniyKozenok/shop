<?php

namespace Shop\Middleware;

use John\Frame\Request\Request;
use John\Frame\Response\Response;
use John\Frame\Middleware\MiddlewareI;

class AgeMiddleware implements MiddlewareI
{

    /**
     * @param Request $request
     * @param \Closure $next
     * @param \array[] ...$args
     * @return mixed
     */
    public function handle(Request $request, \Closure $next, array ...$args): Response
    {
        return $next($request);
    }
}