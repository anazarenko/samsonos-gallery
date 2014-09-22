<?php
/**
 * Created by PhpStorm.
 * User: anazarenko
 * Date: 22.09.2014
 * Time: 12:42
 */
?>
<form id="addPhotoForm" action="<?php url_base('gallery', 'save', 'list')?>" enctype="multipart/form-data" method="post">
    <input type="hidden" name="id" value="<?php iv('image_id')?>">
    <input type="hidden" class="__action" value="<?php url_base('gallery','upload')?>">
    <input type="hidden" class="__file_size" name="maxSize" value="1000000">
    <input class="__file_name" name="name" placeholder="name" value="<?php iv('image_name')?>">
    <textarea name="description" placeholder="description"><?php iv('image_description')?></textarea>
<input class="__upload" type="file" name="file" value="<?php iv('image_src')?>">
<input type="submit" value="Save!">
</form>