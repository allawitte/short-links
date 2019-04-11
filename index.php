<?php
require_once 'Db.php';
//$db = new Db('links', 'root', '');
$db = new Db('allawi1q_links', 'allawi1q', 'zUmy%evedYtY');
$url = mb_substr( $_SERVER['REQUEST_URI'], 1);
$link = $db->getOriginalLink($url);
header("Location: $link");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        input {
            width: 80%;
        }
    </style>
    <meta charset="UTF-8">
    <title>short links</title>
</head>
<body>
<h1>Сервис коротких ссылок</h1>
<p class="link">
    <input type="text" placeholder="your URL">
    <button>Shorten</button>
</p>
<p class="res"></p>
<script src="script.js"></script>
</body>
</html>