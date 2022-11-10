<?php 

$categorie = $db->prepare('SELECT * FROM categories WHERE id = :id AND deleted = 0');
$categorie->execute(['id' => $params['id']]);
$cat = $categorie->fetch();

$firstsubcats = $db->prepare('SELECT * FROM sous_categories WHERE cat_id = :cat_id LIMIT 3');
$firstsubcats->execute([
    'cat_id'=>$cat['id']
]);
$fsc = $firstsubcats->fetchAll();

$subcat = $db->prepare('SELECT * FROM sous_categories WHERE (cat_id = :cat_id) ORDER BY id LIMIT 100 OFFSET 3');
$subcat->execute([
    'cat_id'=>$cat['id']
]);
$sc = $subcat->fetchAll();

// Vues

$vues = $cat['vues'] + 1;

$vue = $db->prepare('UPDATE categories SET vues = :vues WHERE id = :id');
$vue->execute([
    'vues' => $vues,
    'id' => $cat['id']
]);

$whereValue = "%'".$params['id'] . ",'%)";

$return = askly\main::pagination($params['current'], 'questions', 15, 'vues', '(categorie_id LIKE \''.$params['id'].',\' OR categorie_id LIKE \', '.$params['id'].'\' OR categorie_id = '.$params['id'].') AND state', '\'publie\'');
$q = $return['q'];