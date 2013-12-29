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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */