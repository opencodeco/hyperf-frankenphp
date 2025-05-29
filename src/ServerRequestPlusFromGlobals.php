<?php

declare(strict_types=1);

namespace Hyperf\FrankenPhp;

use Hyperf\FrankenPhp\Contract\ServerRequestFromGlobalsInterface;
use Hyperf\FrankenPhp\Contract\ServerRequestPlusFromGlobalsInterface;
use Hyperf\FrankenPhp\Contract\ServerRequestPlusFromServerRequestInterface;
use Swow\Psr7\Message\ServerRequestPlusInterface;
class ServerRequestPlusFromGlobals implements ServerRequestPlusFromGlobalsInterface
{
    public function __construct(
        private readonly ServerRequestFromGlobalsInterface $serverRequestFromGlobals,
        private readonly ServerRequestPlusFromServerRequestInterface $fromServerRequest,
    ) {
    }

    public function __invoke(): ServerRequestPlusInterface
    {
        return ($this->fromServerRequest)(($this->serverRequestFromGlobals)());
    }
}
