<?php

/**
 * We use Illuminate's Container to create a singleton class for extended valet classes.
 *
 */

use Illuminate\Container\Container;

Container::getInstance()->singleton(
    \Valet\Valet::class,
    \NSHenry\ValetPlus\Extended\Valet::class
);
Container::getInstance()->singleton(
    \Valet\Configuration::class,
    \NSHenry\ValetPlus\Extended\Configuration::class
);
Container::getInstance()->singleton(
    \Valet\Nginx::class,
    \NSHenry\ValetPlus\Extended\Nginx::class
);
Container::getInstance()->singleton(
    \Valet\PhpFpm::class,
    \NSHenry\ValetPlus\Extended\PhpFpm::class
);
Container::getInstance()->singleton(
    \Valet\Site::class,
    \NSHenry\ValetPlus\Extended\Site::class
);
Container::getInstance()->singleton(
    \Valet\Status::class,
    \NSHenry\ValetPlus\Extended\Status::class
);
