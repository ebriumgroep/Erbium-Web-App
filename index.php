<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/10/29
 * Time: 20:02
 */

session_start();
if(isset($_SESSION['sid'])){
    header("Location:main.html");
    exit();
}else{
    header("Location:signin.html");
    exit();
}