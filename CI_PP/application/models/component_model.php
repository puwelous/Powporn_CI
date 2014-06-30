<?php

require_once( APPPATH . '/models/DataHolders/category_component_full_info.php');

/**
 * Model class representing component.
 * 
 * @author Pavol Daňo
 * @version 1.0
 * @file
 */
class Component_model extends MY_Model {
    /**
     * Proposed - component status
     */

    const COMPONENT_STATUS_PROPOSED = 'PROPOSED';
    /**
     * Declined unseen - component status
     */
    const COMPONENT_STATUS_DECLINED_UNSEEN = 'DECLINED_UNSEEN';
    /**
     * Declined seen - component status
     */
    const COMPONENT_STATUS_DECLINED_SEEN = 'DECLINED_SEEN';
    /**
     * Decline accepted - component status
     */
    const COMPONENT_STATUS_ACCEPTED = 'ACCEPTED';

    /**
     * @var string $_table
     *  Name of a database table. Used for CRUD abstraction in MY_Model class
     */
    public $_table = 'pp_component';

    /**
     * @var string $primary_key
     *  Primary key in database schema for current table
     */
    public $primary_key = 'cmpnt_id';

    /**
     *
     * @var int $id
     *  Component ID
     */
    private $id;

    /**
     *
     * @var string $name
     *  Component name
     */
    private $name;

    /**
     *
     * @var double $price
     *  Component price
     */
    private $price;

    /**
     *
     * @var string $acceptanceStatus
     *  Component acceptance status
     */
    private $acceptanceStatus;

    /**
     *
     * @var string $isStable
     *  Component is stable flag. If moveable then false, if static then true
     */
    private $isStable;

    /**
     *
     * @var int $creator
     *  Component's creator
     */
    private $creator;

    /**
     *
     * @var int $category
     *  Component's category
     */
    private $category;

    /**
     * 
     * @var array $protected_attributes
     *  Array of attributes that are not directly accesed via CRUD abstract model
     */
    public $protected_attributes = array('cmpnt_id');

    /**
     * Basic constructor calling parent CRUD abstraction layer contructor
     */
    public function __construct() {
        parent::__construct();
    }

    /* instance "constructor" */

    /**
     * Constructor-like method for instantiating object of the class.
     * 
     * @param string $name
     *  Component's name
     * @param double $price
     *  Component's price
     * @param string $acceptanceStatus
     *  Component's acceptance status
     * @param boolean $isStable
     *  Component's stable flag
     * @param int $creator
     *  Component's creator
     * @param int $category
     *  Component's category
     */
    public function instantiate($name, $price, $acceptanceStatus, $isStable, $creator, $category) {

        $this->name = $name;
        $this->price = $price;
        $this->acceptanceStatus = $acceptanceStatus;
        $this->isStable = $isStable;
        $this->creator = $creator;
        $this->category = $category;
    }

    /*     * * database operations ** */

    /**
     * Inserts this object into a database. Database create operation
     * @return object
     *  NULL or object as a result of insertion
     */
    public function save() {
        return $this->component_model->insert(
                        array(
                            'cmpnt_name' => $this->name,
                            'cmpnt_price' => $this->price,
                            'cmpnt_acceptance_status' => $this->acceptanceStatus,
                            'cmpnt_is_stable' => $this->isStable,
                            'cmpnt_creator_id' => $this->creator,
                            'cmpnt_category_id' => $this->category
                ));
    }

    /**
     * Updates this object and propagates to a database. Database update operation
     * @return object
     *  NULL or object as a result of update (ID)
     */
    public function update_component() {
        return $this->component_model->update(
                        $this->getId(), array(
                    'cmpnt_name' => $this->name,
                    'cmpnt_price' => $this->price,
                    'cmpnt_acceptance_status' => $this->acceptanceStatus,
                    'cmpnt_is_stable' => $this->isStable,
                    'cmpnt_creator_id' => $this->creator,
                    'cmpnt_category_id' => $this->category
                ));
    }

