<?php

/**
 * Model class representing component's subcategories.
 * 
 * @author Pavol Daňo
 * @version 1.0
 * @file
 */
class Subcategory_model extends MY_Model {

    /**
     * @var string $_table
     *  Name of a database table. Used for CRUD abstraction in MY_Model class
     */
    public $_table = 'pp_subcategory';

    /**
     * @var string $primary_key
     *  Primary key in database schema for current table
     */
    public $primary_key = 'sbctgr_id';

    /**
     *
     * @var int $id
     *  Subcategory ID
     */
    private $id;

    /**
     *
     * @var string $name
     *  Subcategory name
     */
    private $name;

    /**
     *
     * @var string $description
     *  Subcategory description
     */
    private $description;

    /**
     *
     * @var int $category
     *  Category which this subcategory belongs to
     */
    private $category;    
    
    /**
     *
     * @var string $url
     *  URL to subcategory SVG icon representation
     */
    private $url;
    
    /**
     * 
     * @var array $protected_attributes
     *  Array of attributes that are not directly accesed via CRUD abstract model
     */
    public $protected_attributes = array('sbctgr_id');

    /**
     * Basic constructor calling parent CRUD abstraction layer contructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Constructor-like method for instantiating object of the class.
     * 
     * @param string $name
     *  Category name
     * @param string $description
     *  Category description
     * @param int $category
     *  Category ID
     * @param string $url
     *  URL to subcategory's icon
     */
    public function instantiate($name, $description, $category, $url) {

        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->url = $url;
    }

    /**
     * Inserts this object into a database. Database create operation
     * @return object
     *  NULL or object as a result of insertion
     */
    public function save() {

        return $this->subcategory_model->insert(
                        array(
                            'sbctgr_name' => $this->name,
                            'sbctgr_description' => $this->description,
                            'sbctgr_category_id' => $this->category,
                            'sbctgr_url' => $this->url
                ));
    }

    /**
     * Selects subcategory according to its ID passed as argument
     * @param int $subcategoryId
     *  ID of a subcategory
     * @return null|Subcategory_model
     *  Either NULL if such a subcategory does not exist or single subcategory model instance
     */
    public function get_subcategory_by_id($subcategoryId) {
        $result = $this->subcategory_model->get($subcategoryId);

        if (!$result) {
            return NULL;
        } else {
            $loaded_subcategory = new Subcategory_model();
            $loaded_subcategory->instantiate($result->sbctgr_name, $result->sbctgr_description, 
                    $result->sbctgr_category_id, $result->sbctgr_url);
            $loaded_subcategory->setId($result->sbctgr_id);

            return $loaded_subcategory;
        }
    }

    /**
     * Selects all subcategories from database
     * @return null|Subcategory_model
     *  Either NULL if there are no subcategories or array including all subcategory model instances
     */
    public function get_all_subcategories() {

        $subcategories = array();

        $this->db->order_by("sbctgr_name", "asc");
        $result_raw = $this->subcategory_model->as_object()->get_all();
        if (!$result_raw) {
            return NULL;
        }

        foreach ($result_raw as $subcategory_raw_instance) {
            $subcategory_instance = new Subcategory_model();
            $subcategory_instance->instantiate($subcategory_raw_instance->sbctgr_name, $subcategory_raw_instance->sbctgr_description, $subcategory_raw_instance->sbctgr_category_id, $subcategory_raw_instance->sbctgr_url);
            $subcategory_instance->setId($subcategory_raw_instance->sbctgr_id);

            $subcategories[] = $subcategory_instance;
        }

        return $subcategories;
    }

    /**
     * Removes this subcategory
     * @return int
     *  Result of subcategory removal. Usually ID of deleted subcategory or negative value if fails
     */
    public function remove() {
        return $this->subcategory_model->delete($this->id);
    }

    /*     * ********* setters *********** */

    /**
     * Setter for category ID
     * @param int $newId
     *  New category ID
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Setter for category name
     * @param string $newName
     *  New category name
     */
    public function setName($newName) {
        $this->name = $newName;
    }

    /**
     * Setter for category description
     * @param string $newDesc
     *  New category description
     */
    public function setDescription($newDesc) {
        $this->description = $newDesc;
    }
    
    /**
     * Setter for subcategory's category
     * @param int $newCategory
     *  Subcategory's new category
     */
    public function setCategory($newCategory) {
        $this->category = $newCategory;
    }    
    
    /**
     * Setter for category icon URL
     * @param string $newUrl
     *  New category icon URL
     */
    public function setURL($newUrl) {
        $this->url = $newUrl;
    }    

    /*     * ********* getters *********** */
    /**
     * Getter for category ID
     * @return int
     *  Category ID
     */
    public function getId() {
        return $this->id;
    }
    /**
     * Getter for category name
     * @return string
     *  Category name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Getter for category description
     * @return string
     *  Category description
     */
    public function getDescription() {
        return $this->description;
    }
    
    /**
     * Getter for subcategory's category (ID)
     * @return int
     *  Subcategory's category (ID)
     */
    public function getCategory() {
        return $this->category;
    }
    
    /**
     * Getter for category icon URL
     * @return string
     *  Category icon URL
     */
    public function getURL() {
        return $this->url;
    }    

}

/* End of file subcategory_model.php */
/* Location: ./application/models/subcategory_model.php */
