<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'third_party/fpdf/fpdf.php';

class PDF extends FPDF {

	public $OFICINA;
	public $COTIZACION;
	public $CLIENTE;

	public function __construct()
	{
		parent::__construct();
	}

	public function init($oficina, $cotizacion, $cliente)
	{
		$this->OFICINA 		=  $oficina;
		$this->COTIZACION 	= $cotizacion;
		$this->CLIENTE 		= $cliente;
	}

	public function Header()
	{
		// Variables

		// OFICINA
		$direccion_oficina 	= utf8_decode($this->OFICINA->calle.' '.$this->OFICINA->numero.', Col. '.$this->OFICINA->colonia.', '.$this->OFICINA->ciudad.', '.$this->OFICINA->estado);
		$telefono_oficina 	= 'Tel. '.$this->OFICINA->telefono;
		$correo_oficina 	= $this->OFICINA->email;

		// COTIZACION
		$folio 		= $this->COTIZACION['folio'];
		$agente 	= utf8_decode($this->COTIZACION['agente']);

		// CLIENTE
		$razon_social 	=  $this->CLIENTE['razon_social'];
		$contacto 		=  utf8_decode($this->CLIENTE['contacto']);
		$telefono 		=  $this->CLIENTE['telefono'];
		$email 			=  $this->CLIENTE['email'];

		/* ---------- CREACION DEL PDF -------------*/

		$this->SetMargins(15,0,15);
	       $this->Image('assets/admin/layout/img/logo-big.png',15, 10, 70);
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
		$this->Cell(25,4, $folio, 0,0,'L');


		$this->Cell(25,4,'Fecha:', 0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(25,4,date('d/m/Y'), 0,0,'L');

		$this->Ln(5);
		$this->Cell(80);

		$this->SetFont('Arial','B',9);
		$this->Cell(25,4,'Agente:', 0,0,'L');

		$this->SetFont('Arial','',9);
		$this->Cell(75,4, $agente, 0,0,'L');

		$this->Ln(10);
		$this->Cell(80);

		$this->SetFillColor(18,143,188);
		$this->SetTextColor(255, 255, 255);
		$this->SetFont('Arial','B',10);
		$this->Cell(100,5,'CLIENTE', 0,0,'C', 1);

		$this->Ln(6);
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Arial','B',9);
		$this->Cell(80,1, $direccion_oficina, 0,0,'C');

		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,4, $razon_social, 0,0,'L');

		$this->Ln(5);
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Arial','B',9);
		$this->Cell(80,1, $telefono_oficina, 0,0,'C');

		$this->Cell(15,4, utf8_decode('Contácto:'), 0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(85,4, $contacto, 0,0,'L');

		$this->Ln(5);
		$this->SetFont('Arial','B',9);
		$this->Cell(80,1, $correo_oficina, 0,0,'C');

		$this->SetFont('Arial','B',8);
		$this->Cell(10,4,'Tel:', 0,0,'L');

		$this->SetFont('Arial','',8);
		$this->Cell(30,4, $telefono, 0,0,'L');

		$this->SetFont('Arial','B',8);
		$this->Cell(10,4,'Email:', 0,0,'L');

		$this->SetFont('Arial','',8);
		$this->Cell(50,4, $email, 0,0,'L');

		$this->Ln(10);

		$this->SetFont('Arial','',9);
		$this->MultiCell(180, 5,'Reciba un cordial saludo y nuestro agradecimiento por su confianza e interes en los Productos y Servicios que ofrecemos. Nos es grata enviar la informacion que solicito tan amablemente.',0, 'C');
	}

	public function Footer()
	{
		$this->Ln(10);

		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Arial','B',8);
		$this->Cell(90,5,'OBSERVACIONES', 'LT',0,'C', 1);

		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Arial','B',8);
		$this->Cell(90,5,'METODO DE PAGO', 'LTR',1,'C', 1);

		$this->SetFont('Arial','',6);
		//Save the current position
		$x = $this->GetX();
		$y = $this->GetY();
		$this->MultiCell(90, 4, chr(149).' PRECIOS MAS IVA SUJETOS A CAMBIO SIN PREVIO AVISO.', 'LR', 'L');
		$this->MultiCell(90, 4, chr(149).' FORMA DE PAGO POR ANTICIPADO.', 'LR', 'L');
		$this->MultiCell(90, 4, chr(149).' TIEMPO DE ENTREGA: DE 3 A 5 DIAS HABILES.', 'LR', 'L');
		$this->MultiCell(90, 4, chr(149).' PRECIOS MAS IVA SUJETOS A CAMBIO SIN PREVIO AVISO.', 'LR', 'L');
		$this->MultiCell(90, 4, chr(149).utf8_decode(' EL PRECIO NO INCLUYE SERVICIOS DE IMPLEMENTACION, CAPACITACION O ASESORIA ADICIONAL A LA EXPRESAMENTE SEÑALADA EN ESTA COTIZACION.'), 'LR', 'L');
		$this->MultiCell(90, 4, chr(149).' LOS CURSOS Y SESIONES REMOTAS ESTAN SUJETOS A PROGRAMACION.', 'LR', 'L');
		$this->MultiCell(90, 4, chr(149).' NO INCLUYE GASTOS DE VIATICOS EN CASO DE QUE ESTOS SE GENEREN SE FACTURAN POR SEPARADO.', 'LRB', 'L');

		$this->SetXY($x+90,$y);
		$this->MultiCell(90, 3, utf8_decode(' Realizar depósito o transferencia electrónica por el monto total de esta cotización a la siguiente cuenta bancaria:'), 'R', 'C');
		$this->SetXY($this->GetX()+90,$this->GetY());
		$this->MultiCell(90, 5, '', 'R', 'C');
		$this->SetXY($this->GetX()+90,$this->GetY());
		$this->MultiCell(90, 3, utf8_decode('Banco: Banamex Sucursal: 4320 Cta.: 9518'), 'R', 'C');
		$this->SetXY($this->GetX()+90,$this->GetY());
		$this->MultiCell(90, 3, utf8_decode('Titular: GLORIA GUADALUPE CAMARENA FLORES'), 'R', 'C');
		$this->SetXY($this->GetX()+90,$this->GetY());
		$this->MultiCell(90, 3, utf8_decode('CIB: 002362432000095183'), 'R', 'C');
		$this->SetXY($this->GetX()+90,$this->GetY());
		$this->MultiCell(90, 5, '', 'R', 'C');
		$this->SetXY($this->GetX()+90,$this->GetY());
		$this->MultiCell(90, 3, utf8_decode('Una vez realizado su pago deberá enviar su ficha/comprobante de depósito, indicando el Folio de su cotización al e-mail: ventas@tiendapaq.com.mx'), 'R', 'C');
		$this->SetXY($this->GetX()+90,$this->GetY());
		$this->MultiCell(90, 5, '', 'RB', 'C');
	}

	function GetMultiCellHeight($w, $h, $txt, $border=null, $align='J') {
		// Calculate MultiCell with automatic or explicit line breaks height
		// $border is un-used, but I kept it in the parameters to keep the call
		//   to this function consistent with MultiCell()
		$cw = &$this->CurrentFont['cw'];
		if($w==0)
			$w = $this->w-$this->rMargin-$this->x;
		$wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
		$s = str_replace("\r",'',$txt);
		$nb = strlen($s);
		if($nb>0 && $s[$nb-1]=="\n")
			$nb--;
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$ns = 0;
		$height = 0;
		while($i<$nb)
		{
			// Get next character
			$c = $s[$i];
			if($c=="\n")
			{
				// Explicit line break
				if($this->ws>0)
				{
					$this->ws = 0;
					$this->_out('0 Tw');
				}
				//Increase Height
				$height += $h;
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$ns = 0;
				continue;
			}
			if($c==' ')
			{
				$sep = $i;
				$ls = $l;
				$ns++;
			}
			$l += $cw[$c];
			if($l>$wmax)
			{
				// Automatic line break
				if($sep==-1)
				{
					if($i==$j)
						$i++;
					if($this->ws>0)
					{
						$this->ws = 0;
						$this->_out('0 Tw');
					}
					//Increase Height
					$height += $h;
				}
				else
				{
					if($align=='J')
					{
						$this->ws = ($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
						$this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
					}
					//Increase Height
					$height += $h;
					$i = $sep+1;
				}
				$sep = -1;
				$j = $i;
				$l = 0;
				$ns = 0;
			}
			else
				$i++;
		}
		// Last chunk
		if($this->ws>0)
		{
			$this->ws = 0;
			$this->_out('0 Tw');
		}
		//Increase Height
		$height += $h;

		return $height;
	}

	//MultiCell with bullet
	function MultiCellBlt($w, $h, $blt, $txt, $border=0, $align='J', $fill=false)
	{
		//Get bullet width including margins
		$blt_width = $this->GetStringWidth($blt)+$this->cMargin*2;
		//Save x
		$bak_x = $this->x;
		//Output bullet
		$this->Cell($blt_width,$h,$blt,0,'',$fill);
		//Output text
		$this->MultiCell($w-$blt_width,$h,$txt,$border,$align,$fill);
		//Restore x
		$this->x = $bak_x;
	}
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
