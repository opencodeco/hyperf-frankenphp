<?php

declare(strict_types=1);

namespace Hyperf\FrankenPhp;

use Hyperf\Context\RequestContext;
use Hyperf\Context\ResponseContext;
use Hyperf\Dispatcher\HttpDispatcher;
use Hyperf\ExceptionHandler\ExceptionHandlerDispatcher;
use Hyperf\FrankenPhp\Contract\ServerRequestPlusFromGlobalsInterface;
use Hyperf\HttpMessage\Server\Response;
use Hyperf\HttpServer\ResponseEmitter;
use Psr\Container\ContainerInterface;

class Server extends \Hyperf\HttpServer\Server
{
    protected bool $running = true;

    public function __construct(
        ContainerInterface                                     $container,
        HttpDispatcher                                         $dispatcher,
        ExceptionHandlerDispatcher                             $exceptionHandlerDispatcher,
        ResponseEmitter                                        $responseEmitter,
        private readonly ServerRequestPlusFromGlobalsInterface $requestFromGlobals,
    ) {
        parent::__construct($container, $dispatcher, $exceptionHandlerDispatcher, $responseEmitter);
    }

    public function run(bool $workerMode = true): void
    {
        if ($workerMode) {
            while ($this->running) {
                $this->running = \frankenphp_handle_request($this->handle(...));
            }

            return;
        }

        $this->handle();
    }

    public function handle(): void
    {
        parent::onRequest(($this->requestFromGlobals)(), new Response());
    }

    protected function initRequestAndResponse($request, $response): array
    {
        ResponseContext::set($response = new Response());
        RequestContext::set($request);

        return [$request, $response];
    }
}
