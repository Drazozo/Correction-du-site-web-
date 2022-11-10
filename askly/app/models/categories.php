<?php 

$return = askly\main::pagination($params['current'], 'categories', 35, 'vues', 'deleted', 0);

$q = $return['q'];