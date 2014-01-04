<div id="content">
    <div id="side_menu">
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

        <ul>
            <?php
            foreach ($categories as $category) {
                echo '<li><a href ="';
                echo '' . $category["id"] . '">' . $category["name"];
                echo '</a></li>';
            }
            ?>
        </ul>
    </div> 
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
</div>