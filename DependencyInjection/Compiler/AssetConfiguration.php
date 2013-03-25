<?php

namespace Arcanix\BootstrapBundle\DependencyInjection\Compiler;

use Symfony\Component\Finder\Finder;

final class AssetConfiguration {

    private $id;
    private $inputs;
    private $filters;
    private $output;
    
    public function __construct($id) {
        $this->id = $id;
        $this->inputs = array();
        $this->filters = array();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setFinder(Finder $finder) {
        foreach ($finder as $file) {
            $this->addInput($file->getRealPath());
        }
        return $this;
    }
    
    public function addInput($input) {
        $this->inputs[] = $input;
        return $this;
    }
    
    public function getInputs() {
        return $this->inputs;
    }
    
    public function addFilter($filter) {
        $this->filters[] = $filter;
        return $this;
    }
    
    public function getFilters() {
        return $this->filters;
    }
    
    public function getOutput() {
        return $this->output;
    }
    
    public function setOutput($output) {
        $this->output = $output;
        return $this;
    }
    
    public function convertForRegistration() {
        return array(
            $this->inputs,
            $this->filters,
            array("output" => $this->output),
        );
    }
    
    /**
     * Sole purpose is to allow easier method chaining calls prior to PHP 5.4
     */
    public static function create($id) {
        return new AssetConfiguration($id);
    }
    
}
