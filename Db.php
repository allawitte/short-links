<?php

class Db
{
    function __construct($db, $login, $pass)
    {
        try {
            //$this->db = new PDO("mysql:host=localhost;dbname=$db; charset=utf8;", $login, $pass);
            $this->db = new PDO("mysql:host=localhost;dbname=$db; charset=utf8;", $login, $pass);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        $sql = "CREATE TABLE IF NOT EXISTS links (id INT PRIMARY KEY AUTO_INCREMENT, link VARCHAR(150), short_link VARCHAR(50))";
        $this->db->exec($sql);
    }

    function isUrlExists($url)
    {
        $sql = "SELECT short_link FROM links WHERE link='" . $url . "'";
        $res = $this->db->query($sql);
        $links = $res->fetchAll(PDO::FETCH_ASSOC);
        return (count($links));
    }

    function update($url){
        $short = $this->makeShort($url);
        $sql = "UPDATE  links SET short_link='".$short."' WHERE link='".$url."'";
        $this->db->exec($sql);
        return $short;
    }

    function createLink($url){
        if($this->isUrlExists($url)){
            return $this->update($url);
        }
            return $this->save($url);
    }

    function save($url){
        $short = $this->makeShort();
        $sql = "INSERT INTO links (link, short_link) VALUES ('".$url."', '".$short."')";
        $this->db->exec($sql);
        return $short;
    }

    function makeShort(){
        $host = $_SERVER['HTTP_HOST'];
        $nChars = 8;
        return $host.'/'.subStr(md5(uniqid()), 0, $nChars);
    }

}
//codeacademy/c7e6cb03