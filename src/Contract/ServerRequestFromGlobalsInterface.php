<?php

declare(strict_types=1);

namespace Hyperf\FrankenPhp\Contract;

use Psr\Http\Message\ServerRequestInterface;

interface ServerRequestFromGlobalsInterface
{
    public function __invoke(): ServerRequestInterface;
}
