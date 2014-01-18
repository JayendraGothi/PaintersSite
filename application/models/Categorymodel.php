<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categorymodel
 *
 * @author jayendra
 */
class Categorymodel extends CI_Model {

    var $name = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * 
     * @param type $id : id of the category
     * @return type : The Category Name
     */
    function convertCategoryToName($id) {
        // Check if the table Exists
        if ($this->db->table_exists("category")) {

            // Get the record associated with the id provided
            $record = $this->db->get_where('category', array('id' => $id));

            // Checks if data Exists if not returns no data found
            if ($record->num_rows() > 0) {
                return $record->first_row()->name;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * 
     * @param type $limit :  Number of rows needed
     * @return type : Array containing all the categories
     */
    function getCategories($limit) {
        if (is_null($limit)) {
            $records = $this->db->get('category');
            return $records->result_array();
        } else {
            $records = $this->db->get('category', $limit);
            return $records->result_array();
        }
    }

    /**
     * 
     * @param type $category : Category to be inserted.
     * @return type : array containing status of insert.
     */
    function insertCategory($category) {
        if (!is_null($category) && is_string($category)) {
            if (!$this->categoryExists($category)) {
                $this->name = $category;
                $this->db->insert('category', $this);
                $data = $this->db->get_where('category', array('id' => $this->db->insert_id()))->result_array();
                return array('id' => $data[0]['id'],
                    'name' => $data[0]['name'],
                    'message' => '<p>Category Successfully Added</p>'
                );
            } else {
                return array("error" => true, "message" => "Category Already Exists");
            }
        } else {
            return array("error" => true, "message" => "Category cannot be null and It should be a string value");
        }
    }

    /**
     * 
     * @param type $category : name of the Category
     * @return boolean : Returns true if the Category Already Exists else returns false.
     */
    function categoryExists($category) {
        if (is_string($category)) {
            $record = $this->db->get_where('category', array("name" => $category));
            if ($record->num_rows() > 0) {
                return true;
            }
        }
        return false;
    }
    /**
     * Check id the id provided holds any category
     * if yes
     *      return true
     * else
     *      return false
     * @param type $id : category_id
     * 
     */
    function categoryExistsForId($id){
        $result = $this->db->get_where('category', array('id'=>$id));
        if(isset($result) && !is_null($result)){
            return true;
        }
        return false;
    }

}
