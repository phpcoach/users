<?php

namespace App\DependencyInjection\CompilerPass;

use League\Tactician\CommandBus;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class NamedBusesCompilerPass
 */
class NamedBusesCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $container->registerAliasForArgument('tactician.commandbus.read', CommandBus::class, 'readBus');
        $container->registerAliasForArgument('tactician.commandbus.write', CommandBus::class, 'writeBus');
        $container->registerAliasForArgument('tactician.commandbus.async_write', CommandBus::class, 'asyncWriteBus');
    }
}