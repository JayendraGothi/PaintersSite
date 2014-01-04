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
        <?php foreach ($images as $image) { ?>
            <div class="image-holder">
                <img src="<?php echo base_url() . $image["url"]; ?>"/>
                <div class="image-operations">
                    <a href ="<?php echo base_url() . 'image/deleteImage/id/' . $image['id']; ?>" >
                        delete
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
    <!--Images related to category Ends-->
    
    <!--From to add Image to DataBase
        This image id directly linked to the Category selected-->
    <div id="image-create">
        <div id="image-form">
            <h2>Add Image</h2>
            <div class="form-error"></div>
            <form enctype="multipart/form-data" 
                  action="<?php echo base_url() . 'image/uploadImage/id/' . $id ?>" 
                  method="post"  name="category-form">
                <input type="file" name="image" width="80%"/><br>
                <input type="hidden" name="total_image" value="<?php echo sizeof($images) + 1 ?>" width="80%"/><br>
                <input type="submit" value="Upload" class="button"/>
            </form>
        </div>
    </div>
    <!--Add Image Form ends-->
    
</div>