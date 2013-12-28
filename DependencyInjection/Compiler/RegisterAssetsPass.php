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

namespace Arcanix\BootstrapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\Finder\Finder;

/**
 * @author Jean-Philippe Ricard <ricardjp@arcanix.com>
 */
class RegisterAssetsPass implements CompilerPassInterface {

    const JQUERY_PATH = "sonata-project/jquery-bundle/Sonata/jQueryBundle/Resources/public";
    const BOOTSTRAP_PATH = "twitter/bootstrap";

    public function process(ContainerBuilder $container) {
        $kernelRootDir = $container->getParameter("kernel.root_dir");

        $jqueryDir = $kernelRootDir . "/../vendor/" . static::JQUERY_PATH;

        // use a finder, easier to maintain on a new jquery version
        $finder = new Finder();
        $finder->files()->in($jqueryDir)->name("jquery-*.js")->notName("*ui*");
        $jQueryJs = AssetConfiguration::create("jquery")
			->setFinder($finder)
			->setOutput("js/query.js");

        $finder = new Finder();
        $finder->files()->in($jqueryDir)->name("jquery-ui-*.js")->notName("*i18n*");
        $jQueryUIJs = AssetConfiguration::create("jqueryui")
        	->setFinder($finder)
        	->setOutput("js/query-ui.js");

        $finder = new Finder();
        $finder->files()->in($jqueryDir)->name("jquery-ui-i18n.js");
        $jQueryUIi18nJs = AssetConfiguration::create("jqueryuii18n")
        	->setFinder($finder)
        	->setOutput("js/query-ui-i18n.js");

        $bootstrapJsDir = $kernelRootDir . "/../vendor/" . static::BOOTSTRAP_PATH . "/js";

        $bootstrapJs = AssetConfiguration::create("bootstrap_js")
			->addInput($bootstrapJsDir . "/affix.js")
	    	->addInput($bootstrapJsDir . "/alert.js")
	    	->addInput($bootstrapJsDir . "/button.js")
	    	->addInput($bootstrapJsDir . "/carousel.js")
	    	->addInput($bootstrapJsDir . "/collapse.js")
	    	->addInput($bootstrapJsDir . "/dropdown.js")
	    	->addInput($bootstrapJsDir . "/modal.js")
	    	->addInput($bootstrapJsDir . "/tooltip.js")
	    	->addInput($bootstrapJsDir . "/popover.js")
	    	->addInput($bootstrapJsDir . "/scrollspy.js")
	    	->addInput($bootstrapJsDir . "/tab.js")
	    	->addInput($bootstrapJsDir . "/transition.js")
            ->setOutput("js/bootstrap.js");

        $bootstrapIconsDir = $kernelRootDir . "/../vendor/" . static::BOOTSTRAP_PATH . "/fonts";
        $bootstrapIconsRegularEot = AssetConfiguration::create("bootstrap_icons_eot")
            ->addInput($bootstrapIconsDir . "/glyphicons-halflings-regular.eot")
            ->setOutput("fonts/glyphicons-halflings-regular.eot");

        $bootstrapIconsRegularSvg = AssetConfiguration::create("bootstrap_icons_svg")
            ->addInput($bootstrapIconsDir . "/glyphicons-halflings-regular.svg")
            ->setOutput("fonts/glyphicons-halflings-regular.svg");

        $bootstrapIconsRegularTtf = AssetConfiguration::create("bootstrap_icons_ttf")
            ->addInput($bootstrapIconsDir . "/glyphicons-halflings-regular.ttf")
            ->setOutput("fonts/glyphicons-halflings-regular.ttf");

        $bootstrapIconsRegularWoff = AssetConfiguration::create("bootstrap_icons_woff")
            ->addInput($bootstrapIconsDir . "/glyphicons-halflings-regular.woff")
            ->setOutput("fonts/glyphicons-halflings-regular.woff");

        $bootstrapLess = AssetConfiguration::create("bootstrap_less")
            ->addInput($kernelRootDir . "/../vendor/twitter/bootstrap/less/bootstrap.less")
            ->addFilter("lessphp")
            ->setOutput("css/bootstrap.css");

        $container->getDefinition("assetic.filter.lessphp")->setFile($kernelRootDir . "/../vendor/leafo/lessphp/lessc.inc.php");


        $worker = new DefinitionDecorator('assetic.worker.ensure_filter');
        $worker->replaceArgument(0, '/\.less$/');
        $worker->replaceArgument(1, new Reference('assetic.filter.lessphp'));
        $worker->addTag('assetic.factory_worker');

        $container->setDefinition('assetic.filter.lessphp.worker0', $worker);

        $assetManager = $container->getDefinition("assetic.asset_manager");

        // registering assets
        $this->register($assetManager, $jQueryJs);
        $this->register($assetManager, $jQueryUIJs);
        $this->register($assetManager, $jQueryUIi18nJs);
        $this->register($assetManager, $bootstrapJs);
        $this->register($assetManager, $bootstrapIconsRegularEot);
        $this->register($assetManager, $bootstrapIconsRegularSvg);
        $this->register($assetManager, $bootstrapIconsRegularTtf);
        $this->register($assetManager, $bootstrapIconsRegularWoff);
        $this->register($assetManager, $bootstrapLess);

        // registering form fields
        $container->setParameter('twig.form.resources', array('ArcanixBootstrapBundle:Form:fields.html.twig'));
    }

    private function register($assetManager, AssetConfiguration $assetConfiguration) {
        $assetManager->addMethodCall("setFormula", array(
            $assetConfiguration->getId(),
            $assetConfiguration->convertForRegistration()));
    }

}
