<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'third_party/fpdf/fpdf.php';

class PDF extends FPDF {

	public function __construct()
	{
		parent::__construct();
	}

	public function Header()
	{
	       $this->Image('src/LogoTiendaPAQ.gif',15, 15, -300);
		$this->SetMargins(15, 10, 15);

	       $this->Ln(10);
		$this->Cell(80);

		$this->SetFillColor(18,143,188);
		$this->SetTextColor(255, 255, 255);
		$this->SetFont('Arial','B',10);
		$this->Cell(100,5,'COTIZACION', 0,0,'C', 1);

		$this->Ln(6);
		$this->Cell(80);

		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,4,'Folio:', 0,0,'L');
		$this->Cell(25,4,'5439', 0,0,'L');


		$this->Cell(25,4,'Fecha:', 0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(25,4,'02/07/2014', 0,0,'L');

		$this->Ln(5);
		$this->Cell(80);

		$this->SetFont('Arial','B',9);
		$this->Cell(25,4,'Agente:', 0,0,'L');

		$this->SetFont('Arial','',9);
		$this->Cell(75,4,'LUIS ALBERTO MACIAS ANGULO', 0,0,'L');

		$this->Ln(5);
		$this->Cell(80);

		$this->SetFillColor(18,143,188);
		$this->SetTextColor(255, 255, 255);
		$this->SetFont('Arial','B',10);
		$this->Cell(100,5,'CLIENTE', 0,0,'C', 1);

		$this->Ln(6);
		$this->Cell(80);

		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Arial','B',9);
		$this->Cell(100,4,'OPERADORA DE TUBERIA INDUSTRIAL DE MEXICO SA DE CV', 0,0,'L');

		$this->Ln(5);
		$this->Cell(80);

		$this->Cell(10,4,"At\'n:", 0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(90,4,'SILVIA HERNANDEZ', 0,0,'L');

		$this->Ln(5);
		$this->Cell(80);

		$this->SetFont('Arial','B',9);
		$this->Cell(10,4,'Tel:', 0,0,'L');

		$this->SetFont('Arial','',9);
		$this->Cell(30,4,'5553892406', 0,0,'L');

		$this->SetFont('Arial','B',9);
		$this->Cell(10,4,'Email:', 0,0,'L');

		$this->SetFont('Arial','',9);
		$this->Cell(50,4,'silvia_hernandez_df@hotmail.com', 0,0,'L');
	}

	public function Footer()
	{
		# code...
	}
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
