<?php
// Require composer autoload
require_once '../vendor/autoload.php';
require '../../config/conexion_reporte.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
$html = "";
$id = $_GET["id"];
$consulta = "call SP_INGRESO_LISTAR_REPORTE($id)";

$resultado = $mysqli->query($consulta);
while ($row = $resultado->fetch_assoc()) {
  $html .= " <body><header class='clearfix'>
  <div>
      <div style='float:left;' class='tabla_titulo'>
          <div class='logo'>
             <img src='img/log.png' style=' height: 90px;'>
          </div>
          <div class='info'>
              DATOS SPUTNIK<br>
              <span>Domicilio: </span> San Martin de Porres 247 MMM<br>
              <span>Telefono:</span> 99843434<br>
              <span>Correo:</span> correo@corre.com
          </div>
    </div>
    <div class='presentacion'>
        <p style='font-size:16px;' class='ruc'>RUC N° 001212473</p>
        <div style='font-size:16px;' class='tipo'>" . $row["ingreso_tipcomprobante"] . " DE INGRESO</div>
        <p style='font-size:16px;'>" . $row["ingreso_seriecomprobante"] . "-" . $row["ingreso_numcomprobante"] . "</p>
    </div>
</div>
<hr style='height:4px'>
    <div id='project'>
          <table class='exi'>
              <thead >
                  <tr >
                      <th>" . $row['persona_tipodoc'] . "</th>
                      <th >PROVEEDOR</th>
                      <th>CONTACTO</th>
                      <th >FECHA</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td class='blanco'>" . $row['persona_nrodoc'] . "</td>
                      <td class='blanco'>" . $row['proveedor_razonsocial'] . "</td>
                      <td class='blanco'>" . $row['proveedor_numero'] . "</td>
                      <td class='blanco'>" . $row['ingreso_fecha'] . "</td>
                  </tr>
              </tbody>
      </table>
    </div>
</header>
<main>
<table class='tabla-general'>
  <thead>
    <tr>
      <th class='service'>Iten</th>
      <th class='desc'>Producto</th>
      <th>Precio</th>
      <th>Cantidad</th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>";
  $mysqli->next_result();
  $consulta_detalle = "call SP_REPORTE_PRODUCTOS($id)";
  $resultado_detalle = $mysqli->query($consulta_detalle);
  $count = 0;
  while ($row_detalle = $resultado_detalle->fetch_assoc()) {
    $count++;
    $html .= "  <tr>
    <td class='service'>" . $count . "</td>
    <td class='desc'>" . $row_detalle["producto_nombre"] . "</td>
    <td class='unit'>" . $row_detalle["detalleingreso_precio"] . "</td>
    <td class='qty'>" . $row_detalle["detalleingreso_cantidad"] . "</td>
    <td class='total'>" .round( $row_detalle["subtotal"],2) . "</td>
  </tr>";
  }
  $mysqli->next_result();

  if ($row["ingreso_tipcomprobante"] == "FACTURA") {
    $subtotal =round($row["ingreso_total"],2) - round($row["ingreso_impuesto"],2);
    $html .= " 
    <tr>
    <td colspan='2' rowspan='4' style='background:#FFFFFF;'><b><barcode code='04210000526' size='1.2' class='barcode'  type='QR' disableborder='1'/></b></td>
    
  </tr>
    <tr>
      <td colspan='2' style='background:#FFFFFF;'>SUBTOTAL</td>
      <td  style='background:#FFFFFF;'>" . $subtotal . "</td>
    </tr>  
    <tr>
    <td colspan='2' style='background:#FFFFFF;'>IGV " . $row["ingreso_porcentaje"] . "%</td>
    <td  style='background:#FFFFFF;'>" . $row["ingreso_impuesto"] . "</td>
  </tr>
    <tr>
      <td colspan='2' class='total final' style='background:#FFFFFF;' >TOTAL</td>
      <td class='grand total 'style='background:#FFFFFF;'>" . $row['ingreso_total'] . "</td>
    </tr>
";
  } else {
    $html .= "
     <tr>
      <td colspan='4' class=' total final' style='background:#FFFFFF; text-align:right;'>TOTAL</td>
      <td class='grand total final' style='background:#FFFFFF;'>" . $row['ingreso_total'] . "</td>
     </tr>
     ";
  }

  $html .= "</tbody>
</table><div id='notices'>
  <div>NOTICE:</div>
  <div class='notice'>A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
</div>
</main>
<footer>
Invoice was created on a computer and is valid without the signature and seal.
</footer>

</body>";
}

// Write some HTML code:
$stylesheet = file_get_contents('../../css/style_reporte.css'); // la ruta a tu css
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);
$mpdf->Output();
