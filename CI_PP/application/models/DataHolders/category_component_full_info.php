<?php

/*
 * Dataholder class representing category and component merged DB data
 * 
 * @author Pavol Daňo
 * @version 1.0
 * @file
 */

class Category_component_full_info {

    /**
     *
     * @var object $categoryObject
     *  Category instance
     */
    private $categoryObject; // Category_model object    

    /**
     *
     * @var object $componentObject
     *  Component instance
     */
    private $specialComponentObjects; // Component_model object

    
    /**
     * Constructor.
     * 
     * @param Object $categoryObject
     *  Object instance of category class
     * @param type $specialComponentObjects
     *  Array of SpecialComponent objects associated with category
     */
    public function __construct($categoryObject, $specialComponentObjects ) {

        $this->categoryObject = $categoryObject;
        $this->specialComponentObjects = $specialComponentObjects;
    }

    /**
     * Getter for category object
     * @return object 
     *  Category instance
     */
    public function getCategory() {
        return $this->categoryObject;
    }    
    
    /**
     * Getter for component object
     * @return object 
     *  Component instance
     */
    public function getSpecialComponents() {
        return $this->specialComponentObjects;
    }
}

class SpecialComponent {
    
    private $componentObject;
    
    private $rasters;
    
    private $vectors;
    
    private $colours;
    
    public function __construct( $componentObject, $rastersArray, $vectorsArray, $colours ){
        $this->componentObject = $componentObject ;
        $this->rasters = $rastersArray ;
        $this->vectors = $vectorsArray;
        $this->colours = $colours;
    }
    
    /**
     * Getter for component object
     * @return object 
     *  Component object
     */    
    public function getComponentObject(){
        return $this->componentObject;
    }
    
    /**
     * Getter for vector data array
     * @return array 
     *  Vector data
     */
    public function getVectors() {
        return $this->vectors;
    }
    
    /**
     * Getter for raster data array
     * @return array 
     *  Raster data
     */
    public function getRasters() {
        return $this->rasters;
    }
    
    /**
     * Getter for components colours array
     * @return array 
     *  Component's colour
     */
    public function getColours() {
        return $this->colours;
    }
    
    /**
     * Adds new colour to the existing list
     * @param Component_colour_model $colour
     *  New colour to be added to the list
     */
    public function addColour(Component_colour_model $colour ){
        $this->colours[] = $colour;
    }
}

/* End of file category_component_full_info.php */
/* Location: ./application/models/category_component_full_info.php */
