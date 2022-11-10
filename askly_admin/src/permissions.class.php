<?php
namespace askly;
use PDO;
use main;
class permissions
{

    static function grade()
    {

        $db = \askly\main::db();

        $perm = $db->prepare('SELECT grade FROM users WHERE id = :id');
        $perm->execute(['id' => $_SESSION['id']]);
        $p = $perm->fetch();
        $p = $p['grade'];

        return $p;

    }

    static function is_team($id)
    {

        $db = \askly\main::db();

        $user = $db->prepare('SELECT grade FROM users WHERE id = :id');
        $user->execute(['id' => $id]);
        $u = $user->fetch();

        $allowed_grades = array('admin', 'assistant', 'stagiaire');

        if (in_array($u['grade'], $allowed_grades)) {
            return true;
        }
        else {
            return false;
        }

    }

    static function get_grade($id){
        $db = \askly\main::db();

        $perm = $db->prepare('SELECT grade FROM users WHERE id = :id');
        $perm->execute(['id' => $id]);
        $p = $perm->fetch();
        $p = $p['grade'];

        return $p;
    }



}