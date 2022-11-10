<?php

$s = $db->prepare('SELECT * FROM signalement');
$s->execute();
$s = $s->fetchAll();