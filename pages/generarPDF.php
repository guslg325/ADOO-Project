<?php

session_start(); // Inicio de la sesión

include("../fpdf184/fpdf.php");
$conec = mysqli_connect("localhost","root","","squid");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
mysqli_set_charset($conec,"utf8");
if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../img/encabezado.png', 6, 3, 200);
        $this->Ln(25);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1.5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

    
        $guia1 =$_SESSION["guia2"];
        $correo = $_SESSION["correo"];

            $tamLetra = 12;
            $datosEnvio = mysqli_query($conec, "SELECT * FROM envios WHERE guia='$guia1'");
            $res = mysqli_fetch_array($datosEnvio);
            $nombreOrigen = $res['nombreO'];
            $correoOrigen = $res['correoO'];
            $telefonoOrigen = $res['telefonoO'];
            
            $fechaEnvio = $res['fechaEnvio'];
           
            $nombreDestino = $res['nombreD'];
            $correoDestino = $res['correoD'];
            $telefonoDestino = $res['telefonoD'];

          
            
            $pdf = new PDF();

            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(0, 20, 'Comprobante de Envío', 0, 1, 'C');
			

			$pdf->Ln(3);
            
            $pdf->SetFont('Arial', 'B', $tamLetra);
            $pdf->Write(10, '    DATOS DEL PAQUETE: ');
			$pdf->Ln();

           
            if($res['status']=='1' ){
                            
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Estatus: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, 'Envío esperando recolección', 0, 1);
            }

            if($res['tipoPaquete']=='1'){
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Tipo de paquete: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, 'Sobre para documentos', 0, 1);
            }
            if($res['tipoPaquete']=='2'){
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Tipo de paquete: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, 'Caja pequeña', 0, 1);
            }        
            if($res['tipoPaquete']=='3'){
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Tipo de paquete: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, 'Caja mediana', 0, 1);
            }   
            if($res['tipoPaquete']=='4'){
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Tipo de paquete: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, 'Caja grande', 0, 1);
            }   
                

            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Arial', 'B', $tamLetra);
            $pdf->Write(10, '    Fecha de envío: ');
            $pdf->SetFont('Arial', '', $tamLetra);
            $pdf->Cell(0, 10, $fechaEnvio, 0, 1);
            
            
            
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', $tamLetra);
            $pdf->Write(10, '    DATOS DE ORIGEN: ');
			$pdf->Ln();

            $pdf->SetFont('Arial', 'B', $tamLetra);
            $pdf->Write(10, '    Nombre: ');
            $pdf->SetFont('Arial', '', $tamLetra);
            $pdf->Cell(0, 10, $nombreOrigen, 0, 1);

			$pdf->SetFont('Arial', 'B', $tamLetra);
            $pdf->Write(10, '    Correo: ');
            $pdf->SetFont('Arial', '', $tamLetra);
            $pdf->Cell(0, 10, $correoOrigen, 0, 1);

			$pdf->SetFont('Arial', 'B', $tamLetra);
            $pdf->Write(10, '    Teléfono: ');
            $pdf->SetFont('Arial', '', $tamLetra);
            $pdf->Cell(0, 10, $telefonoOrigen, 0, 1);
			
			
            if($res['centroO']!=' ' && $res['centroD']!=' ' ){
				$centroOrigen = $res['centroO'];
               
                if($centroOrigen=='1'){
                    $centroOrigen="Calzada de Tlalpan #106";
                }
                if($centroOrigen=='2'){
                    $centroOrigen="Adolfo López Mateos #133";
                }
                if($centroOrigen=='3'){
                    $centroOrigen="Calle de los 50 metro #27";
                }
                if($centroOrigen=='4'){
                    $centroOrigen="Ramon Romo Franco #13";
                }
                if($centroOrigen=='5'){
                    $centroOrigen="Hacienda de Mexicali #2033";
                }
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Centro de Envío: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $centroOrigen, 0, 1);

			}
            if($res['centroO']!=' ' && $res['calleD']!=' '){
                $centroOrigen = $res['centroO'];

                if($centroOrigen=='1'){
                    $centroOrigen="Calzada de Tlalpan #106";
                }
                if($centroOrigen=='2'){
                    $centroOrigen="Adolfo López Mateos #133";
                }
                if($centroOrigen=='3'){
                    $centroOrigen="Calle de los 50 metro #27";
                }
                if($centroOrigen=='4'){
                    $centroOrigen="Ramon Romo Franco #13";
                }
                if($centroOrigen=='5'){
                    $centroOrigen="Hacienda de Mexicali #2033";
                }
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Centro de Envío: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $centroOrigen, 0, 1);

            }
            if($res['calleO']!=' ' && $res['centroD']!=' '){
                $calleOrigen = $res['calleO'];
                $municipioOrigen = $res['municipioO'];
                $estadoOrigen = $res['estadoO'];
                $cpOrigen = $res['cpO'];
            
                if($estadoOrigen=='1'){
                    $estadoOrigen="Aguascalientes";                    
                }
                if($estadoOrigen=='2'){
                    $estadoOrigen="Baja California";                    
                }
                if($estadoOrigen=='3'){
                    $estadoOrigen="Baja California Sur";                    
                }
                if($estadoOrigen=='4'){
                    $estadoOrigen="Campeche";                    
                }
                if($estadoOrigen=='5'){
                    $estadoOrigen="Chiapas";                    
                }
                if($estadoOrigen=='6'){
                    $estadoOrigen="Chihuahua";                    
                }
                if($estadoOrigen=='7'){
                    $estadoOrigen="Ciudad de México";                    
                }
                
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Dirección: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Write(10, $calleOrigen);
                $pdf->Write(10, ' ');
                $pdf->Write(10, $municipioOrigen);
                $pdf->Write(10, ' ');
                $pdf->Write(10, $estadoOrigen);
                $pdf->Write(10, ' ');
                $pdf->Cell(0, 10, $cpOrigen, 0, 1);
            }
            if($res['calleO']!=' ' && $res['calleD']!=' '){
				$calleOrigen = $res['calleO'];
                $municipioOrigen = $res['municipioO'];
                $estadoOrigen = $res['estadoO'];
                $cpOrigen = $res['cpO'];

                if($estadoOrigen=='1'){
                    $estadoOrigen="Aguascalientes";                    
                }
                if($estadoOrigen=='2'){
                    $estadoOrigen="Baja California";                    
                }
                if($estadoOrigen=='3'){
                    $estadoOrigen="Baja California Sur";                    
                }
                if($estadoOrigen=='4'){
                    $estadoOrigen="Campeche";                    
                }
                if($estadoOrigen=='5'){
                    $estadoOrigen="Chiapas";                    
                }
                if($estadoOrigen=='6'){
                    $estadoOrigen="Chihuahua";                    
                }
                if($estadoOrigen=='7'){
                    $estadoOrigen="Ciudad de México";                    
                }

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Dirección: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Write(10, $calleOrigen);
                $pdf->Write(10, ' ');
                $pdf->Write(10, $municipioOrigen);
                $pdf->Write(10, ' ');
                $pdf->Write(10, $estadoOrigen);
                $pdf->Write(10, ' ');
                $pdf->Cell(0, 10, $cpOrigen, 0, 1);
           
			}
            
   
            $pdf->Ln(3);

            $pdf->SetFont('Arial', 'B', $tamLetra);
            $pdf->Write(10, '    DATOS DE DESTINO: ');
			$pdf->Ln();
            
            $pdf->SetFont('Arial', 'B', $tamLetra);
            $pdf->Write(10, '    Nombre: ');
            $pdf->SetFont('Arial', '', $tamLetra);
            $pdf->Cell(0, 10, $nombreDestino, 0, 1);

			$pdf->SetFont('Arial', 'B', $tamLetra);
            $pdf->Write(10, '    Correo: ');
            $pdf->SetFont('Arial', '', $tamLetra);
            $pdf->Cell(0, 10, $correoDestino, 0, 1);

			$pdf->SetFont('Arial', 'B', $tamLetra);
            $pdf->Write(10, '    Teléfono: ');
            $pdf->SetFont('Arial', '', $tamLetra);
            $pdf->Cell(0, 10, $telefonoDestino, 0, 1);


            if($res['centroO']!=' ' && $res['centroD']!=' ' ){
				$centroDestino = $res['centroD'];
                
                if($centroDestino=='1'){
                    $centroDestino="Calzada de Tlalpan #106";
                }
                if($centroDestino=='2'){
                    $centroDestino="Adolfo López Mateos #133";
                }
                if($centroDestino=='3'){
                    $centroDestino="Calle de los 50 metro #27";
                }
                if($centroDestino=='4'){
                    $centroDestino="Ramon Romo Franco #13";
                }
                if($centroDestino=='5'){
                    $centroDestino="Hacienda de Mexicali #2033";
                }
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Centro de Envío: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $centroDestino, 0, 1);

			}
            if($res['centroO']!=' ' && $res['calleD']!=' '){
                
                $calleDestino = $res['calleD'];
                $municipioDestino = $res['municipioD'];
                $estadoDestino = $res['estadoD'];
                $cpDestino = $res['cpD'];
                
                if($estadoDestino=='1'){
                    $estadoDestino="Aguascalientes";                    
                }
                if($estadoDestino=='2'){
                    $estadoDestino="Baja California";                    
                }
                if($estadoDestino=='3'){
                    $estadoDestino="Baja California Sur";                    
                }
                if($estadoDestino=='4'){
                    $estadoDestino="Campeche";                    
                }
                if($estadoDestino=='5'){
                    $estadoDestino="Chiapas";                    
                }
                if($estadoDestino=='6'){
                    $estadoDestino="Chihuahua";                    
                }
                if($estadoDestino=='7'){
                    $estadoDestino="Ciudad de México";                    
                }

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Dirección: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Write(10, $calleDestino);
                $pdf->Write(10, ' ');
                $pdf->Write(10, $municipioDestino);
                $pdf->Write(10, ' ');
                $pdf->Write(10, $estadoDestino);
                $pdf->Write(10, ' ');
                $pdf->Cell(0, 10, $cpDestino, 0, 1);
                
            }
            if($res['calleO']!=' ' && $res['centroD']!=' '){
                                
                $centroDestino = $res['centroD'];

                if($centroDestino=='1'){
                    $centroDestino="Calzada de Tlalpan #106";
                }
                if($centroDestino=='2'){
                    $centroDestino="Adolfo López Mateos #133";
                }
                if($centroDestino=='3'){
                    $centroDestino="Calle de los 50 metro #27";
                }
                if($centroDestino=='4'){
                    $centroDestino="Ramon Romo Franco #13";
                }
                if($centroDestino=='5'){
                    $centroDestino="Hacienda de Mexicali #2033";
                }
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Centro de Envío: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $centroDestino, 0, 1);
                        
            }
            if($res['calleO']!=' ' && $res['calleD']!=' '){
				$calleDestino = $res['calleD'];
                $municipioDestino = $res['municipioD'];
                $estadoDestino = $res['estadoD'];
                $cpDestino = $res['cpD'];

                if($estadoDestino=='1'){
                    $estadoDestino="Aguascalientes";                    
                }
                if($estadoDestino=='2'){
                    $estadoDestino="Baja California";                    
                }
                if($estadoDestino=='3'){
                    $estadoDestino="Baja California Sur";                    
                }
                if($estadoDestino=='4'){
                    $estadoDestino="Campeche";                    
                }
                if($estadoDestino=='5'){
                    $estadoDestino="Chiapas";                    
                }
                if($estadoDestino=='6'){
                    $estadoDestino="Chihuahua";                    
                }
                if($estadoDestino=='7'){
                    $estadoDestino="Ciudad de México";                    
                }

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Dirección: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Write(10, $calleDestino);
                $pdf->Write(10, ' ');
                $pdf->Write(10, $municipioDestino);
                $pdf->Write(10, ' ');
                $pdf->Write(10, $estadoDestino);
                $pdf->Write(10, ' ');
                $pdf->Cell(0, 10, $cpDestino, 0, 1);
           
			}
	
	
			$pdf->Image('../img/codigo.jpg', 58, 210, 100);
            $pdf->SetFont('Arial', '', $tamLetra);
            $pdf->Cell(0, 68, $guia1, 0, 1,'C');
            $pdf->Output();



mysqli_close($conec);


?>
