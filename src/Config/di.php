<?php

/**
 * Dependency injection configuration file
 */

use function DI\create;
use Amar\Kaaz\App\Services\Impl\RepeatKaazServiceImpl;
use Amar\Kaaz\App\Services\RepeatKaazService;


return [
    RepeatKaazService::class => DI\get(RepeatKaazServiceImpl::class),
];
