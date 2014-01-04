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

    public function deleteImage($id) {
        $this->load->model('Imagesmodel');
        if ($this->Imagesmodel->deleteImage($id)) {
            return json_encode(array('status' => true));
        } else {
            return json_encode(array('status' => false));
        }
    }

    public function uploadImage($id) {
        $this->load->helper('url');

        $config['upload_path'] = BASEPATH . '../CSS/Images';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['file_name'] = 'Category' . $id . '_' . $_POST['total_image'];

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $this->resizeImage($data['upload_data']['full_path']);
        }
    }

    private function resizeImage($sourceImage) {
        $resize_data['image_library'] = 'gd2';
        $resize_data['source_image'] = $sourceImage;
        $resize_data['create_thumb'] = TRUE;
        $resize_data['maintain_ratio'] = FALSE;
        $resize_data['width'] = 200;
        $resize_data['height'] = 200;
        $resize_data['new_image'] = BASEPATH . '../CSS/Images/thumbnail';

        $this->load->library('image_lib', $resize_data);
        print_r($this->image_lib->resize());
    }
}
?>
