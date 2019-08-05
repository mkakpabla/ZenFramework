<?php
declare(strict_types=1);

namespace Framework\Router\Annotation;

/**
 * Interface ReaderInterface
 * @package Components\Router\Annotation
 */
interface ReaderInterface
{
    /**
     * @return void
     */
    public function run(): void;

    /**
     * @return array
     */
    public function getRoutes(): array;
}
