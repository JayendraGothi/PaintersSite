<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Imagesmodel
 *
 * @author jayendra
 */
class Imagesmodel extends CI_Model {
    var $id = 0;
    var $url = '';
    var $category_id = 0;

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * 
     * @param type $url : url of the image
     * @param type $category_id : category of image
     */
    function insertImage($url, $category_id, $image_id) {
        $this->id = $image_id;
        $this->url = $url;
        $this->category_id = $category_id;
        if ($this->validateImage()) {
            $this->db->insert('images', $this);
            $data = $this->db->get_where('images',array('id' => $this->db->insert_id()));
            return $data->result_array();
        }
    }

    /**
     * 
     * @return boolean Returns True if all the validations are done.
     */
    function validateImage() {
        $status = true;
        if (is_null($this->url) || empty($this->url)) {
            $status = false;
        }
        $this->load->model('Categorymodel');
        if (is_null($this->category_id)
                && !is_integer($this->category_id)
                && is_null($this->Categorymodel->convertCategoryToName($this->category_id))) {
            $status = false;
        }
        return $status;
    }

    /**
     * 
     * @param type $id : category Id.
     * @return type : result set containing images related to category_id provided.
     */
    function categoryIdToImages($id) {
        if (!is_null($id)) {
            $records = $this->db->get_where('images', array('category_id' => $id));
            return $records->result_array();
        }
    }

    function deleteImage($id) {
        if (!is_null($id)) {
            $record = $this->db->delete('images', array('id' => $id));
            if (isset($record)) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * 
     * @return Id having value max among all the data in table Images
     */
    function getUniqueId(){
        $this->db->select_max('id','Max_id');
        $result = $this->db->get('images');
        $result = $result->first_row();
        $id = $result->Max_id+1;
        return $id;
    }
}

?>
