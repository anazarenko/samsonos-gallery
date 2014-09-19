<?php
/**
 * Created by PhpStorm.
 * User: anazarenko
 * Date: 16.09.14
 * Time: 13:22
 */
?>

<form action="<?php url_base('gallery','save')?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php iv('image_id')?>">
    Name: <input name="name" value="<?php iv('image_name')?>">
    Description: <textarea name="description"><?php iv('image_description')?></textarea>
    <input type="file" name="file" value="<?php iv('image_src')?>">
    <input type="submit" value="Save!">
</form>
