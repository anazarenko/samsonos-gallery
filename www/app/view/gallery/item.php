<?php
/**
 * Created by PhpStorm.
 * User: anazarenko
 * Date: 16.09.14
 * Time: 13:08
 */
?>

<li>
    <img src="<?php iv('image_src')?>" alt="<?php iv('image_name')?>">
    <p><?php iv('image_uploaded')?> | <?php iv('image_imgsize')?> кб</p>
    <p class="description" style="height: 20px; overflow: hidden"><?php iv('image_description')?></p>
    <a class="btn edit" href="<?php url_base('gallery', 'form', 'image_id')?>">Edit |</a>
    <a class="btn delete" href="<?php url_base('gallery', 'delete', 'image_id', 'list')?>">Delete</a>
</li>