    /**
     * Selects single component instance according to it's ID
     * @param int $componentId
     *  ID of component
     * @return null|Component_model
     *  Either NULL if such a component does not exist or single component model instance
     */
    public function get_component_by_id($componentId) {
        $result = $this->component_model->get($componentId);

        if (!$result) {
            return NULL;
        } else {
            $loaded_component = new Component_model();
            $loaded_component->instantiate(
                    $result->cmpnt_name, $result->cmpnt_price, $result->cmpnt_acceptance_status, $result->cmpnt_is_stable, $result->cmpnt_creator_id, $result->cmpnt_category_id
            );
            $loaded_component->setId($result->cmpnt_id);

            return $loaded_component;
        }
    }

    /**
     * Selects all components from database
     * @return null|Component_model
     *  Either NULL if there are no components in database or array of all component model instances
     */
    public function get_all_components() {

        $components = array();

        //$this->db->order_by("ctgr_name", "asc");
        $this->db->order_by("cmpnt_category_id", "asc");
        $result_raw = $this->component_model->as_object()->get_all();

        if (!$result_raw) {
            return NULL;
        }

        foreach ($result_raw as $result) {
            $component_instance = new Component_model();
            $component_instance->instantiate(
                    $result->cmpnt_name, $result->cmpnt_price, $result->cmpnt_acceptance_status, $result->cmpnt_is_stable, $result->cmpnt_creator_id, $result->cmpnt_category_id
            );
            $component_instance->setId($result->cmpnt_id);

            $components[] = $component_instance;
        }

        return $components;
    }

    /**
     * Selects all components belonging to specific category 
     * @param int $categoryId
     *  Category of selected components
     * @return null|Component_model
     *  Either NULL if there are no components in database or array of all component model instances
     */
    public function get_components_by_category($categoryId) {

        $components = array();

        $result_raw = $this->component_model->get_many_by('cmpnt_category_id', $categoryId);

        if (!$result_raw) {
            return NULL;
        }

        foreach ($result_raw as $result) {
            $component_instance = new Component_model();
            $component_instance->instantiate(
                    $result->cmpnt_name, $result->cmpnt_price, $result->cmpnt_acceptance_status, $result->cmpnt_is_stable, $result->cmpnt_creator_id, $result->cmpnt_category_id
            );
            $component_instance->setId($result->cmpnt_id);

            $components[] = $component_instance;
        }

        return $components;
    }

    /**
     * Selects all proposed components
     * 
     * @return null|Component_model
     *  Either NULL if there are no proposed components or array of all proposed components
     */
    public function get_proposed_components() {
        return $this->get_components_by_status(Component_model::COMPONENT_STATUS_PROPOSED);
    }

    /**
     * Selects all accepted components
     * 
     * @return null|Component_model
     *  Either NULL if there are no accepted components or array of all accepted components
     */
    public function get_accepted_components() {
        return $this->get_components_by_status(Component_model::COMPONENT_STATUS_ACCEPTED);
    }

    /**
     * Selects all components having specified status
     * 
     * @param string $status
     *  Status of component
     * @return null|Component_model
     *  Either NULL if there are no specific components or array of all components specified by this status
     */
    private function get_components_by_status($status) {

        $components = array();

        $result_raw = $this->component_model->get_many_by('cmpnt_acceptance_status', $status);

        if (!$result_raw) {
            return NULL;
        }

        foreach ($result_raw as $result) {
            $component_instance = new Component_model();
            $component_instance->instantiate(
                    $result->cmpnt_name, $result->cmpnt_price, $result->cmpnt_acceptance_status, $result->cmpnt_is_stable, $result->cmpnt_creator_id, $result->cmpnt_category_id
            );
            $component_instance->setId($result->cmpnt_id);

            $components[] = $component_instance;
        }

        return $components;
    }

