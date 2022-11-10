<?php
// Placer les répertoires qui ne doivent pas étre crawlé
// Particuliérement utile pour les répertoires "admin" (évite de lister les fichiers administrateurs)
$array_ignorer = array();

// Liste des extensions accepté dans le sitemap
$aray_extension_accepter = array('html', 'HTML', 'htm', 'HTM', 'php', 'PHP');

header("Content-Type: text/xml;");
echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
echo '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">'."\n";


//****
// détecte l'extension d'un fichier et retourne cette extension
function detect_extension($filename)
{
	$array = explode('.', $filename);
	return $array[count($array)-1];
}


//****
// lister les fichiers présent sur le serveur d'un site web
function lister_fichier($array_repertoire=Array(), $array_ignorer=Array(), $aray_extension_accepter=Array())
{
	// Définir le répertoire é crawler
	if (count($array_repertoire)!=0) {
		$repertoire_visiter = implode('/', $array_repertoire);
		$repertoire_total = implode('/', $array_repertoire).'/';
	} else {
		$repertoire_visiter = '.';
		$repertoire_total = '';
	}
	
	$ignorer=false;
	foreach ($array_ignorer as $repertoire_a_ignorer) {
		if ($repertoire_total==$repertoire_a_ignorer) {
			$ignorer=true;
		}
	}
	
	if (!$ignorer) {
		if ($handle = opendir($repertoire_visiter)) {
			$array = Array();
			
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..")
					$array[] = $file;
			}
			sort($array); // sort the array
			
			//****
			// D'abord lister les dossiers
			foreach($array as $element) {
				if (@filetype($repertoire_total.$element)=='dir') {
					$array_repertoire[] = $element;
					
					// entrer dans une nouvelle boucle puisqu'il s'agit d'un dossier
					echo lister_fichier($array_repertoire, $array_ignorer, $aray_extension_accepter);
					
					// Retour sur le précédent dossier (donc mise à jour du repertoire)
					array_splice($array_repertoire, count($array_repertoire)-1);
				}
			}
			
			//****
			// Ensuite lister les fichiers
			foreach($array as $element) {
				if (@filetype($repertoire_total.$element)=='file') {
					
					// Vérifier l'extension du fichier et décider s'il faut l'accepter ou non
					$extension_accepter=false;
					foreach ($aray_extension_accepter as $extension) {
						if (detect_extension($element)==$extension) {
							$extension_accepter=true;
						}
					}
					
					// Si l'extension est accepté, alors affiché à l'écran
					if ($extension_accepter) {
						
						echo "\t".'<url>'."\n";
						echo "\t\t".'<loc>http://'.$_SERVER['HTTP_HOST'].'/'.$repertoire_total.$element.'</loc>'."\n";
						echo "\t".'</url>'."\n";
					}
				}
			}
			
			closedir($handle);
		}
	}
	
}


// Lancer la fonction pour générer le sitemap
echo lister_fichier(Array(), $array_ignorer, $aray_extension_accepter);

echo '</urlset>';