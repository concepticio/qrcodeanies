<?php 
require('lib/qrlib.php');
require('TCPDF/tcpdf.php');
  for ($i=1; $i <100; $i++) { 
	$currentQrPath = './qrimage/'.$i.'.png';
	QRcode::png($i, $currentQrPath, QR_ECLEVEL_L, 5);
	
	$content = '<table cellspacing="0" cellpadding="1">
				<tr>
					<td  colspan="3" align="center">
						<b> REPUBLIQUE DE GUINEE </b> <br>
						<b> PRIMATURE </b> <br>
						<b> Agence Nationale D’inclusion Economique Et Sociale (ANIES) </b> 
						<br>
							<hr/>
					</td>
				</tr>
				<tr>
					<td rowspan=""><img src="./qrimage/1.png"></td>
					<td colspan="2">Numéro ménage:	________________________ <br><br>
						Numéro d"ordre:	________________________ <br><br>
						Nom:	__________________________________ <br><br>
						Prénoms:	_______________________________ <br>
			<br>
					</td>
					
				</tr>

				<tr>
					<td colspan="3">
<br>
<hr>
					Attention!! Ce Récépicé est personnel et ne doit pas être utilisé par une autre personne.
					</td>
				</tr>
			</table>';

	$tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A6', true, 'UTF-8', false);

	// set default monospaced font
	$tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set title of pdf
	$tcpdf->SetTitle('Récépicé PMT');

	// set margins
	$tcpdf->SetMargins(10, 10, 10, 10);
	$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set header and footer in pdf
	$tcpdf->setPrintHeader(false);
	$tcpdf->setPrintFooter(false);
	$tcpdf->setListIndentWidth(3);

	// set auto page breaks
	$tcpdf->SetAutoPageBreak(TRUE, 11);

	// set image scale factor
	$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	$tcpdf->AddPage('L');

	$tcpdf->SetFont('times', '', 10.5);

	$tcpdf->writeHTML($content, true, false, false, false, '');

	//Close and output PDF document
	$outPutPath = $_SERVER['DOCUMENT_ROOT']."/qrcodeanies/recepices/".$i.'.pdf';
	$tcpdf->Output($outPutPath, 'F');

	echo $outPutPath. "-----OK"."<br>";
}
?>

