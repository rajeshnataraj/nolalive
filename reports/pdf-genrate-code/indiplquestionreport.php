<?php
@include("sessioncheck.php");

require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');

$method = $_REQUEST;
$id = isset($method['id']) ? $method['id'] : '0';
$filename = isset($method['filename']) ? $method['filename'] : '';

$html = file_get_contents(__HOSTADDR__.'reports/pdf-genrate-code/indiplquestionreport-output.php?id='.$id.'');

class MYPDF extends TCPDF {
	public function Header() { // Page header
		$encryptkey = 'ef800b4cf626d5c14a0c65ce2d90c15c';
		global $ObjDB;
		$method = $_REQUEST;
		$id = isset($method['id']) ? $method['id'] : '0';
		$ids=$id;
        $ids = explode(",",$ids);
		
		$qryclass = $ObjDB->QueryObject("SELECT fld_class_name AS classname, fld_period AS period 
												FROM itc_class_master 
												WHERE fld_id='".$ids[1]."'");
			
		$row=$qryclass->fetch_assoc();
		extract($row);
		
		$ends = array('th','st','nd','rd','th','th','th','th','th','th');
		if (($period %100) >= 11 && ($period%100) <= 13)
		   $abbreviation = $period. 'th';
		else
		   $abbreviation = $period. $ends[$period % 10];

		$this->SetTextColor(0,0,0);
		$this->SetFont('arialblack', '', 18);
		$this->Text(10, 18, 'Individual IPL Question Report');
		$this->Image('scans/../report.png', 10, 40, 19, 8, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);		
		$this->SetFont('arialblack', '', 13);
		$len = strlen ($classname.', '.$abbreviation.' Period');
		if($len>30)
			$length = 100;
		else
			$length = 120;
		$this->Text($length, 41, $classname.', '.$abbreviation.' Period');
		$style=array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$this->Line(10,48,190,48, $style);		
		$this->SetFont('arial', '', 10);
		
		$newipl = '';
		$qry = '';
		if($ids[5]==0)
			$qry = $ObjDB->QueryObject("SELECT b.fld_schedule_name AS assignmentname, CONCAT(c.fld_fname,'',c.fld_lname) AS username, CONCAT(d.fld_ipl_name,' ',a.fld_version) AS iplname 
										FROM itc_class_sigmath_master AS b 
										JOIN itc_user_master AS c 
										JOIN itc_ipl_master AS d 
										JOIN itc_ipl_version_track AS a  
										WHERE a.fld_ipl_id='".$ids[4]."' AND b.fld_id='".$ids[3]."' AND c.fld_id='".$ids[2]."' AND d.fld_id='".$ids[4]."' AND a.fld_delstatus='0'");
		else if($ids[8]==1 || $ids[8]==2)
			$qry = $ObjDB->QueryObject("SELECT b.fld_schedule_name AS assignmentname, CONCAT(c.fld_fname,'',c.fld_lname) AS username, 'Diagnostic Day' AS iplname 
										FROM itc_class_rotation_schedule_mastertemp AS b 
										JOIN itc_user_master AS c 
										WHERE b.fld_id='".$ids[3]."' AND c.fld_id='".$ids[2]."'");
		else if($ids[8]==5 || $ids[8]==6)
			$qry = $ObjDB->QueryObject("SELECT b.fld_schedule_name AS assignmentname, CONCAT(c.fld_fname,'',c.fld_lname) AS username, 'Diagnostic Day' AS iplname 
										FROM itc_class_indassesment_master AS b 
										JOIN itc_user_master AS c 
										WHERE b.fld_id='".$ids[3]."' AND c.fld_id='".$ids[2]."'");
			
		if($ids[8]==5)
			$newipl=1;
		else if($ids[8]==6)
			$newipl=2;
		$row = $qry->fetch_object();
		$this->Text(10, 50, 'Class : '.$classname);
		$this->Text(10, 55, 'Student : '.$row->username);
		$alen = strlen ('Assignment : '.$row->assignmentname);
		$passlen = strlen ('IPL : '.$row->iplname.' '.$ids[8]);
		if($alen>40 || $passlen>40)
			$alength = 100;
		else
			$alength = 120;
		$this->Text($alength, 50, 'Assignment : '.$row->assignmentname);
		$this->Text($alength, 55, 'IPL : '.$row->iplname.' '.$newipl);
	}
	
	public function Footer() { // Page footer
		$date = date("m/d/Y"); // H:i:s A
		// Position at 15 mm from bottom
		$this->SetY(-15);		
		// Set font
		$this->SetFont('arialblack', '', 10);
		// Page number
		
		$this->Cell(30, 10, $date, 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->Cell(280, 10, $this->getAliasNumPage(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Individual IPL Question Report');

$pdf->SetMargins(PDF_MARGIN_LEFT, 70, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set font

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// add a page
$pdf->AddPage();

$dat=date('l, F, d, Y');
$i='';

$html = <<<EOD
$html
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

@include("footer.php");
//Close and output PDF document
$pdf->Output('pdf/'.$filename.'.pdf', 'F');