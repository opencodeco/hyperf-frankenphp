<?php

declare(strict_types=1);

namespace Hyperf\FrankenPhp\Contract;

use Psr\Http\Message\ServerRequestInterface;
use Swow\Psr7\Message\ServerRequestPlusInterface;

interface ServerRequestPlusFromServerRequestInterface
{
    public function __invoke(ServerRequestInterface $request): ServerRequestPlusInterface;
}
