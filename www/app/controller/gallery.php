<?php
/**
 * Created by PhpStorm.
 * User: anazarenko
 * Date: 16.09.14
 * Time: 12:59
 */

/** Gallery universal controller */
function gallery__HANDLER()
{
    // Call our list controller
    gallery_list();
}

/** Gallery images list controller action */
function gallery_list($sorter = null, $direction = 'ASC')
{
    // If no sorter is passed
    if(!isset($sorter)) {
        // Load sorter from session if it is there
        $sorter = isset($_SESSION['sorter']) ? $_SESSION['sorter'] : null;
        $direction = isset($_SESSION['direction']) ? $_SESSION['direction'] : null;
    }

    // Store sorting in a session
    $_SESSION['sorter'] = $sorter;
    $_SESSION['direction'] = $direction;


    // Rendered HTML gallery items
    $items = '';

    // Prepare db query object
    $query = dbQuery('gallery');

    // If sorter is passed
    if (isset($sorter)/* && in_array($sorter, array('date', 'type'))*/) {
        // Add sorting condition to db request
        $query->order_by($sorter, $direction);
    }

    // Iterate all records from "gallery" table
    foreach ($query->exec() as $dbItem) {
        /**@var \samson\activerecord\gallery $dbItem``` */

        /* Render view(output method) and pass object received fron DB and
         * prefix all its fields with "image_", return and gather this outputs
         * in $items
         */
        $items .= m()->view('gallery/item')->image($dbItem)->output();
    }

    /** Set window title and view to render, pass items variable to view */
    m()->view('gallery/index')->title('My gallery')->items($items);
}

/**
 * Gallery form controller action
 * @var string $id Item identifier
 */
function gallery_form($id = null)
{
    /*@var \samson\activerecord\gallery $dbItem */
    $dbItem = null;
    /*
     * Try to recieve one first record from DB by identifier,
     * if $id == null the request will fail anyway, and in case
     * of success store record into $dbItem variable
     */
    if (dbQuery('gallery')->id($id)->first($dbItem)) {
        // Handle success
    }

    // Set view file, title and pass, if it os set, found gallery item
    m()->view('gallery/form')->title('Gallery form')->image($dbItem);
}

/**
 * Gallery save controller action
 * @var string $id Item identifier
 */
function gallery_save()
{
    // If we have really received form data
    if (isset($_POST)) {

        /*@var \samson\activerecord\gallery $dbItem */
        $dbItem = null;

        // Clear received variable
        $id = isset($_POST['id']) ? filter_var($_POST['id']) : null;

        /*
         * Try to recieve one first record from DB by identifier,
         * in case of success store record into $dbItem variable,
         * otherwise create new gallery item
         */


        if (!dbQuery('gallery')->id($id)->first($dbItem)) {
            // Create new instance but without creating a db record
            $dbItem = new \samson\activerecord\gallery(false);
        }
        // At this point we can guarantee that $dbItem is not empty


        $tmp_name = $_FILES["file"]["tmp_name"];
        $name = $_FILES["file"]["name"];
        $imgsize = $_FILES["file"]["size"]/1024;


        // Create upload dir with correct rights
        if (!file_exists('upload')) {
            mkdir('upload', 0775);
        }

        $src = 'upload/'.$name;

        // If file has been created
        if (move_uploaded_file($tmp_name, $src)) {
            // Save image name
            $dbItem->name = filter_var($_POST['name']);
            // Save image description
            $dbItem->description = filter_var($_POST['description']);
            // Store file in upload dir
            $dbItem->src = $src;
            $dbItem->imgsize = $imgsize;
            $dbItem->save();
        } elseif (isset($id)){
            $dbItem->name = filter_var($_POST['name']);
            $dbItem->description = filter_var($_POST['description']);
            $dbItem->save();
        }
    }
    // Redirect to main page
    url()->redirect('gallery');
}



/**
 * Asynchronous controllers
 */

