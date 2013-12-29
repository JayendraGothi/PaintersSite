<div id="content">
    <div id="gallery">
        <div id="side_menu">
            <ul>
                <?php
                foreach ($categories as $category) {
                    echo '<li><a href = "#">' . $category["name"] . '</a></li>';
                }
                ?>
            </ul>
        </div>
        <div id="image_gallery">
            <div id="slider">
                <div id="gallery_slider">
                    <?php
                    foreach ($images as $image) {
                        echo '<img src = "' . base_url() . $image["url"] . '">';
                    }
                    ?>
                </div>
            </div>
            <div id="bigger_image">
                <div id="bigger-image-background">
                    <div class="product">
                        <img class="magniflier" src="<?php echo base_url() ?>/CSS/Images/main_slider.jpg" max-width="auto"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>