<?php

namespace Stack;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class LazyHttpKernel implements HttpKernelInterface
{
    private $factory;
    private $app;

    public function __construct(callable $factory)
    {
        $this->factory = $factory;
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        return $this->createApp()->handle($request, $type, $catch);
    }

    private function createApp()
    {
        $this->app = $this->app ?: call_user_func($this->factory);

        return $this->app;
    }
}
