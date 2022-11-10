<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    header('Location: /q-' . $_POST['search'] . '-1');
}

$question = $db->prepare('SELECT * FROM questions WHERE id = :id AND state = \'publie\'');
$question->execute(['id' => $params['id']]);
$q = $question->fetch();

if($q['subcat_id'] != NULL && $q['subcat_id'] != ""){

    $subcats = explode(', ',  $q['subcat_id']);
    $souscat = [];

    foreach ($subcats as $sc){
        $subcat = $db->prepare('SELECT * FROM questions WHERE (subcat_id LIKE \''.$sc.',\' OR subcat_id LIKE \', '.$sc.'\' OR subcat_id = '.$sc.') AND state = "publie" AND id != :id');
        $subcat->execute(['id'=>$params['id']]);
        $s = $subcat->fetchAll();
        
        foreach($s as $s2) {
            $souscat[] = $s2;
        }
    }

    $souscat = array_merge($souscat);

}

if($q['categorie_id'] != NULL && $q['categorie_id'] != ""){

    $cats = explode(', ',  $q['categorie_id']);
    $cat = [];

    foreach ($cats as $cs){
        $rcat = $db->prepare('SELECT * FROM questions WHERE (categorie_id LIKE \''.$cs.',\' OR categorie_id LIKE \', '.$cs.'\' OR categorie_id = '.$cs.') AND state = "publie" AND id != :id');
        $rcat->execute(['id'=>$params['id']]);
        $c = $rcat->fetchAll();
        
        foreach($c as $c2) {
            $cat[] = $c2;
        }
    }

    $cat = array_merge($cat);

}

if(!is_null($q['categorie_id']) && !is_null($q['subcat_id'])){
    $qs = array_merge($souscat, $cat);

    $c = count($qs) - 1;

    if($c < 0) {
        $next = NULL;
    } else {
        $random = random_int(0, $c);

        $next = $qs[$random];

        if($next['id'] == $params['id']){
            $next = NULL;
        }
    }
} else {
    $next = NULL;
}


$vues = $q['vues'] + 1;

$vue = $db->prepare('UPDATE questions SET vues = :vues WHERE id = :id');
$vue->execute([
    'vues' => $vues,
    'id' => $q['id']
]);

$cats = explode(', ',  $q['categorie_id']);
$subcats = explode(', ',  $q['subcat_id']);

if ($question->rowCount() == 0) {
    header('Location: /404');
}

