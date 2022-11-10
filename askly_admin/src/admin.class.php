<?php
namespace askly;
use PDO;
use main;
use permissions;
class admin
{

    static function edit_user($id, $nom, $prenom, $email, $grade)
    {

        if (\askly\permissions::grade() == "admin") {
            $db = \askly\main::db();

            $edit_user = $db->prepare('UPDATE users SET nom = :nom, prenom = :prenom, email = :email, grade = :grade WHERE id = :id');
            $edit_user->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'grade' => $grade,
                'id' => $id
            ]);
            header('Location: /utilisateurs-1');
        }
        else {
            echo "Permissions insuffisantes";
        }

    }

    static function delete_user($id)
    {
        if (\askly\permissions::grade() == "admin") {
            $db = \askly\main::db();

            $edit_question = $db->prepare('UPDATE users SET deleted = 1 WHERE id = :id');
            $edit_question->execute([
                'id' => $id
            ]);
            header('Location: /utilisateurs-1');

        }
        else {
            echo "<p>Permissions insuffisantes</p>";
            exit();
        }
    }

    static function ban_ip($ip)
    {
        if (\askly\permissions::grade() == "admin") {
            $db = \askly\main::db();

            $ban_ip = $db->prepare('INSERT INTO ban_ips(ip,date) VALUES(:ip,NOW())');
            $ban_ip->execute(['ip' => $ip]);

        }
        else {
            echo "Permissions insuffisantes";
        }
    }

    static function create_categorie($titre, $file, $desc)
    {

        if (\askly\permissions::grade() == "admin") {
            $db = \askly\main::db();

            $img = \askly\admin::upload($file, "categories/");

            $edit_cat = $db->prepare('INSERT INTO categories(titre,description,img) VALUES(:titre,:description,:img)');
            $edit_cat->execute([
                'titre' => $titre,
                'description' => $desc,
                'img' => $img,
            ]);

            $c = $db->prepare('SELECT * FROM categories WHERE titre = :titre');
            $c->execute(['titre'=>$titre]);
            $c = $c->fetch();
            $time = strtotime($c['date']);

            $sitemap = file_get_contents('../../askly/public/sitemap.xml');
            $sitemap = str_replace('</urlset>', "", $sitemap);
            $sitemap = $sitemap . "<url>\n\t<loc>https://askly.fr/categorie-". $c['id'] ."-1</loc>\n\t<lastmod>". date("Y-m-d\Th:m:s+00:00", $time) ."</lastmod>\n\t<priority>1.00</priority>\n</url>\n";
            $sitemap = $sitemap . "</urlset>";
            fwrite(fopen('../../askly/public/sitemap.xml', "a+"), $sitemap);

            header('Location: /categories-1');
        }
        else {
            echo "<p>Permissions insuffisantes</p>";
        }

    }

    static function edit_categorie($id, $titre, $file, $desc)
    {
        if (\askly\permissions::grade() == "admin") {
            $db = \askly\main::db();

            if (!isset($file)) {
                $edit_cat = $db->prepare('UPDATE categories SET titre = :titre, description = :description WHERE id = :id');
                $edit_cat->execute([
                    'titre' => $titre,
                    'description' => $desc,
                    'id' => $id
                ]);
            }
            else {
                $img = \askly\admin::upload($file, "categories/");

                $edit_cat = $db->prepare('UPDATE categories SET titre = :titre, description = :description, img = :img WHERE id = :id');
                $edit_cat->execute([
                    'titre' => $titre,
                    'description' => $desc,
                    'img' => $img,
                    'id' => $id
                ]);
            }

            header('Location: /categories-1');
        }
        else {
            echo "<p>Permissions insuffisantes</p>";
        }
    }

    static function delete_categorie($id)
    {
        if (\askly\permissions::grade() == "admin") {
            $db = \askly\main::db();

            $edit_question = $db->prepare('UPDATE categories SET deleted = 1 WHERE id = :id');
            $edit_question->execute([
                'id' => $id
            ]);

            $c = $db->prepare('SELECT * FROM categories WHERE id = :id');
            $c->execute(['id'=>$id]);
            $c = $c->fetch();
            $time = strtotime($c['date']);

            $sitemap = file_get_contents('../../askly/public/sitemap.xml');
            $sitemap = str_replace("<url>\n\t<loc>https://askly.fr/categorie-". $c['id'] ."-1</loc>\n\t<lastmod>". date("Y-m-d\Th:m:s+00:00", $time) ."</lastmod>\n\t<priority>1.00</priority>\n</url>\n", "", $sitemap);
            fwrite(fopen('../../askly/public/sitemap.xml', "a+"), $sitemap);
            header('Location: /categories-1');

        }
        else {
            echo "<p>Permissions insuffisantes</p>";
        }
    }

    static function create_sous_categorie($titre, $file, $desc, $keywords, $cat)
    {
        if (\askly\permissions::grade() == "admin") {
            $db = \askly\main::db();

            $img = \askly\admin::upload($file, "sous_categories/");

            $edit_cat = $db->prepare('INSERT INTO sous_categories(titre,description,img,keywords,cat_id) VALUES(:titre,:description,:img,:keywords,:cat_id)');
            $edit_cat->execute([
                'titre' => $titre,
                'description' => $desc,
                'img' => $img,
                'keywords' => $keywords,
                'cat_id' => $cat
            ]);

            $c = $db->prepare('SELECT * FROM sous_categories WHERE titre = :titre');
            $c->execute(['titre'=>$titre]);
            $c = $c->fetch();
            $time = strtotime($c['date']);


            $sitemap = file_get_contents('../../askly/public/sitemap.xml');
            $sitemap = str_replace('</urlset>', "", $sitemap);
            $sitemap = $sitemap . "<url>\n\t<loc>https://askly.fr/sous-categorie-". $c['id'] ."-1</loc>\n\t<lastmod>". date("Y-m-d\Th:m:s+00:00", $time) ."</lastmod>\n\t<priority>1.00</priority>\n</url>\n";
            $sitemap = $sitemap . "</urlset>";
            fwrite(fopen('../../askly/public/sitemap.xml', "a+"), $sitemap);

            header('Location: /sous-categories-1');
        }
        else {
            echo "<p>Permissions insuffisantes</p>";
        }

    }

    static function edit_sous_categorie($id, $titre, $file, $desc, $keywords, $cat)
    {
        if (\askly\permissions::grade() == "admin") {
            $db = \askly\main::db();


            if (empty($file) or !isset($file)) {
                $edit_user = $db->prepare('UPDATE sous_categories SET titre = :titre, description = :description, keywords = :keywords, cat_id = :cat_id WHERE id = :id');
                $edit_user->execute([
                    'titre' => $titre,
                    'description' => $desc,
                    'keywords' => $keywords,
                    'cat_id' => $cat,
                    'id' => $id
                ]);
            }
            else {
                $img = \askly\admin::upload($file, "sous_categories/");

                $edit_user = $db->prepare('UPDATE sous_categories SET titre = :titre, description = :description, img = :img, keywords = :keywords, cat_id = :cat_id WHERE id = :id');
                $edit_user->execute([
                    'titre' => $titre,
                    'description' => $desc,
                    'img' => $img,
                    'keywords' => $keywords,
                    'cat_id' => $cat,
                    'id' => $id
                ]);
            }


            header('Location: /sous-categories-1');
        }
        else {
            echo "<p>Permissions insuffisantes</p>";
        }
    }

    static function delete_sous_categorie($id)
    {
        if (\askly\permissions::grade() == "admin") {
            $db = \askly\main::db();

            $edit_subcat = $db->prepare('UPDATE sous_categories SET deleted = 1 WHERE id = :id');
            $edit_subcat->execute([
                'id' => $id
            ]);

            $c = $db->prepare('SELECT * FROM sous_categories WHERE id = :id');
            $c->execute(['id'=>$id]);
            $c = $c->fetch();
            $time = strtotime($c['date']);

            $sitemap = file_get_contents('../../askly/public/sitemap.xml');
            $sitemap = str_replace("<url>\n\t<loc>https://askly.fr/sous-categorie-". $c['id'] ."-1</loc>\n\t<lastmod>". date("Y-m-d\Th:m:s+00:00", $time) ."</lastmod>\n\t<priority>1.00</priority>\n</url>\n", "", $sitemap);
            fwrite(fopen('../../askly/public/sitemap.xml', "a+"), $sitemap);
            header('Location: /sous-categories-1');

        }
        else {
            echo "<p>Permissions insuffisantes</p>";
        }
    }
    static function create_question($titre, $reponse, $cat, $subcat, $state, $keywords, $sources)
    {
        if (\askly\permissions::is_team($_SESSION['id'])) {

            if(\askly\permissions::grade() == "admin" or \askly\permissions::grade() == "assistant") 
            {
                $reponse_state = "valided";
            } else {
                $reponse_state = "valid";
            }

            $db = \askly\main::db();

            $edit_question = $db->prepare('INSERT INTO questions(titre,reponse,categorie_id,subcat_id,state,keywords,response_date,responser,sources,owner_id,reponse_state) VALUES(:titre,:reponse,:categorie_id,:subcat_id,:state,:keywords,NOW(),:responser,:sources,:owner_id,:reponse_state)');
            $edit_question->execute([
                'titre' => $titre,
                'reponse' => $reponse,
                'categorie_id' => $cat,
                'subcat_id' => $subcat,
                'state' => $state,
                'keywords' => $keywords,
                'responser' => $_SESSION['id'],
                'sources'=>$sources,
                'owner_id'=>$_SESSION['id'],
                'reponse_state'=>$reponse_state
            ]);

            $q = $db->prepare('SELECT * FROM questions WHERE titre = :titre');
            $q->execute(['titre'=>$titre]);
            $q = $q->fetch();
            $time = strtotime($q['response_date']);

            $sitemap = file_get_contents('../../askly/public/sitemap.xml');
            $sitemap = str_replace('</urlset>', "", $sitemap);
            $sitemap = $sitemap . "<url>\n\t<loc>https://askly.fr/question-". $q['id'] ."</loc>\n\t<lastmod>". date("Y-m-d\Th:m:s+00:00", $time) ."</lastmod>\n\t<priority>1.00</priority>\n</url>\n";
            $sitemap = $sitemap . "</urlset>";
            fwrite(fopen('../../askly/public/sitemap.xml', "a+"), $sitemap);

            header('Location: /questions-1');

        }
        else {
            echo "<p>Permissions insuffisantes</p>";
        }       
    }


    static function edit_question($id, $titre, $reponse, $cat, $subcat, $state, $keywords, $sources)
    {
        if (\askly\permissions::is_team($_SESSION['id'])) {

            $db = \askly\main::db();

            if (\askly\permissions::grade() == "stagiaire") {
                $edit_question = $db->prepare('UPDATE questions SET titre = :titre, reponse = :reponse, categorie_id = :categorie_id, subcat_id = :subcat_id, state = :state, keywords = :keywords, responser = :responser, response_date = NOW(), reponse_state = "valid", sources = :sources WHERE id = :id');
                $edit_question->execute([
                    'titre' => $titre,
                    'reponse' => $reponse,
                    'categorie_id' => $cat,
                    'subcat_id' => $subcat,
                    'id' => $id,
                    'state' => 'brouillon',
                    'keywords' => $keywords,
                    'responser' => $_SESSION['id'],
                    'sources'=>$sources
                ]);
            }
            else {
                $edit_question = $db->prepare('UPDATE questions SET titre = :titre, reponse = :reponse, categorie_id = :categorie_id, subcat_id = :subcat_id, state = :state, keywords = :keywords, responser = :responser, response_date = NOW(), reponse_state = "valided", sources = :sources WHERE id = :id');
                $edit_question->execute([
                    'titre' => $titre,
                    'reponse' => $reponse,
                    'categorie_id' => $cat,
                    'subcat_id' => $subcat,
                    'id' => $id,
                    'state' => $state,
                    'keywords' => $keywords,
                    'responser' => $_SESSION['id'],
                    'sources'=>$sources
                ]);
            }

            header('Location: /questions-1');

        }
        else {
            echo "<p>Permissions insuffisantes</p>";
        }
    }

    static function delete_question($id)
    {
        if (\askly\permissions::grade() == "admin") {
            $db = \askly\main::db();

            $edit_question = $db->prepare('UPDATE questions SET state = \'deleted\' WHERE id = :id');
            $edit_question->execute([
                'id' => $id
            ]);

            $q = $db->prepare('SELECT * FROM questions WHERE id = :id');
            $q->execute(['id'=>$id]);
            $q = $q->fetch();
            $time = strtotime($q['date']);

            $sitemap = file_get_contents('../../askly/public/sitemap.xml');
            $sitemap = str_replace("<url>\n\t<loc>https://askly.fr/question-". $q['id'] ."</loc>\n\t<lastmod>". date("Y-m-d\Th:m:s+00:00", $time) ."</lastmod>\n\t<priority>1.00</priority>\n</url>\n", "", $sitemap);
            fwrite(fopen('../../askly/public/sitemap.xml', "a+"), $sitemap);

            header('Location: /questions-1');

        }
        else {
            echo "<p>Permissions insuffisantes</p>";
        }
    }

    static function ask_delete_question($id)
    {
        if (\askly\permissions::grade() == "assistant" or \askly\permissions::grade() == "stagiaire") {

            $db = \askly\main::db();

            $admins = $db->prepare("SELECT * FROM users WHERE grade = 'admin'");
            $admins->execute();
            $a = $admins->fetchAll();

            $user = $db->prepare('SELECT * FROM users WHERE id = :id');
            $user->execute(['id' => $_SESSION['id']]);
            $u = $user->fetch();

            $question = $db->prepare('SELECT * FROM questions WHERE id = :id');
            $question->execute(['id' => $id]);
            $q = $question->fetch();

            $subject = "Demande de supression d'une question";
            $body = $u['prenom'] . " " . $u['nom'] . " (" . $u['grade'] . ")" . " à demandé la suppression de la question n°" . $q['id'] . ".\n Vous pouvez confirmer la suppression en cliquant sur ce lien. <a href=\"https://teams.askly.fr/confirm-delete-" . $q['id'] . "\">Confirmer la suppression</a> Sinon, vous pouvez ignorer cet email";
            $altbody = $u['prenom'] . " " . $u['nom'] . " (" . $u['grade'] . ")" . " à demandé la suppression de la question n°" . $q['id'] . ".\n Vous pouvez confirmer la suppression en cliquant sur ce lien. https://teams.askly.fr/confirm-delete-" . $q['id'] . "\" Sinon, vous pouvez ignorer cet email";

            foreach ($a as $v) {
                \askly\main::send_mail($v['email'], $subject, $body, $altbody);
            }

            header('Location: /questions-1');
        }
    }

    static function confirm_reponse($id)
    {
        if (\askly\permissions::grade() == "admin" or \askly\permissions::grade() == "assistant") {

            $db = \askly\main::db();

            $confirm = $db->prepare("UPDATE questions SET reponse_state = 'valided', state = 'publie', date = CURRENT_TIMESTAMP() WHERE id = :id");
            $confirm->execute([
                'id' => $id
            ]);

            header('Location: /confirm-questions');

        }
        else {
            header('/questions-1');
        }
    }

    static function upload($file, $dir)
    {
        // dd($file);
        if (isset($file) && $file["error"] == 0) {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $file["name"];
            $filetype = $file["type"];
            $filesize = $file["size"];

            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed))
                $_SESSION['error'] = "Erreur : Veuillez sélectionner un format de fichier valide.";

            // Vérifie la taille du fichier - 10Mo maximum
            $maxsize = 100 * 1024 * 1024;
            if ($filesize > $maxsize)
            $_SESSION['error'] = "Error: La taille du fichier est supérieure à la limite autorisée.";

            // Vérifie le type MIME du fichier
            if (in_array($filetype, $allowed)) {
                // Vérifie si le fichier existe avant de le télécharger.
                if (file_exists("upload/" . $file["name"])) {
                    $_SESSION['error'] =  $file["name"] . " existe déjà.";
                }
                else {

                    $moved = move_uploaded_file($file["tmp_name"], "../../askly/public/assets/images/". $dir . $file["name"]);
                    // $_SESSION['error'] =  "Votre fichier a été téléchargé avec succès.";
                    return $file['name'];
                }
            }
            else {
                $_SESSION['error'] =  "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
            }
        }
        else {
            $_SESSION['error'] =  "Error: " . $file["error"];
        }
    }

}