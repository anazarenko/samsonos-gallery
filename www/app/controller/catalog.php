<?php
/**
 * Created by PhpStorm.
 * User: anazarenko
 * Date: 16.09.14
 * Time: 12:10
 */

function catalog()
{
    $html = '';
    foreach (array('apple', 'banana', 'cucumber') as $item) {
        $html .= m()->view('catalog/item')->item($item)->output();
    }

    m()->view('catalog/index')->items($html)->title('Catalog');
}

?>