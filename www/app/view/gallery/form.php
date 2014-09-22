<?php
/**
 * Created by PhpStorm.
 * User: anazarenko
 * Date: 16.09.14
 * Time: 13:22
 */
?>
<form id="editForm" action="<?php url_base('gallery','edit', 'image_id', 'list')?>" method="post" enctype="multipart/form-data">
    <h2>Edit Form</h2>
    <input type="hidden" name="id" value="<?php iv('image_id')?>">
    Name: <input name="name" value="<?php iv('image_name')?>">
    Description: <textarea name="description"><?php iv('image_description')?></textarea>
    <input type="submit" value="Edit!">
</form>
