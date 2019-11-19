<?php 
$error="";
try {
			$pdo = new PDO('mysql:host=localhost;dbname=anies;charset=UTF8', "root", ""); 
		} catch (PDOException $e) {
		    echo 'Connexion échouée : '. $e->getMessage();
		    die();
		}
$sousPrefs =$pdo->query('select distinct id_sp,nom_sp from souspref order by nom_sp')->fetchAll(PDO::FETCH_OBJ);
if(isset($_POST['sousprefecture']) && isset($_POST['menages'])){

	if(trim(str_replace(' ', '', $_POST['sousprefecture']))>1100 && $_POST['menages'] >0){

		$maxMenage = $_POST['menages'];
		$codeSousPrefecture = $_POST['sousprefecture'];
		set_time_limit(3600000);

		require('lib/qrlib.php');
		require('functions.php');
		require("config.php");


		//selection des zones
		$zones = $pdo->query('select * from zones where id_sp="'.$codeSousPrefecture.'"')->fetchAll(PDO::FETCH_OBJ);

			foreach ($zones as $key => $zone) {
				// var_dump($maxMenage);die();
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
		$error = "le code sous prefecture et/ou la valeur saisie ne sont pas correct";
	}
}
?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Generation des QR CODES</title>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

	</head>
	<body>

	  <div class="inner-wrapper">
			<div class="container">
				<div class="row">
	    			<div class=" col-sm-4 col-sm-offset-4">

						<h3>Generation des QR CODES</h3> 
					<div class="form-text text-danger"><?php echo $error?$error:"" ?></div>

						<form method="post"> 
							<div class="form-group">
								<label>choisissez une sous préfecture zone</label>
								<select  class="form-control" name="sousprefecture">
									<?php foreach ($sousPrefs as $key => $sousPref): 
										echo "<option value='$sousPref->id_sp'>$sousPref->nom_sp</option>";
									 endforeach ?>
								</select> 

							  </div>
							<div class="form-group">
								<label>Nombre de ménage par zone</label>
								<input type="number" name="menages">
							</div>
							 <div class="col-auto my-1">
							      <button type="submit" class="btn btn-primary">Générer</button>
							    </div>
						</form> 
					</div> 
				</div> 
			</div> 
		</div> 

	</body>
	</html>