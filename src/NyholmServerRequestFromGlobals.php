<?php

namespace Hyperf\FrankenPhp;

use Hyperf\FrankenPhp\Contract\ServerRequestFromGlobalsInterface;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Nyholm\Psr7Server\ServerRequestCreatorInterface;
use Psr\Http\Message\ServerRequestInterface;

class NyholmServerRequestFromGlobals implements ServerRequestFromGlobalsInterface
{

    public function __construct(
        Psr17Factory $factory = new Psr17Factory(),
        private ?ServerRequestCreatorInterface $creator = null,
    ) {
        $this->creator = $this->creator ?? new ServerRequestCreator($factory, $factory, $factory, $factory);
    }

    public function __invoke(): ServerRequestInterface
    {
        return $this->creator->fromGlobals();
    }
}
