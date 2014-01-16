<?php

namespace Arcanix\BootstrapBundle\Form\Extension;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class CollectionFormTypeExtension extends AbstractTypeExtension {
    
    public function buildView(FormView $view, FormInterface $form, array $options) {
        $view->vars["prototype_names"] = $options["prototype_names"];
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            "prototype_names" => array(),
        ));
    }
    
    public function getExtendedType() {
        return 'form';
    }
    
}
