<?php

namespace Arcanix\ArcanixBootstrapBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Parameter;

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 */
class ArcanixBootstrapExtension extends Extension {
	
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
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
        $container->register("arcanix_bootstrap.form.help_extension", "Arcanix\ArcanixBootstrapBundle\Form\Extension\HelpFormTypeExtension")
        	->addTag("form.type_extension", array("alias" => "form"));
        
        $container->register("arcanix_bootstrap.form.legend_extension", "Arcanix\ArcanixBootstrapBundle\Form\Extension\LegendFormTypeExtension")
        	->addArgument(array(
        		"render_fieldset" => "%arcanix_bootstrap.form.render_fieldset%",
        		"show_legend" => "%arcanix_bootstrap.form.show_legend%",
        		"show_child_legend" => "%arcanix_bootstrap.form.show_child_legend%",
        		"render_required_asterisk" => "%arcanix_bootstrap.form.render_required_asterisk%",
        		"render_optional_text" => "%arcanix_bootstrap.form.render_optional_text%"))
        	->addTag("form.type_extension", array("alias" => "form"));
        
        $container->register("arcanix_bootstrap.form.error_type_extension", "Arcanix\ArcanixBootstrapBundle\Form\Extension\ErrorTypeFormTypeExtension")
        	->addArgument(array("error_type" => "%arcanix_bootstrap.form.error_type%"))
        	->addTag("form.type_extension", array("alias" => "form"));
        
        $container->register("arcanix_bootstrap.form.widget_extension", "Arcanix\ArcanixBootstrapBundle\Form\Extension\WidgetFormTypeExtension")
        	->addTag("form.type_extension", array("alias" => "form"));
        
        $container->register("arcanix_bootstrap.form.widget_collection_extension", "Arcanix\ArcanixBootstrapBundle\Form\Extension\WidgetCollectionFormTypeExtension")
        	->addArgument(array(
        			"widget_add_btn" => "%arcanix_bootstrap.form.collection.widget_add_btn%",
        			"widget_remove_btn" => "%arcanix_bootstrap.form.collection.widget_remove_btn%"))
        	->addTag("form.type_extension", array("alias" => "form"));
        
        // automatically registering the lessphp filter from the Assetic Bundle
        $container->register("assetic.filter.lessphp", "Assetic\Filter\LessphpFilter")
        	->addTag("assetic.filter", array("alias" => "lessphp"))
        	->addMethodCall("setPresets", array(array()));
        
    }
}
