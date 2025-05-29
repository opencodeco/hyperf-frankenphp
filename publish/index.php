<?php

declare(strict_types=1);

ignore_user_abort(true);

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

require BASE_PATH . '/vendor/autoload.php';

Hyperf\Di\ClassLoader::init(handler: new Hyperf\Di\ScanHandler\NullScanHandler());

/** @var Psr\Container\ContainerInterface $container */
$container = require BASE_PATH . '/config/container.php';

/** @var Hyperf\FrankenPhp\Server $server */
$server = $container->get(Hyperf\FrankenPhp\Server::class);
$server->initCoreMiddleware(serverName: 'http');
$server->run(workerMode: true);
