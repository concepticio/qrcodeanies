<?php 
error_reporting(0);
require('lib/qrlib.php');
require('TCPDF/tcpdf.php');
include("config.php");
if(!file_exists("qrimage")) mkdir("qrimage");
if(!file_exists("recepisses")) mkdir("recepisses");
$i=$de;
  while ($i <= $limite) {

  	$ii = $i+1;
  	$iii = $i+2;
  	$iiii = $i+3;

	$currentQrPath = './qrimage/'.$i.'.png';
	$currentQrPathi = './qrimage/'.$ii.'.png';
	$currentQrPathii = './qrimage/'.$iii.'.png';
	$currentQrPathiii = './qrimage/'.$iiii.'.png';
	QRcode::png($i, $currentQrPath, QR_ECLEVEL_L, 5);
	QRcode::png($ii, $currentQrPathi, QR_ECLEVEL_L, 5);
	QRcode::png($iii, $currentQrPathii, QR_ECLEVEL_L, 5);
	QRcode::png($iiii, $currentQrPathiii, QR_ECLEVEL_L, 5);
	
	$content = '<table>
					<tr>
						<td width="49%">
							<table cellspacing="0" cellpadding="1">
								<tr>
									<td  colspan="3" align="center">
										<b> REPUBLIQUE DE GUINEE </b> <br>
										<b> PRIMATURE </b> <br>
										<b> Agence Nationale d’Inclusion Economique et Sociale (ANIES)</b> <br>
										<b> Récépissé d\'inscription</b> <br>
											<hr/>
									</td>
								</tr>
								<tr>
									<td align="center">
									<img src="./qrimage/'.$i.'.png">
									'.$i.'

									</td>
									<td colspan="2"><br><br>
										Numéro ménage:	________________________ <br><br>
										Numéro d"ordre:	________________________ <br><br>
										Nom:	__________________________________ <br><br>
										Prénoms:	_______________________________ <br>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<br><hr><br>Ce récépissé est strictement personnel et à conserver soigneusement est personnel.
										</td>
								</tr>
							</table>
						</td>

						<td width="49%">
							<table cellspacing="0" cellpadding="1">
								<tr>
									<td  colspan="3" align="center">
										<b> REPUBLIQUE DE GUINEE </b> <br>
										<b> PRIMATURE </b> <br>
										<b> Agence Nationale d’Inclusion Economique Et Sociale (ANIES) </b> 
										<br>
										<b> Récépissé d\'inscription</b> <br>
											<hr/>
									</td>
								</tr>
								<tr>
									<td align="center" rowspan="1"><img src="./qrimage/'.$ii.'.png">
									'.$ii.'

									</td>
									<td colspan="2"><br><br>
										Numéro ménage:	________________________ <br><br>
										Numéro d"ordre:	________________________ <br><br>
										Nom:	__________________________________ <br><br>
										Prénoms:	_______________________________ <br>
								</td>
								</tr>
								<tr>
									<td colspan="3"><br><hr><br>Ce récépissé est strictement personnel et à conserver soigneusement est personnel.
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				 <br>
				  <br>
				  <br>
				  <br>
				<table>
					<tr>
						<td width="49%">
							<table cellspacing="0" cellpadding="1">
								<tr>
									<td  colspan="3" align="center">
										<b> REPUBLIQUE DE GUINEE </b> <br>
										<b> PRIMATURE </b> <br>
										<b> Agence Nationale d’Inclusion Economique Et Sociale (ANIES)</b> 
										<br>
										<b> Récépissé d\'inscription</b> <br>
											<hr/>
									</td>
								</tr>
								<tr>
									<td align="center" rowspan="1"><img src="./qrimage/'.$iii.'.png">
									'.$iii.'

									</td>
									<td colspan="2"><br><br>
										Numéro ménage:	________________________ <br><br>
										Numéro d"ordre:	________________________ <br><br>
										Nom:	__________________________________ <br><br>
										Prénoms:	_______________________________ <br>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<br><hr><br>Ce récépissé est strictement personnel et à conserver soigneusement est personnel.
										</td>
								</tr>
							</table>
						</td>

						<td width="49%">
							<table cellspacing="0" cellpadding="1">
								<tr>
									<td  colspan="3" align="center">
										<b> REPUBLIQUE DE GUINEE </b> <br>
										<b> PRIMATURE </b> <br>
										<b> Agence Nationale d’Inclusion Economique Et Sociale (ANIES) </b> 
										<br>
										<b> Récépissé d\'inscription</b> <br>
											<hr/>
									</td>
								</tr>
								<tr>
									<td align="center" rowspan="1" >
									<img src="./qrimage/'.$iiii.'.png">
									'.$iiii.'

									</td>
									<td colspan="2"><br><br>
										Numéro ménage:	________________________ <br><br>
										Numéro d"ordre:	________________________ <br><br>
										Nom:	__________________________________ <br><br>
										Prénoms:	_______________________________ <br>
								</td>
								</tr>
								<tr>
									<td colspan="3"><br><hr><br>
									Ce récépissé est strictement personnel et à conserver soigneusement est personnel.
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			';
			// echo $content;die();

	$tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

	// set default monospaced font
	$tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set title of pdf
	$tcpdf->SetTitle('récépissé PMT');

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
	$outPutPath = dirname(__FILE__)."/recepisses/".$i."_a_".$iiii.'.pdf';
	$tcpdf->Output($outPutPath, 'F');

	echo $i." à ".$iiii. "-----OK"."<br>";

	$i = $i+4;
}
?>


	

