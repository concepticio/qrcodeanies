<?php 
$error="";
try {
			$pdo = new PDO('mysql:host=localhost;dbname=anies;charset=UTF8', "root", ""); 
		} catch (PDOException $e) {
		    echo 'Connexion échouée : '. $e->getMessage();
		    die();
		}
$sousPrefs =$pdo->query('select distinct id_sp,concat(nom_reg," / ",nom_pref," / ",nom_sp) as nom_sp from zones order by nom_sp')->fetchAll(PDO::FETCH_OBJ);

include('formulaire.php');


if(isset($_POST['codezone']) && isset($_POST['menages'])){

	if(trim(str_replace(' ', '', $_POST['sousprefecture']))>1100 && $_POST['menages'] >0){

		$maxMenage = $_POST['menages'];
		

		$codeSousPrefecture = $_POST['sousprefecture'];
		set_time_limit(3600000);

		require('lib/qrlib.php');
		require('functions.php');
		require("config.php");


		//selection des zones
		$zones = $pdo->query('select * from zones where id="'.$_POST['codezone'].'"')->fetchAll(PDO::FETCH_OBJ); // cette requête ne donne qu'une seule zone

			foreach ($zones as $key => $zone) {
					$k = $zone->id.'0001';
					$k = (int) $k;
					$max = $k+$maxMenage;
					
					//on parcours les menages
					for ($i=$k; $i < $max; $i++) { 
						$location=$zone->nom_reg."/".$zone->nom_pref."/".$zone->nom_sp."/".$zone->id;
						generateDoc($i,$location);

					}
			}

	}else{
		$error = "le code code zone et/ou la valeur saisie ne sont pas corrects";
	}
}
?>