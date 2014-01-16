<?php

namespace Arcanix\BootstrapBundle\Form;

class HorizontalLayout {
    
    const COL_1_11 = "col_1_11";
    const COL_2_10 = "col_2_10";
    const COL_3_9 = "col_3_9";
    const COL_4_8 = "col_4_8";
    const COL_5_7 = "col_5_7";
    const COL_6_6 = "col_6_6";
    const COL_7_5 = "col_7_5";
    const COL_8_4 = "col_8_4";
    const COL_9_3 = "col_9_3";
    const COL_10_2 = "col_10_2";
    const COL_11_1 = "col_11_1";
    
    public static function getLabelClass($horizontalLayout) {
        $horizontalLayoutParts = explode("_", $horizontalLayout);
        return "col-sm-" . $horizontalLayoutParts[1];
    }
    
    public static function getInputWrapperClass($horizontalLayout) {
        $horizontalLayoutParts = explode("_", $horizontalLayout);
        return "col-sm-" . $horizontalLayoutParts[2];
    }
    
}
