<?php

namespace Arcanix\ArcanixBootstrapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('arcanix_bootstrap');
        $this->addFormConfig($rootNode);

        return $treeBuilder;
    }

    protected function addFormConfig(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('templating')
                            ->defaultValue("ArcanixBootstrapBundle:Form:fields.html.twig")
                            ->end()
                        ->booleanNode('render_fieldset')
                            ->defaultValue(true)
                            ->end()
                        ->booleanNode('show_legend')
                            ->defaultValue(true)
                            ->end()
                        ->booleanNode('show_child_legend')
                            ->defaultValue(false)
                            ->end()
                        ->booleanNode('render_optional_text')
                            ->defaultValue(true)
                            ->end()
                        ->booleanNode('render_required_asterisk')
                            ->defaultValue(false)
                            ->end()
                        ->scalarNode('error_type')
                            ->defaultValue(null)
                            ->end()
                        ->arrayNode('collection')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('widget_remove_btn')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->arrayNode('attr')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('class')
                                                    ->defaultValue("btn")
                                                ->end()
                                            ->end()
                                        ->end()
                                        ->scalarNode('icon')
                                            ->defaultValue(null)
                                        ->end()
                                        ->scalarNode('icon_color')
                                            ->defaultValue(null)
                                        ->end()
                                    ->end()
                                 ->end()
                                ->arrayNode('widget_add_btn')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->arrayNode('attr')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('class')
                                                    ->defaultValue("btn")
                                                ->end()
                                            ->end()
                                        ->end()
                                        ->scalarNode('icon')
                                            ->defaultValue(null)
                                        ->end()
                                        ->scalarNode('icon_color')
                                            ->defaultValue(null)
                                        ->end()
                                    ->end()
                                 ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
