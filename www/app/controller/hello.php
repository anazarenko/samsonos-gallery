<?php
/**
 * Created by PhpStorm.
 * User: anazarenko
 * Date: 16.09.14
 * Time: 11:52
 */

/*
function hello()
{
    m()->view('hello');
}
*/

function hello($name = 'new user', $text = '')
{
    $arr = array(
        'name' => $name,
        'text' => $text
    );
    m()->view('hello')->set($arr);
}