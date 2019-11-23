<?php 

	if(isset($_GET['sp'])){
		try {
			$pdo = new PDO('mysql:host=localhost;dbname=anies;charset=UTF8', "root", ""); 
		} catch (PDOException $e) {
			echo 'Connexion échouée : '. $e->getMessage();
			die();
		}
		$zones =$pdo->query('select distinct id,concat(nom_reg," / ",nom_pref," / ",nom_sp,"/",zone) as zone from zones where id_sp='.$_GET['sp'].' order by id')->fetchAll(PDO::FETCH_OBJ);
		foreach ($zones as $key => $zone) {
			echo "<option value=".$zone->id.">".$zone->zone."</option>";
		}
	}else{
		echo "<option value=''></option>";
	}
	

 ?>