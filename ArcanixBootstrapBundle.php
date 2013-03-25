<?php

namespace Arcanix\BootstrapBundle;

use Arcanix\BootstrapBundle\DependencyInjection\Compiler\RegisterAssetsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ArcanixBootstrapBundle extends Bundle {
	
    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->addCompilerPass(new RegisterAssetsPass());
    }
	
}
