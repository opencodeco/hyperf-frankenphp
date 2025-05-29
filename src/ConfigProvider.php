<?php

declare(strict_types=1);

namespace Hyperf\FrankenPhp;

use Hyperf\FrankenPhp\Contract\ServerRequestFromGlobalsInterface;
use Hyperf\FrankenPhp\Contract\ServerRequestPlusFromGlobalsInterface;
use Hyperf\FrankenPhp\Contract\ServerRequestPlusFromServerRequestInterface;
use Hyperf\HttpServer\ResponseEmitter;
use Psr\Container\ContainerInterface;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                ServerRequestPlusFromServerRequestInterface::class =>
                    static fn (ContainerInterface $container) =>
                        $container->get(ServerRequestPlusFromServerRequest::class),

                ServerRequestFromGlobalsInterface::class =>
                    static fn (ContainerInterface $container) =>
                        $container->get(NyholmServerRequestFromGlobals::class),

                ServerRequestPlusFromGlobalsInterface::class =>
                    static fn (ContainerInterface $container) =>
                        $container->get(ServerRequestPlusFromGlobals::class),

                ResponseEmitter::class => LaminasResponseEmitter::class,
            ],
            'publish' => [
                [
                    'id' => 'worker-file',
                    'description' => 'The entrypoint file of FrankenPHP\'s\ worker.',
                    'source' => __DIR__ . '/../publish/index.php',
                    'destination' => BASE_PATH . '/public/index.php',
                ],
            ],
        ];
    }
}
