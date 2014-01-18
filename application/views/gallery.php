<div id="content">
    <div id="gallery">
        <div id="side_menu">
            <ul>
                <?php
                foreach ($categories as $category) {
                    echo '<li><a href = "';
                    echo base_url() . 'gallery/' . $category['id'] . '">';
                    echo $category["name"] . '</a></li>';
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
                        <img class="magniflier" src="" max-width="auto"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>/JS/jquery.event.drag-2.2.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/JS/jquery.event.drop-2.2.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/JS/jquery.roundabout.js"></script>
<script type = "text/javascript" src="<?php echo base_url(); ?>/JS/magnify.js"></script>
<script type = "text/javascript" src="<?php echo base_url(); ?>/JS/magnifier.js"></script>
<script type = "text/javascript" src="<?php echo base_url(); ?>/JS/gallery.js"></script>
