<?php

$router = new AltoRouter();

$router->map('GET|POST', '/', 'home', 'Askly - Page d\'accueil - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET|POST', '/disconnect', 'disconnect', 'Askly - Page de deconnexion - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET', '/cgu', 'cgu', 'Askly - Conditions générales d\'utilisation - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET', '/join', 'join', 'Askly - rejoindre les équipes - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET', '/a-propos', 'a-propos', 'Askly - A propos de nous - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET', '/mentions-legales', 'mentions-legales', 'Askly - Mentions légales - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET', '/merci', 'merci-question', 'Askly te remercie de ta question - notre but répondre à tes questions rapidement et de façon pertinente .');
$router->map('GET', '/categories-[i:current]', 'categories', 'Askly - Les catégories - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET', '/categorie-[i:id]-[i:current]', 'categorie', ' Askly -La categorie qui t\'intéresse - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET', '/sous-categorie-[i:id]-[i:current]', 'sous-categorie', 'Askly - La sous-catégorie qui t\intéresse - notre but répondre à tes questions rapidement et de façon pertinente ');
$router->map('GET|POST', '/nous-contacter', 'contact', 'Askly - Prendre contact - - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET', '/merci-contact', 'merci-contact', 'Askly - te remercie de ta prise de contact - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET', '/green', 'green', 'Askly est au vert 🌳 - notre but répondre à tes questions rapidement et de façon pertinente ');
$router->map('GET', '/info-cookies', 'info-cookies', 'Askly - t\'informe sur les cookies - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET', '/500', '500', 'Askly - Erreur 500 - le site est surchargé - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET|POST', '/login', 'login', 'Askly - notre page d\inscription et de connexion - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET|POST', '/confirm-[i:email]-[i:code]', 'confirm', 'Askly - connecte toi avec le code reçu par mail - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET|POST', '/ask-question', 'ask-question', 'Askly - Poser une question qui me tient à coeur - - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET|POST', '/q-[*:search]-[i:current]', 'search', 'Askly - recherche en cours- notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET|POST', '/question-[i:id]', 'question', 'Askly - LA réponse à votre question 🙃 - notre but répondre à tes questions rapidement et de façon pertinente ');
$router->map('GET|POST', '/signalement-[i:id]', 'signalement', 'Askly - faire le signalement d\'une question- notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET|POST', '/edit-infos', 'edit-infos', 'Askly - Editer les informations de mon compte - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET|POST', '/delete-account', 'delete-account', 'Askly - Oh non ! Supprimer mon compte - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET|POST', '/no-consent', 'no-consent', 'Askly - refus des cookies - notre but répondre à tes questions rapidement et de façon pertinente');
$router->map('GET', '/merci-question', 'merci-question', 'Askly question');
$router->map('GET', '/sitemap', 'sitemap', 'sitemap', 'sitemap');