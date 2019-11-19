<?php 
set_time_limit(3600000);
include('fpdf_merge.php');
if(!file_exists("a_imprimer")) mkdir("a_imprimer");

$regions = array_diff(scandir("./recepisses"), array('..', '.','empty'));
foreach ($regions as $key => $region) {
	$prefectures = array_diff(scandir("./recepisses/".$region), array('..', '.','empty'));
	foreach ($prefectures as $key => $prefecture) {
		$sousprefectures = array_diff(scandir("./recepisses/".$region."/".$prefecture), array('..', '.','empty'));
		foreach ($sousprefectures as $key => $sousprefecture) {
			$zones = array_diff(scandir("./recepisses/".$region."/".$prefecture."/".$sousprefecture), array('..', '.','empty'));
			foreach ($zones as $key => $zone) {
				$filenames = array_diff(scandir("./recepisses/".$region."/".$prefecture."/".$sousprefecture."/".$zone), array('..', '.','empty'));

				$merge = new FPDF_Merge();


				$outputfile = "./a_imprimer/".$zone.".pdf";

				if(!file_exists($outputfile)){

					foreach ($filenames as $key => $filename) {	
						$filepath = "./recepisses/".$region."/".$prefecture."/".$sousprefecture."/".$zone."/".$filename;

						$merge->add($filepath);
					}
					unset($filepath);
					$merge->output($outputfile);
				}
				unset($outputfile);
			}
			unset($merge);
			
		}
	}
}


 ?>

<h3>Tous les fichiers regroupés se trouvent dans le dossier a_imprimer</h3>
<a class="btn btn-danger col-lg-12 center" href="./index.php">Retour à la page de génération de QRCODE</a>