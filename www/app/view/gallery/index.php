<?php
/**
 * Created by PhpStorm.
 * User: anazarenko
 * Date: 16.09.14
 * Time: 13:08
 */
?>
<html>
<head>
    <style>
        div.sorter{
            width: 70%;
            margin: 10px auto;
            text-align: center;
        }

        ul.gallery{
            width: 70%;
            margin: 10px auto;
        }

        ul.gallery li{
            margin: 5px;
            display: inline-block;
        }

        ul.gallery img{
            height: 150px;
            display: block;
        }
    </style>
    <link href="/css/add-form.css" rel="stylesheet">
</head>
<body>



<div class="sorter">
    <a id="addPhotoBtn" href="<?php url_base('gallery', 'form')?>">ADD PHOTO |</a>
    <a href="<?php url_base('gallery', 'list', 'uploaded', 'asc')?>">DATE ASC |</a>
    <a href="<?php url_base('gallery', 'list', 'uploaded', 'desc')?>">DATE DESC |</a>
    <a href="<?php url_base('gallery', 'list', 'imgsize', 'asc')?>">SIZE ASC |</a>
    <a href="<?php url_base('gallery', 'list', 'imgsize', 'desc')?>">SIZE DESC</a>
</div>

<form id="addPhotoForm" action="<?php url_base('gallery', 'save', 'list')?>" enctype="multipart/form-data" method="post">
    <h2>Add New Photo</h2>
    <input type="hidden" name="id" value="<?php iv('image_id')?>">
    <input type="hidden" class="__action" value="<?php url_base('gallery','upload')?>">
    <input type="hidden" class="__file_size" name="maxSize" value="1000000">
    <input class="__file_name" name="name" placeholder="name" value="<?php iv('image_name')?>">
    <textarea name="description" placeholder="description"><?php iv('image_description')?></textarea>
    <input class="__upload" type="file" name="file" value="<?php iv('image_src')?>">
    <input type="submit" value="Save!">
</form>

<section id="addNewPhotoSection"></section>
<section id="editFormSection"></section>

<ul class="gallery">
    <?php iv('items')?>
</ul>

</body>
</html>
