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
    <a href="<?php url_base('gallery', 'form')?>">ADD PHOTO |</a>
    <a href="<?php url_base('gallery', 'list', 'uploaded', 'asc')?>">DATE ASC |</a>
    <a href="<?php url_base('gallery', 'list', 'uploaded', 'desc')?>">DATE DESC |</a>
    <a href="<?php url_base('gallery', 'list', 'imgsize', 'asc')?>">SIZE ASC |</a>
    <a href="<?php url_base('gallery', 'list', 'imgsize', 'desc')?>">SIZE DESC</a>
</div>

<ul class="gallery">
    <?php iv('items')?>
</ul>

</body>
</html>