/** Gallery images list controller action */
function gallery_async_list($sorter = null, $direction = 'ASC')
{

    // If no sorter is passed
    if(!isset($sorter)) {
        // Load sorter from session if it is there
        $sorter = isset($_SESSION['sorter']) ? $_SESSION['sorter'] : null;
        $direction = isset($_SESSION['direction']) ? $_SESSION['direction'] : null;
    }

    // Store sorting in a session
    $_SESSION['sorter'] = $sorter;
    $_SESSION['direction'] = $direction;

    // Prepare db query object
    $query = dbQuery('gallery');

    // If sorter is passed
    if (isset($sorter)/* && in_array($sorter, array('date', 'type'))*/) {
        // Add sorting condition to db request
        $query->order_by($sorter, $direction);
    }

    $result = array('status' => '1', 'html_list' => '');
    // Iterate all records from "gallery" table
    foreach ($query->exec() as $dbItem) {
        /**@var \samson\activerecord\gallery $dbItem``` */

        /* Render view(output method) and pass object received fron DB and
         * prefix all its fields with "image_", return and gather this outputs
         * in $items
         */
        $result['html_list'] .= m()->view('gallery/item')->image($dbItem)->output();
    }

    /** Set window title and view to render, pass items variable to view */
    return $result;
}

function gallery_async_edit($id){

    if (dbQuery('gallery')->id($id)->first($dbItem)) {
        $dbItem->name = filter_var($_POST['name']);
        $dbItem->description = filter_var($_POST['description']);
        $dbItem->save();
    }

    return array('status' => '1');
}

function gallery_async_form($id = null)
{
    /*@var \samson\activerecord\gallery $dbItem */
    $dbItem = null;

    $result = array('status' => '1', 'html_form' => '');
    /*
     * Try to recieve one first record from DB by identifier,
     * if $id == null the request will fail anyway, and in case
     * of success store record into $dbItem variable
     */

    if (dbQuery('gallery')->id($id)->first($dbItem)) {
        // Handle success
    }

    // Set view file, title and pass, if it os set, found gallery item
    $result['html_form'] = m()->view('gallery/form')->title('Gallery form')->image($dbItem)->output();


    return $result;
}

function gallery_async_upload()
{
    $upload = new \samson\upload\Upload(array('jpg','JPG'));
    $upload->upload($filePath, $uploadName, $fileName);
    $_SESSION['filePath'] = $filePath;
    $_SESSION['uploadName'] = $uploadName;
    $_SESSION['fileName'] = $fileName;
    return array(
        'status'=>'1',
        'filePath'=> $filePath,
        'uploadName'=> $uploadName,
        'fileName'=> $fileName,
        'sessionFilePath'=> $_SESSION['filePath'],
        'sessionUploadName'=> $_SESSION['uploadName'],
        'sessionFileName'=> $_SESSION['fileName']
    );
}

function gallery_async_save()
{
    // If we have really received form data
    if (isset($_POST)) {

        /*@var \samson\activerecord\gallery $dbItem */
        $dbItem = null;

        $dbItem = new \samson\activerecord\gallery(false);

        $fileName = $_SESSION['fileName'];
        $uploadName = $_SESSION['uploadName'];

        unset($_SESSION['uploadName']);
        unset($_SESSION['fileName']);
        unset($_SESSION['filePath']);

        $imgsize = $_FILES["file"]["size"]/1024;

        $src = 'upload/'.$fileName;

        // Save image name
        $dbItem->name = /*$uploadName*/filter_var($_POST['name']);
        // Save image description
        $dbItem->description = filter_var($_POST['description']);
        // Store file in upload dir
        $dbItem->src = $src;

        $dbItem->imgsize = $imgsize;

        $dbItem->save();
    }
    return array(
        'status'=>'1'
    );
}

function gallery_async_delete($id)
{
    $dbItem = null;
    $result = array('status' => '1');
    if (dbQuery('gallery')->id($id)->first($dbItem)) {
        $dbItem->delete();
    }
    return $result;
}