    /**
     * Selects all accepted components including info about category 
     * they belong to, raster representation, vector representation

     * @return null|array
     *  Either NULL if there are no specific accepted components or array of all accepted components including additional information
     */
    public function get_accepted_components_full_info() {
        $sql = 'SELECT cmpnt.cmpnt_category_id, ctgr.ctgr_name, ctgr.ctgr_url,
        cmpnt.cmpnt_id, cmpnt.cmpnt_name, cmpnt.cmpnt_price,
        raster.cmpnnt_rstr_rprsnttn_photo_url,
        vector.cmpnnt_vctr_rprsnttn_svg_definition,vector.cmpnnt_vctr_rprsnttn_point_of_view_id
, colour.cmpnt_clr_id, colour.cmpnt_clr_value, colour.cmpnt_clr_component_id
FROM pp_component cmpnt
LEFT JOIN pp_category ctgr
ON ( cmpnt.cmpnt_category_id = ctgr.ctgr_id)

LEFT JOIN pp_component_colour colour
ON (  cmpnt.cmpnt_id =  colour.cmpnt_clr_component_id )

LEFT JOIN pp_component_raster_representation raster
ON ( cmpnt.cmpnt_id = raster.cmpnnt_rstr_rprsnttn_component_id )
LEFT JOIN pp_component_vector_representation vector
ON ( cmpnt.cmpnt_id = vector.cmpnnt_vctr_rprsnttn_component_id )
WHERE
cmpnt.cmpnt_acceptance_status LIKE "ACCEPTED"
AND
(
(
raster.cmpnnt_rstr_rprsnttn_point_of_view_id = 1
AND vector.cmpnnt_vctr_rprsnttn_svg_definition IS NOT NULL
AND vector.cmpnnt_vctr_rprsnttn_point_of_view_id = 1
)
OR
(
cmpnt.cmpnt_acceptance_status LIKE "ACCEPTED"
AND raster.cmpnnt_rstr_rprsnttn_point_of_view_id = 1
AND vector.cmpnnt_vctr_rprsnttn_svg_definition IS NULL
)
)
ORDER BY cmpnt.cmpnt_category_id ASC, cmpnt.cmpnt_id ASC;';

        $query = $this->db->query($sql);

        if ($query->num_rows() <= 0) {
            return NULL;
        }

        $category_component_full_infos = array();
        $result = array();

        foreach ($query->result() as $raw_data) {
            // create category if does not exist
            if (!array_key_exists($raw_data->ctgr_name, $result)) {
                // create category model and put it into the array
                $loadedCategory = new Category_model();
                $loadedCategory->instantiate($raw_data->ctgr_name, NULL, $raw_data->ctgr_url); // no need for description so far
                $loadedCategory->setId($raw_data->cmpnt_category_id);
                $result[$raw_data->ctgr_name]['category'] = $loadedCategory;
                $result[$raw_data->ctgr_name]['special_components'] = array();
            }

            // check if such a special component is already in the result array or not (does entry exists for it or it does not)
            if (!array_key_exists($raw_data->cmpnt_name, $result[$raw_data->ctgr_name]['special_components'])) {

                $loadedComponent = new Component_model();
                $loadedComponent->instantiate(
                        $raw_data->cmpnt_name, $raw_data->cmpnt_price, Component_model::COMPONENT_STATUS_ACCEPTED, NULL, NULL, $raw_data->cmpnt_category_id);
                $loadedComponent->setId($raw_data->cmpnt_id);

                $rastersArray = array();
                $rastersArray[] = $raw_data->cmpnnt_rstr_rprsnttn_photo_url;

                $vectorsArray = array();
                $vectorsArray[] = $raw_data->cmpnnt_vctr_rprsnttn_svg_definition;

                $coloursArray = array();

                if (is_null($raw_data->cmpnt_clr_id) || is_null($raw_data->cmpnt_clr_value) || is_null($raw_data->cmpnt_clr_component_id)) {
                    // do nothing, add empty array as colours array
                } else {
                    $loadedColour = new Component_colour_model();
                    $loadedColour->instantiate($raw_data->cmpnt_clr_value, $raw_data->cmpnt_clr_component_id);
                    $loadedColour->setId($raw_data->cmpnt_clr_id);
                    $coloursArray[] = $loadedColour;
                }

                $specialComponent = new SpecialComponent($loadedComponent, $rastersArray, $vectorsArray, $coloursArray);

                $result[$raw_data->ctgr_name]['special_components'][$raw_data->cmpnt_name] = $specialComponent;
            } else {
                // get special component
                $specialComponent = $result[$raw_data->ctgr_name]['special_components'][$raw_data->cmpnt_name];

               if (is_null($raw_data->cmpnt_clr_id) || is_null($raw_data->cmpnt_clr_value) || is_null($raw_data->cmpnt_clr_component_id)) {
                    // do nothing, add empty array as colours array
                } else {
                    $loadedColour = new Component_colour_model();
                    $loadedColour->instantiate($raw_data->cmpnt_clr_value, $raw_data->cmpnt_clr_component_id);
                    $loadedColour->setId($raw_data->cmpnt_clr_id);
                    $specialComponent->addColour($loadedColour);
                }               

                $result[$raw_data->ctgr_name]['special_components'][$raw_data->cmpnt_name] = $specialComponent;
            }

            // add special component
//            $result[$raw_data->ctgr_name]['special_components'][] = $specialComponent;
        }


        foreach ($result as $category_name => $value) {
            $category_component_full_infos[] = new Category_component_full_info(
                            $value['category'], $value['special_components']);
        }
        //log_message('debug', print_r($category_component_full_infos, true));
        return $category_component_full_infos; //$ordered_products_full_info_array;
    }

