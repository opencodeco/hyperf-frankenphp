<?php

namespace Hyperf\FrankenPhp;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\HttpServer\ResponseEmitter;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ResponseInterface;

class LaminasResponseEmitter extends ResponseEmitter
{
    public function __construct(
        ?StdoutLoggerInterface $logger = null,
        private ?SapiEmitter $emitter = null,
    ) {
        parent::__construct($logger);
        $this->emitter ??= new SapiEmitter();
    }

    public function emit(ResponseInterface $response, mixed $connection, bool $withContent = true): void
    {
        $this->emitter->emit($response);
    }
}
