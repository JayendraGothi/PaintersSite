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
    function insertImage($url, $category_id) {
        $this->url = $url;
        $this->category_id = $category_id;
        if ($this->validateImage()) {
            $this->db->insert('images', $this);
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
            $records = $this->db->get_where('images', array('category_id'=> $id));
            return $records->result_array();
        }
    }
    
    function deleteImage($id){
        if(!is_null($id)){
            $record = $this->db->delete('images', array('id'=>$id));
            if(isset($record)){
                return true;
            }
        }
        return false;
    }
}

?>
