<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'third_party/fpdf/fpdf.php';

class PDF extends FPDF {

	public function __construct()
	{
		parent::__construct();
	}

	public function Header()
	{
		$this->SetMargins(15,0,15);
	       $this->Image('src/LogoTiendaPAQ.gif',15, 10, 70);
	       $this->Cell(85);

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

		$this->Ln(10);
		$this->Cell(80);

		$this->SetFillColor(18,143,188);
		$this->SetTextColor(255, 255, 255);
		$this->SetFont('Arial','B',10);
		$this->Cell(100,5,'CLIENTE', 0,0,'C', 1);

		$this->Ln(6);
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Arial','B',9);
		$this->Cell(80,5,'Cuarzo #9-A, Col. Solidaridad, Ocotlan Jal.', 0,0,'C');

		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Arial','B',9);
		$this->Cell(100,4,'OPERADORA DE TUBERIA INDUSTRIAL DE MEXICO SA DE CV', 0,0,'L');

		$this->Ln(5);
		// $this->SetTextColor(0, 0, 0);
		// $this->SetFont('Arial','B',9);
		$this->Cell(80,5,'Tel. (392) 925 3808, 9234808, 925 5864', 0,0,'C');

		$this->Cell(10,4,"At\'n:", 0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(90,4,'SILVIA HERNANDEZ', 0,0,'L');

		$this->Ln(5);
		$this->SetFont('Arial','B',9);
		$this->Cell(80,5,'ventas@tiendapaq.com.mx', 0,0,'C');

		$this->SetFont('Arial','B',9);
		$this->Cell(10,4,'Tel:', 0,0,'L');

		$this->SetFont('Arial','',9);
		$this->Cell(30,4,'5553892406', 0,0,'L');

		$this->SetFont('Arial','B',9);
		$this->Cell(10,4,'Email:', 0,0,'L');

		$this->SetFont('Arial','',9);
		$this->Cell(50,4,'silvia_hernandez_df@hotmail.com', 0,0,'L');

		$this->Ln(10);

		$this->SetFont('Arial','',9);
		$this->MultiCell(180, 5,'Reciba un cordial saludo y nuestro agradecimiento por su confianza e interes en los Productos y Servicios que ofrecemos. Nos es grata enviar la informacion que solicito tan amablemente.',0, 'C');
	}

	public function Footer()
	{
		$this->Ln(30);

		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Arial','B',8);
		$this->Cell(90,5,'OBSERVACIONES', 'LT',0,'C', 1);

		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Arial','B',8);
		$this->Cell(90,5,'METODO DE PAGO', 'LTR',1,'C', 1);

		$this->SetFont('Arial','',6);
		$this->MultiCell(90, 3,"*PRECIOS MAS IVA SUJETOS A CAMBIO SIN PREVIO AVISO.\n*FORMA DE PAGO POR ANTICIPADO.\n*TIEMPO DE ENTREGA: DE 5 A 8 DIAS HABILES.\n*EL PRECIO NO INCLUYE SERVICIOS DE IMPLEMENTACION, CAPACITACION O ASESORIA ADICIONAL A LA EXPRESAMENTE SE ALADA EN ESTA COTIZACION\n*LOS CURSOS Y SESIONES REMOTAS ESTAN SUJETOS A PROGRAMACION.\n*NO INCLUYE GASTOS DE VIATICOS EN CASO DE QUE ESTOS SE GENEREN SE FACTURAN POR SEPARADO,",'LR', 'L');
		$this->Cell(90, 3,"*PRECIOS MAS IVA SUJETOS A CAMBIO SIN PREVIO AVISO.\n*FORMA DE PAGO POR ANTICIPADO.\n*TIEMPO DE ENTREGA: DE 5 A 8 DIAS HABILES.\n*EL PRECIO NO INCLUYE SERVICIOS DE IMPLEMENTACION, CAPACITACION O ASESORIA ADICIONAL A LA EXPRESAMENTE SE ALADA EN ESTA COTIZACION\n*LOS CURSOS Y SESIONES REMOTAS ESTAN SUJETOS A PROGRAMACION.\n*NO INCLUYE GASTOS DE VIATICOS EN CASO DE QUE ESTOS SE GENEREN SE FACTURAN POR SEPARADO,",'LR', 'L');
	}
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