    /**
     * Removes this component from database
     * @return int
     *  Result of a removal. Usually ID of removed component
     */
    public function remove() {
        return $this->component_model->delete($this->id);
    }

    /*     * ********* setters *********** */

    /**
     * Setter for component ID
     * @param int $newId
     *  New component ID
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Setter for component name
     * @param int $newName
     *  New component name
     */
    public function setName($newName) {
        $this->name = $newName;
    }

    /**
     * Setter for component price
     * @param int $newPrice
     *  New component price
     */
    public function setPrice($newPrice) {
        $this->price = $newPrice;
    }

    /**
     * Setter for component acceptance status
     * @param int $newAcceptanceStatus
     *  New component acceptance status
     */
    public function setAcceptanceStatus($newAcceptanceStatus) {
        $this->acceptanceStatus = $newAcceptanceStatus;
    }

    /**
     * Setter for component isStable flag
     * @param int $newIsStable
     *  New component isStable flag
     */
    public function setIsStable($newIsStable) {
        $this->isStable = $newIsStable;
    }

    /**
     * Setter for component creator
     * @param int $newCreator
     *  New component creator
     */
    public function setCreator($newCreator) {
        $this->creator = $newCreator;
    }

    /**
     * Setter for component category
     * @param int $newCategory
     *  New component category
     */
    public function setCategory($newCategory) {
        $this->category = $newCategory;
    }

    /*     * ********* getters *********** */

    /**
     * Getter for component ID
     * @return int
     *  Component ID
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Getter for component name
     * @return string
     *  Component name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Getter for component price
     * @return double
     *  Component price
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Getter for component acceptance status
     * @return string
     *  Component acceptance status
     */
    public function getAcceptanceStatus() {
        return $this->acceptanceStatus;
    }

    /**
     * Getter for component isStable flag
     * @return boolean
     *  Component isStable flag
     */
    public function getIsStable() {
        return $this->isStable;
    }

    /**
     * Getter for component creator
     * @return int
     *  Component creator
     */
    public function getCreator() {
        return $this->creator;
    }

    /**
     * Getter for component category
     * @return int
     *  Component category
     */
    public function getCategory() {
        return $this->category;
    }

}

/* End of file component_model.php */
/* Location: ./application/models/component_model.php */
