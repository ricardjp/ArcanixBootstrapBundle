<?php

namespace Arcanix\BootstrapBundle\Twig;

class ArcanixBootstrapExtension extends \Twig_Extension {
    
    public function getFunctions() {
        return array(
            "icon" => new \Twig_Function_Method($this, "icon", array(
                "is_safe" => array("html"),
            )),
            "inline" => new \Twig_Function_Method($this, "inline", array(
                "is_safe" => array("html"),
            )),
            "inline_group" => new \Twig_Function_Method($this, "inlineGroup", array(
                "is_safe" => array("html"),
            ))
        );
    }
    
    /**
     * Easy display of a bootstrap icon. Available icons are listed here:
     * http://getbootstrap.com/components/#glyphicons
     * 
     * @param type $name name of the icon, ex.: to display the asterisk icon,
     * the name should be set as "asterisk".
     * @return html snippet representing a Bootstrap icon.
     */
    public function icon($name) {
        return sprintf("<span class=\"glyphicon glyphicon-%s\"></span>", $name);
    }
    
    public function inline($html) {
        return sprintf("<span class=\"inline\">%s</span>", $html);
    }
    
    public function inlineGroup($html) {
        return sprintf("<span class=\"inline-group\">%s</span>", $html);
    }
    
    public function getName() {
        return "arcanix_bootstrap_extension";
    }
    
}
