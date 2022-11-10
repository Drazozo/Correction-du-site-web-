<?php

$cat = $db->prepare('SELECT * FROM categories');
$cat->execute();
$c = $cat->fetchAll();

$subcat = $db->prepare('SELECT * FROM sous_categories');
$subcat->execute();
$sc = $subcat->fetchAll();

if (\askly\permissions::grade() == "admin" or \askly\permissions::grade() == "assistant") {
    $reponse_state = "validated";
}

if (\askly\permissions::grade() == "stagiaire") {
    $_POST['state'] = "brouillon";
    $reponse_state = "valid";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $c_a = [];

    foreach($c as $v){                    
        
        if(isset($_POST['cat_'.$v['id']])){
            $c_a[] = $v['id'];
            $categorie = join(', ', $c_a);
        }

        $sc_a = [];

        $subcat = $db->prepare('SELECT * FROM sous_categories WHERE cat_id = :cat_id ORDER BY titre ASC');
        $subcat->execute(['cat_id'=>$v['id']]);
        $sc2 = $subcat->fetchAll(); 

        foreach($sc2 as $sv){
            if(isset($_POST['subcat_'.$sv['id']])){
                $sc_a[] = $sv['id'];
                $subc = join(', ', $sc_a);
            }
        }
    }
    
    \askly\admin::create_question($_POST['titre'],$_POST['reponse'],$categorie,$subc,$_POST['state'],$_POST['keywords'],$_POST['sources']);
}