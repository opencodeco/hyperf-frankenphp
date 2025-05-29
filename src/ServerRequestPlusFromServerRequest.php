<?php

declare(strict_types=1);

namespace Hyperf\FrankenPhp;

use Hyperf\FrankenPhp\Contract\ServerRequestPlusFromServerRequestInterface;
use Hyperf\HttpMessage\Server\Request;
use Psr\Http\Message\ServerRequestInterface;
use Swow\Psr7\Message\ServerRequestPlusInterface;

class ServerRequestPlusFromServerRequest implements ServerRequestPlusFromServerRequestInterface
{
    public function __invoke(ServerRequestInterface $request): ServerRequestPlusInterface
    {
        return (new Request(
            $request->getMethod(),
            $request->getUri(),
            $request->getHeaders(),
            $request->getBody(),
            $request->getProtocolVersion(),
        ))
            ->withCookieParams($request->getCookieParams())
            ->withQueryParams($request->getQueryParams())
            ->withServerParams($request->getServerParams())
            ->withParsedBody($request->getParsedBody())
            ->withUploadedFiles($request->getUploadedFiles());
    }
}
