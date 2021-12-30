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
            
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Calle: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $calleOrigen, 0, 1);
                
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Municipio: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $municipioOrigen, 0, 1);

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Estado: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $estadoOrigen, 0, 1);

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    CP: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $cpOrigen, 0, 1);
                        
            }
            if($res['calleO']!=' ' && $res['calleD']!=' '){
				$calleOrigen = $res['calleO'];
                $municipioOrigen = $res['municipioO'];
                $estadoOrigen = $res['estadoO'];
                $cpOrigen = $res['cpO'];

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Calle: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $calleOrigen, 0, 1);
                
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Municipio: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $municipioOrigen, 0, 1);

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Estado: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $estadoOrigen, 0, 1);

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    CP: ');
                $pdf->SetFont('Arial', '', $tamLetra);
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
            if($res['calleO']!=' ' && $res['centroD']!=' '){
                $calleDestino = $res['calleD'];
                $municipioDestino = $res['municipioD'];
                $estadoDestino = $res['estadoD'];
                $cpDestino = $res['cpD'];
            
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Calle: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $calleDestino, 0, 1);
                
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Municipio: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $municipioDestino, 0, 1);

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Estado: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $estadoDestino, 0, 1);

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    CP: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $cpDestino, 0, 1);
                        
            }
            if($res['calleO']!=' ' && $res['calleD']!=' '){
				$calleDestino = $res['calleD'];
                $municipioDestino = $res['municipioD'];
                $estadoDestino = $res['estadoD'];
                $cpDestino = $res['cpD'];

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Calle: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $calleDestino, 0, 1);
                
                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Municipio: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $municipioDestino, 0, 1);

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    Estado: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $estadoDestino, 0, 1);

                $pdf->SetFont('Arial', 'B', $tamLetra);
                $pdf->Write(10, '    CP: ');
                $pdf->SetFont('Arial', '', $tamLetra);
                $pdf->Cell(0, 10, $cpDestino, 0, 1);
           
			}
	
	
			$pdf->Image('../img/codigo.jpg', 58, 210, 100);
            $pdf->SetFont('Arial', '', $tamLetra);
            $pdf->Cell(0, 68, $guia1, 0, 1,'C');
            $pdf->Output();



mysqli_close($conec);


?>