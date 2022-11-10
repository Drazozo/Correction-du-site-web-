<?php

$router->map('GET', '/', 'home', 'home');
$router->map('GET', '/connections', 'connections', 'connections');
$router->map('GET|POST', '/ban-[*:ip]', 'ban', 'ban');
$router->map('GET', '/ban_ips', 'ban_ips', 'ban-ips');
$router->map('GET', '/signalement', 'signalement', 'signalement');

$router->map('GET|POST', '/categories-[i:current]', 'categories', 'categories');
$router->map('GET|POST', '/create-categorie', 'create-categorie', 'create-categorie');
$router->map('GET|POST', '/edit-categorie-[i:id]', 'edit-categorie', 'edit-categorie');
$router->map('GET|POST', '/delete-categorie-[i:id]', 'delete-categorie', 'delete-categorie');
$router->map('GET|POST', '/search-categorie-[*:search]-[i:current]', 'search-categorie', 'search-categorie');

$router->map('GET|POST', '/sous-categories-[i:current]', 'sous-categories', 'sous-categories');
$router->map('GET|POST', '/create-sous-categorie', 'create-sous-categorie', 'create-sous-categorie');
$router->map('GET|POST', '/edit-sous-categorie-[i:id]', 'edit-sous-categorie', 'edit-sous-categorie');
$router->map('GET|POST', '/delete-sous-categorie-[i:id]', 'delete-sous-categorie', 'delete-sous-categorie');
$router->map('GET|POST', '/search-sous-categorie-[*:search]-[i:current]', 'search-sous-categorie', 'search-sous-categorie');

$router->map('GET|POST', '/questions-[i:current]', 'questions', 'questions');
$router->map('GET|POST', '/edit-question-[i:id]', 'edit-question', 'edit-question');
$router->map('GET|POST', '/delete-question-[i:id]', 'delete-question', 'delete-question');
$router->map('GET|POST', '/search-question-[*:search]-[i:current]', 'search-question', 'search-question');
$router->map('GET|POST', '/confirm-delete-[i:id]', 'confirm-delete', 'confirm-delete');
$router->map('GET|POST', '/confirm-reponse-[i:id]', 'confirm-reponse', 'confirm-reponse');
$router->map('GET|POST', '/confirm-questions', 'confirm-questions', 'confirm-questions');
$router->map('GET|POST', '/create-question', 'create-question', 'create-question');

$router->map('GET', '/utilisateurs-[i:current]', 'utilisateurs', 'utilisateurs');
$router->map('GET|POST', '/edit-user-[i:id]', 'edit-user', 'edit-user');
$router->map('GET|POST', '/delete-user-[i:id]', 'delete-user', 'delete-user');
$router->map('GET|POST', '/search-user-[*:search]-[i:current]', 'search-user', 'search-user');

$router->map('GET|POST', '/login', 'login', 'login');
$router->map('GET|POST', '/confirm-[i:email]-[*:code]', 'confirm', 'confirm');

$router->map('GET|POST', '/test', 'test', 'test');