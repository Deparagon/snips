<?php

require_once dirname(__FILE__).'/init.php';

function add($object)
{
    $o = new $object();
    $o->validate();
    $a = $o->add();

    if (is_object($a)) {
         echo json_encode(array('status'=>'OK', 'message'=>'successfully added '.$object));
        exit;
    } else {
         echo json_encode(array('status'=>'OK', 'message'=>'Could not add new '.$object));
        exit;
    }
}

function update($object)
{
    $id = Tools::getValue('id');
    $o = new $object($id);
    $o->validate();
    $o->updated_at = date('Y-m-d H:i:s');
    $a = $o->save();

    if (is_object($a)) {
         echo json_encode(array('status'=>'OK', 'message'=>'successfully updated '.$object));
        exit;
    } else {
         echo json_encode(array('status'=>'NK', 'message'=>'Cound not update '.$object));
        exit;
    }
}

function search($object)
{
    $o = new $object();
    $keyword = Tools::getValue('keyword');

    if ($keyword !='') {
        $response = $o->search($keyword);
        echo json_encode($response);
        exit;
    }
}

function view($object)
{
    $id = Tools::getValue('id');
    $o = new $object($id);
    
    if ((int) $o->id ==0) {
        echo json_encode(array('status'=>'NK', 'message'=>'Could not load view from details supplied'));
        exit;
    }

    $response =$o->view();
    
    echo json_encode($response);
    exit;
}

function delete($object)
{
    $id = (int) Tools::getValue('id');
    $o = new $object($id);
    $o->doDelete();
    
    echo json_encode(array('status'=>'OK', 'message'=>'successfully deleted '.$object));
        exit;
}


if (!isset($_POST) && !isset($_GET)) {
    echo json_encode(array('status'=>'NK', 'message'=>'Invalid request'));
    exit;
}

if (!isset($_POST['token']) && $_GET['token']) {
    echo json_encode(array('status'=>'NK', 'message'=>'Post/Get request does not have a valid token'));
    exit;
}

$token =Tools::getValue('token');
$action = Tools::getValue('action');
$object = Tools::getValue('object');

if ($token =='') {
    echo json_encode(array('status'=>'NK', 'message'=>'Request most have a valid token'));
    exit;
}

if ($action =='') {
    echo json_encode(array('status'=>'NK', 'message'=>'No Action was provided for this request'));
    exit;
}

if ($object =='') {
    echo json_encode(array('status'=>'NK', 'message'=>'Request object was not provided'));
    exit;
}

if (function_exists($action)) {
    $action($object);
}


echo json_encode(array('status'=>'OK', 'message'=>'no function found'));
exit;
