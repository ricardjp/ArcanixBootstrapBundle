<?php

namespace Arcanix\BootstrapBundle\Form\Extension;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class PrependAndAppendInputFormTypeExtension extends AbstractTypeExtension {

    public function buildView(FormView $view, FormInterface $form, array $options) {
        $view->vars['prefix'] = $options['prefix'];
        $view->vars['suffix'] = $options['suffix'];
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'prefix' => null,
            'suffix' => null,
        ));
    }
    
    public function getExtendedType() {
        return 'form';
    }
    
}
