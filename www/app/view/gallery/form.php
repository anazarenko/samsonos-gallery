<?php
/**
 * Created by PhpStorm.
 * User: anazarenko
 * Date: 16.09.14
 * Time: 13:22
 */
?>
<html>
<head>
    <style>
        form{
            width: 500px !important;
            margin: 20px auto !important;
            padding: 20px !important;
            border: 1px solid;
        }

        form>input, form>textarea{
            display: block;
            margin: 5px 0;
        }
    </style>
</head>
<html>

<form action="<?php url_base('gallery','save')?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php iv('image_id')?>">
    Name: <input name="name" value="<?php iv('image_name')?>">
    Description: <textarea name="description"><?php iv('image_description')?></textarea>
    <input type="file" name="file" value="<?php iv('image_src')?>">
    <input type="submit" value="Save!">
</form>

</html>