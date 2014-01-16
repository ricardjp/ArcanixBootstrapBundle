<?php

/**
 * Copyright (C) 2014 Jean-Philippe Ricard.
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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Jean-Philippe Ricard <ricardjp@arcanix.com>
 */
class ArcanixBootstrapExtension extends Extension {
	
    /**
     * Registering form extensions.
     */
    public function load(array $configs, ContainerBuilder $container) {
        $container->register(
                "arcanix_bootstrap.form.layout_extension",
                "Arcanix\BootstrapBundle\Form\Extension\LayoutFormTypeExtension")
                ->addTag("form.type_extension", array("alias" => "form"));
        
        $container->register(
                "arcanix_bootstrap.form.help_extension",
                "Arcanix\BootstrapBundle\Form\Extension\HelpFormTypeExtension")
        	->addTag("form.type_extension", array("alias" => "form"));
        
        $container->register(
                "arcanix_bootstrap.form.legend_extension",
                "Arcanix\BootstrapBundle\Form\Extension\LegendFormTypeExtension")
                ->addTag("form.type_extension", array("alias" => "form"));

        $container->register(
                "arcanix_bootstrap.form.append_prepend_extension",
                "Arcanix\BootstrapBundle\Form\Extension\PrependAndAppendInputFormTypeExtension")
                ->addTag("form.type_extension", array("alias" => "form"));
        
        $container->register(
                "arcanix_bootstrap.form.collection_extension",
                "Arcanix\BootstrapBundle\Form\Extension\CollectionFormTypeExtension")
                ->addTag("form.type_extension", array("alias" => "form"));

        $container->register(
                'arcanix.twig.arcanix_bootstrap_extension',
                "Arcanix\BootstrapBundle\Twig\ArcanixBootstrapExtension")
                ->addTag('twig.extension');
    }
}
