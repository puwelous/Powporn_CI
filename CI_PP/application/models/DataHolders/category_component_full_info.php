<?php

/*
 * Dataholder class representing ucreate component
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
     * @param type $componentObject
     *  Component instance
     * @param type $availableColours
     * Array of component colour
     * @param type $vectorObjects
     * Array of vector representations
     * @param type $rasterObject
     * Single raster representation
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
    
    public function __construct( $componentObject, $rastersArray, $vectorsArray ){
        $this->componentObject = $componentObject ;
        $this->rasters = $rastersArray ;
        $this->vectors = $vectorsArray;
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
}

/* End of file ucreate_component_full_info.php */
/* Location: ./application/models/ucreate_component_full_info.php */
