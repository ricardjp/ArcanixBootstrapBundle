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

namespace Arcanix\BootstrapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\Finder\Finder;

/**
 * @author Jean-Philippe Ricard <ricardjp@arcanix.com>
 */
class RegisterAssetsPass implements CompilerPassInterface {

    const VENDOR_DIR = "vendor";
    const COMPONENTS_DIR = "components";
    const JQUERY_COMPONENT_DIR = "jquery";
    const BOOTSTRAP_COMPONENT_DIR = "bootstrap";

    public function process(ContainerBuilder $container) {

        $kernelRootDir = $container->getParameter("kernel.root_dir");
        $vendorDir = $kernelRootDir . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . self::VENDOR_DIR;
        $componentsDir = $vendorDir . DIRECTORY_SEPARATOR . self::COMPONENTS_DIR;
        
        $jqueryDir = $componentsDir . DIRECTORY_SEPARATOR . self::JQUERY_COMPONENT_DIR;
        
        $this->register($container, AssetConfiguration::create("jquery")
                ->addInput($jqueryDir . DIRECTORY_SEPARATOR . "jquery.min.js")
                ->setOutput("js/jquery.min.js"));
        $this->register($container, AssetConfiguration::create("jquery_map")
                ->addInput($jqueryDir . DIRECTORY_SEPARATOR . "jquery.min.map")
                ->setOutput("js/jquery.min.map"));
        
        $bootstrapDir = $componentsDir . DIRECTORY_SEPARATOR . self::BOOTSTRAP_COMPONENT_DIR;
        $bootstrapJsDir = $bootstrapDir . DIRECTORY_SEPARATOR . "js";
        
        $this->register($container, AssetConfiguration::create("bootstrap_js")
                ->addInput($bootstrapJsDir . DIRECTORY_SEPARATOR . "bootstrap.min.js")
                ->setOutput("js/bootstrap.min.js"));

        $bootstrapCssDir = $bootstrapDir . DIRECTORY_SEPARATOR . "css";
        
        $this->register($container, AssetConfiguration::create("bootstrap_css")
                ->addInput($bootstrapCssDir . DIRECTORY_SEPARATOR . "bootstrap.min.css")
                ->setOutput("css/bootstrap.css"));
        
        $bootstrapFontsDir = $bootstrapDir . DIRECTORY_SEPARATOR . "fonts";
        
        $finder = new Finder();
        $finder->files()->in($bootstrapFontsDir);
        
        $fontNum = 0;
        foreach ($finder as $fontFile) {
            $this->register($container, AssetConfiguration::create("bootstrap_font_" . $fontNum++)
                    ->addInput($fontFile->getRealPath())
                    ->setOutput("fonts/" . $fontFile->getFilename()));
        }

        // registering form fields
        $container->setParameter('twig.form.resources', array('ArcanixBootstrapBundle:Form:fields.html.twig'));
    }

    private function register(
            ContainerBuilder $container,
            AssetConfiguration $assetConfiguration) {
        
        $assetManager = $container->getDefinition("assetic.asset_manager");
        $assetManager->addMethodCall("setFormula", array(
            $assetConfiguration->getId(),
            $assetConfiguration->convertForRegistration()));
    }

}
