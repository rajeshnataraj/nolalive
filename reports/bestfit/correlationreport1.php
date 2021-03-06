<?php

$ids = isset($_REQUEST['details']) ? $_REQUEST['details'] : 0;



$detailid=explode("#",$ids);

$url=$domainame;


require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');

$ObjDB->NonQuery("UPDATE itc_bestfit_report_data SET fld_step_id='3' WHERE fld_id='".$detailid[1]."'");



$qry=$ObjDB->QueryObject("SELECT  fld_sec_std_add_summary,
						  fld_sec_bench_add_summary,
						  fld_sec_corr_by_std,
						  fld_sec_corr_by_title,
						  fld_sec_std_not_add ,
						fld_sec_prod_description
						FROM
						  itc_bestfit_report_data
						WHERE fld_id = '".$detailid[1]."'
						  AND fld_delstatus = '0' ");
if($qry->num_rows > 0){
		$rowqry = $qry->fetch_assoc();
       	extract($rowqry);
		$standardgraph=$fld_sec_std_add_summary;
		$benchgraph=$fld_sec_bench_add_summary;
		$stdpoints=$fld_sec_corr_by_std;
		$stdpointsbytitle=$fld_sec_corr_by_title;
		$stdpointsnotadde=$fld_sec_std_not_add;
		}
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {


	public function Header() {
		$this->SetFont('helvetica', '', 20);
		$this->SetTextColor(80,80,80);
		$this->SetFont('helvetica', '', 11);
		$this->Cell(87, 10, 'NOLA Education Standards Correlation Report', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		 $this->top_margin = $this->GetY() + 20; // padding for second page
	}

// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		//
		$this->SetTextColor(80,80,80);
		// Set font
		$this->SetFont('helvetica', '', 8);
		// Page number

		$this->Cell(57, 10, '© 2013 NOLA Education. All rights reserved', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->Cell(250, 10, $this->getAliasNumPage(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set font
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
// add a page
$pdf->AddPage();

$html = file_get_contents($url.'reports/bestfit/BestfitReport-Output.php?id='.$detailid[1].'&uid='.$uid.'&sessmasterprfid='.$sessmasterprfid.'&oper=page1'.'&selereq='.$detailid[0].'&maxrecom='.$detailid[2].'&chckbox='.$detailid[3].'&notitles='.$detailid[4].'&totcombi='.$detailid[5].'&docid='.$detailid[6]);
// print a block of text using Write()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
$pdf->SetPrintHeader(true);
$pdf->SetPrintFooter(true);


$pdf->AddPage();
$html = file_get_contents($url.'reports/bestfit/BestfitReport-Output.php?id='.$detailid[1].'&uid='.$uid.'&sessmasterprfid='.$sessmasterprfid.'&oper=page2'.'&selereq='.$detailid[0].'&maxrecom='.$detailid[2].'&chckbox='.$detailid[3].'&notitles='.$detailid[4].'&totcombi='.$detailid[5].'&docid='.$detailid[6]);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
$pdf->SetMargins(10, 20, 10, true);
$pdf->AddPage();
$html = file_get_contents($url.'reports/bestfit/BestfitReport-Output.php?id='.$detailid[1].'&oper=page3&stdgrapg='.$standardgraph.'&bchgraph='.$benchgraph.'&p1='.$stdpoints.'&p2='.$stdpointsbytitle.'&p3='.$stdpointsnotadde.'&selereq='.$detailid[0].'&maxrecom='.$detailid[2].'&chckbox='.$detailid[3].'&notitles='.$detailid[4].'&totcombi='.$detailid[5].'&docid='.$detailid[6]);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
$pdf->SetMargins(10, 20, 10, true);

//Close and output PDF document
$pdf->Output('bestreports/bestfit_report_'.$detailid[1].'.pdf', 'F');
