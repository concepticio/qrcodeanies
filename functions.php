<?php 
require('TCPDF/tcpdf.php');
	
	//cette fonction permet de créer les QRCODE et générer le fichier pdf en même temps
	function generateDoc($numMenage,$location){

		$PdfPath = dirname(__FILE__)."/recepisses/".$location;
		if(!file_exists($PdfPath)) mkdir($PdfPath,'0777',true);
		
		$outPutPath = $PdfPath."/".$numMenage.'.pdf';
		
		if(file_exists($outPutPath)) {
			return;
			exit();
		}

		//inclusion du modele de la carte qui se présente sous forme de papier A4 avec 4 cartes par page
		$numMember = (int) $numMenage.'01';
		$maxMembre = $_POST['maxMembre'];
		require ("cart.php");
		for ($i=$numMember; $i < $numMember+$maxMembre; $i++) { 
			//génération des quatres QRCODE de la page
			generateQr($i,$location);
		}

		//génération du fichier pdf
		$tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
		$tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$tcpdf->SetTitle('Récépissé d\'inscription');
		$tcpdf->SetMargins(10, 10, 10, 10);
		$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$tcpdf->setPrintHeader(false);
		$tcpdf->setPrintFooter(false);
		$tcpdf->setListIndentWidth(3);
		$tcpdf->SetAutoPageBreak(TRUE, 11);
		$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$tcpdf->AddPage('L');
		$tcpdf->SetFont('times', '', 10.5);

		$tcpdf->writeHTML($content, true, false, false, false, '');

		$tcpdf->AddPage('L');
		$tcpdf->SetFont('times', '', 10.5);

		$tcpdf->writeHTML($content2, true, false, false, false, '');

		//enregistrer le fichier pdf
		
		$tcpdf->Output($outPutPath, 'F');
		echo $outPutPath."<br>";

	}

	//cette fonction permet de gére le QRCODE avec la valeur $data qu'on lui transmet
	function generateQr($data,$location){
		$QrPath = dirname(__FILE__)."/qrimage/".$location;
		if(!file_exists($QrPath)) mkdir($QrPath,'0777',true);
		$filename =  $QrPath.'/'.$data.'.png';
		if(file_exists($filename)) {
			return;
			exit();
		}

		QRcode::png($data,$filename, QR_ECLEVEL_L, 5);

	}
 ?>