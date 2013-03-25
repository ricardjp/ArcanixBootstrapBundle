<?php

/**
 * Copyright (c) 2011 Mohrenweiser & Partner, Philipp A. Mohrenweiser
 * - http://www.mohrenweiserpartner.de
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Arcanix\BootstrapBundle\Form\Extension;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Exception\FormException;

class WidgetCollectionFormTypeExtension extends AbstractTypeExtension
{
    protected $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if ($options['widget_add_btn'] != null && !is_array($options['widget_add_btn'])) {
            throw new FormException('The "widget_add_btn" option must be an "array".');
        } elseif ($options['widget_add_btn'] != null) {
            if (isset($options['widget_add_btn']['attr']) && !is_array($options['widget_add_btn']['attr'])) {
                throw new FormException('The "widget_add_btn.attr" option must be an "array".');
            }
            if (!isset($options['widget_add_btn']['attr'])) {
                $options['widget_add_btn']['attr'] = $this->options['widget_add_btn']['attr'];
            }
            if (!isset($options['widget_add_btn']['label']) && !isset($options['widget_add_btn']['icon'])) {
                throw new FormException('Provide either "icon" or "label" to "widget_add_btn"');
            }
            if (!isset($options['widget_add_btn']['icon']) && $this->options['widget_add_btn']['icon'] != null) {
                $options['widget_add_btn']['icon'] = $this->options['widget_add_btn']['icon'];
            }
        }
        if ($options['widget_remove_btn'] != null && !is_array($options['widget_remove_btn'])) {
            throw new FormException('The "widget_remove_btn" option must be an "array".');
        } elseif ($options['widget_remove_btn'] != null) {
            if (isset($options['widget_remove_btn']) && !is_array($options['widget_remove_btn'])) {
                throw new FormException('The "widget_remove_btn" option must be an "array".');
            }
            if (!isset($options['widget_remove_btn']['attr'])) {
                $options['widget_remove_btn']['attr'] = $this->options['widget_remove_btn']['attr'];
            }
            if (!isset($options['widget_remove_btn']['label']) && !isset($options['widget_remove_btn']['icon'])) {
                 throw new FormException('Provide either "icon" or "label" to "widget_remove_btn"');
            }
            if (!isset($options['widget_remove_btn']['icon']) && $this->options['widget_remove_btn']['icon'] != null) {
                $options['widget_remove_btn']['icon'] = $this->options['widget_remove_btn']['icon'];
            }
        }
        $view->vars['omit_collection_item'] = $options['omit_collection_item'];
        $view->vars['widget_add_btn'] = $options['widget_add_btn'];
        $view->vars['widget_remove_btn'] = $options['widget_remove_btn'];
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'omit_collection_item' => false,
            'widget_add_btn' => null,
            'widget_remove_btn' => null,
        ));
    }
    public function getExtendedType()
    {
        return 'form';
    }
}
