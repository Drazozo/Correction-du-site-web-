<?php
require 'main.class.php';

$timestamp = time();
$timestamp = date("Y-m-d H:i:s", $timestamp);

$db = \askly\main::db();

$tokens = $db->prepare('SELECT * FROM authorizations');
$tokens->execute();
$tokens = $tokens->fetchAll();

foreach($tokens as $v){
    if($v['expiration_date'] < $timestamp){
        $delete = $db->prepare('DELETE FROM authorizations WHERE id = :id');
        $delete->execute(['id'=>$v['id']]);
    }
}