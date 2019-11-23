
<!DOCTYPE html>
<html>
<head>
	<title>Génération des QR CODES</title>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

</head>
<body>

  	<div class="inner-wrapper">
		<div class="container">
			<div class="row">
    			<div class=" col-sm-4 col-sm-offset-4">

					<h3>Génération des QR CODES</h3> 

				<div class="form-text text-danger"><?php echo $error? $error:"" ?></div>

					<form method="post"> 
						<div class="form-group">
							<label>choisissez une sous-préfecture</label>
							<?php 
							if(isset($_POST['sousprefecture'])) $souspref=$_POST['sousprefecture'];else $souspref="";
							 ?>
							<input class="form-control" list="soup" type="text" value="<?=$souspref ?>" name="sousprefecture" onchange = "loadZone(this.value);"  required>
							<datalist   id="soup">
								<?php foreach ($sousPrefs as $key => $sousPref): 
									echo "<option value='$sousPref->id_sp'>$sousPref->nom_sp</option>";
								 endforeach ?>
							</datalist> 

						  </div>
						  <div class="form-group">
							<label>choisissez une zone</label>
							<?php 
							if(isset($_POST['codezone'])) $codeZ=$_POST['codezone'];else $codeZ="";
							 ?>
							<input class="form-control" list="zone" type="text" value="<?=$codeZ ?>" name="codezone" required>
							<datalist   id="zone" name="zone"></datalist> 

						  </div>
						<div class="form-group">
							<label>Nombre de ménage par zone</label>
							<input type="number" name="menages" value="1000">
						</div>

						<div class="form-group">
							<label>Nombre de membre par ménage</label>
							<input type="number" name="maxMembre" disabled value="8">
						</div>
						 <div class="col-auto">
						      <button type="submit" class="btn btn-primary">Générer</button>
						    </div>
					</form> 
					<br>
					<br>
					<a class="btn btn-danger col-lg-12 center" href="./merge.php">Regrouper les fichiers par zone pour imprimer</a>
				</div> 
			</div> 
		</div> 
	</div> 

<script type="text/javascript">
	
	function loadZone(str) {
	    if (str.length == 0) {
	        document.getElementById("zone").innerHTML = "";
	        return;
	    } else {
	        var xmlhttp = new XMLHttpRequest();
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("zone").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET", "getzone.php?sp=" + str, true);
	        xmlhttp.send();
	    }
	}
</script>
	</body>
	</html>