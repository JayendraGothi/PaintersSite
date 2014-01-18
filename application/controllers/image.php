<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of image
 *
 * @author jayendra
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Image extends CI_Controller {

    /**
     * Set all the validation rule where.
     */
    private function setValidationRules() {

        // Load Form Validation Library.
        $this->load->library('form_validation');

        // Set rule for category_id to check its Existance
        //$rules['category_id'] = "category_check";
        //$this->form_validation->set_message('category_check', "Category Do Not Exist");
        $this->form_validation->set_rules('category_id', 'Category_id', 'callback_category_check');
    }

    /**
     * Validation function for checking category_id Existance
     * @param type $id : category_id
     */
    public function category_check($id) {
        $this->load->model('Categorymodel');
        $this->form_validation->set_message('category_check', "Category Do Not Exist");
        return $this->Categorymodel->categoryExistsForId($id);
    }

    public function deleteImage($id) {
        $this->load->model('Imagesmodel');
        if ($this->Imagesmodel->deleteImage($id)) {
            return json_encode(array('status' => true));
        } else {
            return json_encode(array('status' => false));
        }
    }

    /**
     * 
     * This function adds image link to data base.
     * It also calls functions to upload and create thumbnail of an Image.
     */
    public function addImage() {
        print_r($_POST);
        print_r($_FILES);
        // Load Image Model.
        $this->load->model('Imagesmodel');
        $image_id = $this->Imagesmodel->getUniqueId();
        // set Validation Rules
        $this->setValidationRules();

        // Check if the post request is made and data entered is valid
        if ($this->form_validation->run() == TRUE) {
            $image = 'Category' . $_POST['category_id'] . '_' . $image_id;
            $upload_data = $this->uploadImage($_POST['category_id'], $image);
            if (is_null($upload_data)) {
                $data = $this->Imagesmodel->insertImage('CSS/Images/' . $image, $_POST['category_id'], $image_id);
                $data['message'] = "Image Successfully Added";
                $data['image_data'] = $this->load->view('imageEditor', $data, true);
            }else if(isset ($upload_data['error'])){
                $data['message'] = $upload_data['error'];
            }
            echo json_encode($data);
        } else {
            echo json_encode(array('message' => trim(validation_errors())));
        }
    }

    /**
     * Upload an image to specific location.
     * If any Error occurs
     *      return errorMessage 
     * else
     *      return null
     * @param type $id : Category Id
     */
    private function uploadImage($id, $Image) {

        // Initialize all the parameter required by upload library.
        $config['upload_path'] = BASEPATH . '../CSS/Images';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '1024';
        $config['file_name'] = $Image;

        // Load Upload Library.
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            // uploadImage
            $data = array('upload_data' => $this->upload->data());
            if (!$this->resizeImage($data['upload_data']['full_path'])) {
                return array('error' => "Error occured during resizing image");
            }
        }
        return null;
    }

    /**
     * Resize the image to create ThumbNail
     * @param type $sourceImage : Image name to be Resized.
     * @return type Boolean : true if resized properly else false.
     */
    private function resizeImage($sourceImage) {

        // Set all the required parameters for image_lib.
        $resize_data['image_library'] = 'gd2';
        $resize_data['source_image'] = $sourceImage;
        $resize_data['create_thumb'] = TRUE;
        $resize_data['maintain_ratio'] = FALSE;
        $resize_data['width'] = 200;
        $resize_data['height'] = 200;
        $resize_data['new_image'] = BASEPATH . '../CSS/Images/thumbnail';

        // Load Image_lib Library
        $this->load->library('image_lib', $resize_data);
        return $this->image_lib->resize();
    }

}

?>
