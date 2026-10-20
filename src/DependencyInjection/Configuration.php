<?php

namespace Wexample\SymfonyPlatformDs\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('wexample_symfony_platform_ds');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('contact')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('recipient')
                            ->info('The address the contact form writes to. Without one, the contact page is not found.')
                            ->defaultNull()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
