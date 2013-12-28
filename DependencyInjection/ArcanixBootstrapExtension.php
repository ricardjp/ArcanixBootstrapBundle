<?php

/**
 * Copyright (C) 2013 Jean-Philippe Ricard.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Arcanix\BootstrapBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Jean-Philippe Ricard <ricardjp@arcanix.com>
 */
class ArcanixBootstrapExtension extends Extension {
	
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('twig.xml');

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__."/../Resources/config"));
        
        if (isset($config['form'])) {
        	foreach ($config['form'] as $key => $value) {
        		if (is_array($value)) {
        			foreach ($config['form'][$key] as $subkey => $subvalue) {
        				$container->setParameter('arcanix_bootstrap.form.'.$key.'.'.$subkey, $subvalue);
        			}
        		} else {
        			$container->setParameter('arcanix_bootstrap.form.'.$key, $value);
        		}
        	}
        }
        
        // registering form extensions
        $container->register("arcanix_bootstrap.form.help_extension", "Arcanix\BootstrapBundle\Form\Extension\HelpFormTypeExtension")
        	->addTag("form.type_extension", array("alias" => "form"));
        
        $container->register("arcanix_bootstrap.form.legend_extension", "Arcanix\BootstrapBundle\Form\Extension\LegendFormTypeExtension")
        	->addArgument(array(
        		"render_fieldset" => "%arcanix_bootstrap.form.render_fieldset%",
        		"show_legend" => "%arcanix_bootstrap.form.show_legend%",
        		"show_child_legend" => "%arcanix_bootstrap.form.show_child_legend%",
        		"render_required_asterisk" => "%arcanix_bootstrap.form.render_required_asterisk%",
        		"render_optional_text" => "%arcanix_bootstrap.form.render_optional_text%"))
        	->addTag("form.type_extension", array("alias" => "form"));
        
        $container->register("arcanix_bootstrap.form.error_type_extension", "Arcanix\BootstrapBundle\Form\Extension\ErrorTypeFormTypeExtension")
        	->addArgument(array("error_type" => "%arcanix_bootstrap.form.error_type%"))
        	->addTag("form.type_extension", array("alias" => "form"));
        
        $container->register("arcanix_bootstrap.form.widget_extension", "Arcanix\BootstrapBundle\Form\Extension\WidgetFormTypeExtension")
        	->addTag("form.type_extension", array("alias" => "form"));
        
        $container->register("arcanix_bootstrap.form.widget_collection_extension", "Arcanix\BootstrapBundle\Form\Extension\WidgetCollectionFormTypeExtension")
        	->addArgument(array(
        			"widget_add_btn" => "%arcanix_bootstrap.form.collection.widget_add_btn%",
        			"widget_remove_btn" => "%arcanix_bootstrap.form.collection.widget_remove_btn%"))
        	->addTag("form.type_extension", array("alias" => "form"));
        
        $container->register("arcanix_bootstrap.form.horizontal_extension", "Arcanix\BootstrapBundle\Form\Extension\HorizontalFormTypeExtension")
            ->addArgument(array(
                "horizontal" => "%arcanix_bootstrap.form.horizontal%",
                "horizontal_label_class" => "%arcanix_bootstrap.form.horizontal_label_class%",
                "horizontal_label_offset_class" => "%arcanix_bootstrap.horizontal_label_offset_class%",
                "horizontal_input_wrapper_class" => "%arcanix_bootstrap.horizontal_input_wrapper_class%"))
            ->addTag("form.type_extension", array("alias" => "form"));

        // automatically registering the lessphp filter from the Assetic Bundle
        $container->register("assetic.filter.lessphp", "Assetic\Filter\LessphpFilter")
        	->addTag("assetic.filter", array("alias" => "lessphp"))
        	->addMethodCall("setPresets", array(array()));
        
    }
}
