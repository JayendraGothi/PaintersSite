<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery extends CI_Controller {

    /**
     * Index Page for this controller.
     */
    public function index($id = 1) {
        // get all the categories to display.
        $this->load->model('Categorymodel');
        $categories = $this->Categorymodel->getCategories(null);

        // Get Images related to the Category
        $this->load->model('Imagesmodel');
        $images = $this->Imagesmodel->categoryIdToImages($id);


        //Load URL Helper Class
        $this->load->helper('url');

        // Load all the views
        $this->load->view('header');
        $this->load->view('gallery', array("categories" => $categories, "images" => $images));
        $this->load->view('footer');
    }

    public function createCategory($id = 1) {
        // Load CategoryModel
        $this->load->model('Categorymodel');

        // Get Images related to the Category
        $this->load->model('Imagesmodel');
        $images = $this->Imagesmodel->categoryIdToImages($id);

        //Load URL Helper Class
        $categories = $this->Categorymodel->getCategories(null);
        $this->load->helper('url');
        $this->load->view('header');
        $this->load->view('catImageInsert', array('categories' => $categories, 'images' => $images, 'id' => $id));
        $this->load->view('footer');
    }

    public function validateCategory() {
        $this->load->model('Categorymodel');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[category.name]');
        $this->form_validation->set_message('required', "Category Cannot be Empty");
        $this->form_validation->set_message('is_unique', "Category Already Exists");
        // Check if the post request is made and data entered is valid
        if ($this->form_validation->run() == TRUE) {
            $data = $this->Categorymodel->insertCategory($_POST['name']);
            echo json_encode($data);
        }else{
            echo json_encode(array('message'=>trim(validation_errors())));
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */