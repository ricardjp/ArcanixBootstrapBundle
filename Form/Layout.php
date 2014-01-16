<?php

namespace Arcanix\BootstrapBundle\Form;

final class Layout {

    private $formLayout;
    private $horizontalLayout;
    
    public function __construct(
            $formLayout,
            $horizontalLayout = HorizontalLayout::COL_3_9) {
        
        $this->formLayout = $formLayout;
        $this->horizontalLayout = $horizontalLayout;
    }
    
    public function getFormLayout() {
        return $this->formLayout;
    }
    
    public function getHorizontalLayout() {
        return $this->horizontalLayout;
    }
    
    public function getHorizontalLabelClass() {
        return HorizontalLayout::getLabelClass($this->horizontalLayout);
    }
    
    public function getHorizontalInputWrapperClass() {
        return HorizontalLayout::getInputWrapperClass($this->horizontalLayout);
    }
    
}
