<?php
require_once 'Db.php';
$db = new Db('allawi1q_links', 'allawi1q', 'zUmy%evedYtY');
$url = json_decode($_POST['url']);
$pattern =  '/^(ftp|http|https):\/\/[^ "]+$/';
$res = preg_match($pattern, $url);
if(!$res) {
    echo 'no link';
    return;
}
echo json_encode($db->createLink($url));