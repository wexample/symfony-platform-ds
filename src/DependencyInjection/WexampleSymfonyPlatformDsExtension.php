<?php

namespace Wexample\SymfonyPlatformDs\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Wexample\SymfonyHelpers\DependencyInjection\AbstractWexampleSymfonyExtension;

class WexampleSymfonyPlatformDsExtension extends AbstractWexampleSymfonyExtension
{
    public const string PARAMETER_CONTACT_RECIPIENT = 'wexample_symfony_platform_ds.contact.recipient';

    public function load(
        array $configs,
        ContainerBuilder $container
    ): void {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setParameter(self::PARAMETER_CONTACT_RECIPIENT, $config['contact']['recipient']);

        $this->loadConfig(
            __DIR__,
            $container
        );
    }
}
