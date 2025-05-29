<?php

namespace Hyperf\FrankenPhp\Contract;

use Swow\Psr7\Message\ServerRequestPlusInterface;

interface ServerRequestPlusFromGlobalsInterface
{
    public function __invoke(): ServerRequestPlusInterface;
}
