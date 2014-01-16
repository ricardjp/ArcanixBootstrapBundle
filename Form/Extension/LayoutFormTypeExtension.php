<?php

namespace Arcanix\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Arcanix\BootstrapBundle\Form\Layout;
use Arcanix\BootstrapBundle\Form\FormLayout;
use Arcanix\BootstrapBundle\Form\HorizontalLayout;

class LayoutFormTypeExtension extends AbstractTypeExtension {
    
    public function buildView(FormView $view, FormInterface $form, array $options) {
        $view->vars["layout"] = $options["layout"];
        
        switch ($options["layout"]->getFormLayout()) {
            case FormLayout::HORIZONTAL:
            case FormLayout::INLINE:
                $view->vars["attr"]["class"] = "form-" . $options["layout"]->getFormLayout();
        }
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            "layout" => new Layout(FormLayout::VERTICAL, HorizontalLayout::COL_3_9),
        ));
    }
    
    public function getExtendedType() {
        return "form";
    }
    
}
