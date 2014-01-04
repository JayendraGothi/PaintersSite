<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to Adithya's Gallery</title>
        <link rel="stylesheet" href="<?php echo base_url()?>/CSS/main.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>/CSS/Common.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>/CSS/normalize.css"/>
        <script type="text/javascript" src="<?php echo base_url()?>/JS/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>/JS/jquery.event.drag-2.2.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>/JS/jquery.event.drop-2.2.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>/JS/jquery.roundabout.js"></script>
        <script type = "text/javascript" src="<?php echo base_url()?>/JS/customizedJS.js"></script>
        <script type = "text/javascript" src="<?php echo base_url()?>/JS/magnify.js"></script>
        
    </head>
    <body id='body'>
        <div id="wrapper">
            <header>
                <div id="header">
                    <div id="display-photo">
                        <img src="<?php echo base_url()?>/CSS/Images/main_slider.jpg" />
                    </div>
                    <div id="main_menu">
                        <ul>
                            <li> <a href="<?php echo base_url();?>" class="active">Home </a></li>
                            <li> <a href="<?php echo base_url('gallery');?>" >Check My Gallery </a></li>
                            <li> <a href="#" >About Me </a></li>
                            <li> <a href="#" >Place Order </a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </header>