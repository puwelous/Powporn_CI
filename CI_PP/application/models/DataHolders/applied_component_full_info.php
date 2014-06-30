<?php

/*
 * Dataholder class representing ucreate component
 * 
 * @author Pavol Daňo
 * @version 1.0
 * @file
 */
class Applied_component_full_info {

    /**
     *
     * @var int $componentId
     *  Component identifier
     */
    private $componentId;

    /**
     *
     * @var string $componentName
     *  Component name
     */
    private $componentName;  
    
    /**
     *
     * @var double $componentPrice
     *  Component price
     */
    private $componentPrice;     
    
    /**
     *
     * @var int $colourId
     *  Colour identifier
     */
    private $colourId; 
    /**
     *
     * @var string $colourValue
     *  HEX value of colour of applied component
     */
    private $colourValue;
    /**
     *
     * @var string $rasterUrl
     *  URL to raster representation of applied component
     */
    private $rasterUrl;

    /**
     * Constructor.
     * 
     * @param int $componentId
     *  Component identifier
     * @param int $colourId
     *  Colour identifier
     * @param string $colourValue
     *  HEX value of colour of applied component
     * @param string $rasterUrl
     *  URL to raster representation of applied component
     */
    public function __construct($componentId, $componentName, $componentPrice, $colourId, $colourValue, $rasterUrl) {

        $this->componentId = $componentId;
        $this->componentName = $componentName;
         $this->componentPrice = $componentPrice;
        $this->colourId = $colourId;
        $this->colourValue = $colourValue;
        $this->rasterUrl = $rasterUrl;
    }

    /**
     * Getter for component identifier
     * @return int 
     *  Component identifier
     */
    public function getComponentId() {
        return $this->componentId;
    }
    
    /**
     * Getter for component name
     * @return string
     *  Component name
     */
    public function getComponentName() {
        return $this->componentName;
    }    
    
    /**
     * Getter for component price
     * @return double
     *  Component price
     */
    public function getComponentPrice() {
        return $this->componentPrice;
    }     

    /**
     * Getter for colour identifier
     * @return int
     *  Colour identifier
     */
    public function getColourId() {
        return $this->colourId;
    }

    /**
     * Getter for colour value
     * @return string
     *  HEX colour value
     */
    public function getColourValue() {
        return $this->colourValue;
    }

    /**
     * Getter for raster
     * @return string
     *  URL to component raster representation
     */
    public function getRasterURL() {
        return $this->rasterUrl;
    }

}

/* End of file applied_component_full_info.php */
/* Location: ./application/models/DataHolders/applied_component_full_info.php */
