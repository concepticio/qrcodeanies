<?php 

try {
	$pdo = new PDO('mysql:host=localhost;dbname=anies;charset=UTF8', "root", ""); 
} catch (PDOException $e) {
    echo 'Connexion échouée : '. $e->getMessage();
    die();
}
set_time_limit(36000);
$QrPath;

require('lib/qrlib.php');
require('functions.php');
require("config.php");

$regions = $pdo->query('select distinct id_reg,nom_reg from regions')->fetchAll(PDO::FETCH_OBJ);
foreach ($regions as $key => $region) {
 	
	$prefectures = $pdo->query('select id_pref,nom_pref from prefectures where id_reg='.$region->id_reg)->fetchAll(PDO::FETCH_OBJ);

	foreach ($prefectures as $key => $prefecture) {

		$sousprefs = $pdo->query('select id_sp,nom_sp from souspref where id_pref='.$prefecture->id_pref)->fetchAll(PDO::FETCH_OBJ);
			foreach ($sousprefs as $key => $souspref) {
					
					//selection des zones
					$zones = $pdo->query('select * from zones where id_sp="'.$souspref->id_sp.'"')->fetchAll(PDO::FETCH_OBJ);
						foreach ($zones as $key => $zone) {
								
								$k = $zone->id.'0001';
								$k = (int) $k;
								$max = $k+$maxMenage;
								
								//on parcours les menages
								for ($i=$k; $i < $max; $i++) { 
									$location=$region->nom_reg."/".$prefecture->nom_pref."/".$souspref->nom_sp."/".$zone->id;
									generateDoc($i,$location);

								}
						}

			}
	}

}

?>

	

