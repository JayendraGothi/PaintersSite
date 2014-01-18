<div class = "image-holder">
    <img src = "<?php echo base_url() . $image["url"]; ?>"/>
    <div class = "image-operations">
        <a href = "<?php echo base_url() . 'image/deleteImage/id/' . $image['id']; ?>" >
            delete
        </a>
    </div>
</div>

