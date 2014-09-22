<?php
/**
 * Created by Vitaly Iegorov <egorov@samsonos.com>
 * on 23.05.14 at 13:01
 */

/** Universal main controller action */
function main__HANDLER()
{
    gallery_list();
    //m()->view('gallery/index')->title('Main page');
}

/** E404 - Page not found controller action */
function main_e404()
{
    m()->view('e404')->title('Page not found');
}
