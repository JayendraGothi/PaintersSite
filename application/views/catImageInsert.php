<div id="content">
    <!--Side Menu-->
    <div id="side_menu">

        <!--Form to enter new Category to data base-->
        <div id="category-form">
            <h2>Create Categories</h2>
            <div class="form-error">
            </div>
            <form class="form-category" 
                  action="<?php echo base_url() . 'gallery/' ?>validateCategory" 
                  method="post" 
                  name="category-form">
                <input type="text" name="name" value=""/><br>
                <input type="submit" value="Create" class="button"/>
            </form>
        </div>
        <!--Category Form End-->

        <!--List of all the Categories-->
        <ul>
            <?php
            foreach ($categories as $category) {
                echo '<li><a href ="';
                echo '' . $category["id"] . '">' . $category["name"];
                echo '</a></li>';
            }
            ?>
        </ul>
        <!--Category List End-->

    </div> 
    <!--Side Menu Ends-->

    <!--Display Images related to the Category-->
    <div id="image-display">
        <?php
        foreach ($images as $image) {
            $this->load->view("imageEditor", array('image' => $image));
        }
        ?>
    </div>
    <!--Images related to category Ends-->

    <!--From to add Image to DataBase
        This image id directly linked to the Category selected-->
    <div id="image-create">
        <div id="image-form">
            <h2>Add Image</h2>
            <div class="form-error"></div>
            <!--            <form enctype="multipart/form-data"
                              data-url="<?php //echo base_url() . 'image/addImage';  ?>" 
                              method="post"  name="category-form" id="form-image">
                            <input type="file" name="image" width="80%"/><br>
                            <input type="hidden" name="category_id" value="<?php //echo $id;  ?>" width="80%"/>
                            <input id="fileupload" type="file" name="files[]" data-url="server/php/" multiple>
                            <input type="submit" value="Upload" class="button"/>
                        </form>-->
            <input id="fileupload" type="file" name="files[]" data-url="<?php echo base_url() . 'image/addImage'; ?>" multiple>
            <div id="progress">
                <div class="bar" style="width: 0%;"></div>
            </div>
        </div>
    </div>
    <!--Add Image Form ends-->
</div>
<script src ="<?php echo base_url(); ?>JS/jquery.ui.widget.js"></script>
<script src ="<?php echo base_url(); ?>JS/jquery.iframe-transport.js"></script>
<script src ="<?php echo base_url(); ?>JS/jquery.fileupload.js"></script>
<script src="<?php echo base_url(); ?>JS/galleryform.js"></script>