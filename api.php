<?php

header('content-type:application/json');
$request = $_SERVER['REQUEST_METHOD'];
switch ($request) {
    case 'GET':
        index();
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        store($data);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        update($data);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        delete($data);
        break;

    default:
        echo '{"name":" data not found"}';
        break;

}

//data show=========================

function index()
{
    require "db.php";

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = [];
        while ($r = mysqli_fetch_assoc($result)) {
            $row['result'][] = $r;
        }
        echo json_encode($row);
    } else {
        echo '{"result":"data not found"}';
    }
}


//data store======================
function store($data)
{
    require "db.php";
$name = $data['name'];
$email = $data['email'];
    $sql = "insert into users (name, email,created_at) VALUES ('$name','$email','NOW()')";
    if(mysqli_query($conn, $sql)){
        echo '{"result":"Data insert Successfully"}';
    }else{
        echo '{"result":"Data insert fail"}';
    }
}

//data update===============

function update($data)
{ include "db.php";
    $id = $data['id'];
    $name = $data['name'];
    $email = $data['email'];
    $sql = "update users set name='$name', email='$email', created_at=  NOW() where id= $id";
    if(mysqli_query($conn, $sql)){
        echo '{"result":"Data update Successfully"}';
    }else{
        echo '{"result":"Data update fail"}';
    }
}

function delete($data){
    include "db.php";
    $id = $data['id'];

    $sql = "delete from users  where id= $id";
    if(mysqli_query($conn, $sql)){
        echo '{"result":"Data delete Successfully"}';
    }else{
        echo '{"result":"Data delete fail"}';
    }
}