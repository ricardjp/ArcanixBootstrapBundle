<?php

namespace Arcanix\ArcanixBootstrapBundle\DependencyInjection\Compiler;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class RegisterAssetsPass implements CompilerPassInterface {
	
	public function process(ContainerBuilder $container) {
		$kernelRootDir = $container->getParameter("kernel.root_dir");
		
		// assets
		$bootstrapJs = array(
			array(
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-transition.js",
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-alert.js",
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-modal.js",
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-dropdown.js",
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-scrollspy.js",
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-tab.js",
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-tooltip.js",
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-popover.js",
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-button.js",
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-collapse.js",
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-carousel.js",
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-typeahead.js",
				$kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/js/bootstrap-affix.js",
			),
			array(),
			array(),
		);
		
		$bootstrapLess = array(
				array($kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/less/bootstrap.less"),
				array("lessphp"),
				array()
		);
		
		$bootstrapResponsiveLess = array(
			array($kernelRootDir . "/../vendor/twitter/bootstrap/twitter/bootstrap/less/responsive.less"),
			array("lessphp"),
			array(),
		);
		
		$formulae["bootstrap_js"] = $bootstrapJs;
		$formulae["bootstrap_less"] = $bootstrapLess;
		$formulae["bootstrap_responsive_less"] = $bootstrapResponsiveLess;
		
		
		$container->getDefinition("assetic.filter.lessphp")->setFile($kernelRootDir . "/../vendor/leafo/lessphp/lessc.inc.php");
		

			$worker = new DefinitionDecorator('assetic.worker.ensure_filter');
			$worker->replaceArgument(0, '/\.less$/');
			$worker->replaceArgument(1, new Reference('assetic.filter.lessphp'));
			$worker->addTag('assetic.factory_worker');
		
			$container->setDefinition('assetic.filter.lessphp.worker0', $worker);
		
		$am = $container->getDefinition("assetic.asset_manager");
		$am->addMethodCall('setFormula', array("bootstrap_js", $formulae["bootstrap_js"]));
		$am->addMethodCall('setFormula', array("bootstrap_less", $formulae["bootstrap_less"]));
		$am->addMethodCall('setFormula', array("bootstrap_responsive_less", $formulae["bootstrap_responsive_less"]));
		
		$container->setParameter('twig.form.resources', array('ArcanixBootstrapBundle:Form:fields.html.twig'));
	}
	
}