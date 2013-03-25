<?php

/**
 * Copyright (c) 2011 Mohrenweiser & Partner, Philipp A. Mohrenweiser
 * - http://www.mohrenweiserpartner.de
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Arcanix\BootstrapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {
    
    public function getConfigTreeBuilder() {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('arcanix_bootstrap');
        $this->addFormConfig($rootNode);
        return $treeBuilder;
    }

    protected function addFormConfig(ArrayNodeDefinition $rootNode) {
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
