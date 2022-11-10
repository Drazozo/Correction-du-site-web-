<?php 

$subcat = $db->prepare('SELECT * FROM sous_categories WHERE id = :id AND deleted = 0');
$subcat->execute(['id' => $params['id']]);
$sc = $subcat->fetch();

$whereValue = "%'".$params['id'] . ",'%)";

$return = askly\main::pagination($params['current'], 'questions', 15, 'vues', '(subcat_id LIKE \''.$params['id'].',\' OR subcat_id LIKE \', '.$params['id'].'\' OR subcat_id = '.$params['id'].') AND state', '\'publie\'');

$q = $return['q'];
