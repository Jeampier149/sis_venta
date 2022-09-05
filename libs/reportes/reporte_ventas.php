<?php
// Require composer autoload
require_once '../vendor/autoload.php';
require '../../config/conexion_reporte.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
$html = "";
$id = $_GET["id"];
$consulta = "call SP_VENTA_LISTAR_REPORTE($id)";

$resultado = $mysqli->query($consulta);
while ($row = $resultado->fetch_assoc()) {
  $html .= " <body><header class='clearfix'>
      <div>
          <table id='tabla_datos'>
              <thead style='background-color:white;' >
                  <tr class='cabezera'>
                      <th><img src='img/logo.jpg' class='logo'></th>
                      <th class='datos'>
                          DATOS SPUTNIK<br>
                          <span>Domicilio: </span> San Martin de Porres 247 MMM<br>
                          <span>Telefono:</span> 99843434<br>
                          <span>Correo:</span> correo@corre.com
                      </th>  
                  </tr>
              </thead>
        </table>
    </div>
    <div class='presentacion'>
    <span style='font-size:16px;'>RUC 24727323</span>
    <h2>" . $row["venta_tipcomprobante"] . " DE venta</h2>
    <span>" . $row["venta_seriecomprobante"] . "-" . $row["venta_numcomprobante"] . "</span>
    </div>
<div id='project'>
  <div><span>" . $row['persona_tipodoc'] . ":</span>" . $row['persona_nrodoc'] . "</div>
  <div><span>Cliente:</span> " . $row['cliente'] . "</div>
  <div><span>Contacto:<i class='fa-solid fa-phone'></i></span> " . $row['persona_telefono'] . "</div>
  <div><span>Fecha:</span> " . $row['venta_fecha'] . "</div>
</div>
</header>
<main>
<table class='tabla-general'>
  <thead>
    <tr>
      <th class='service'>Item</th>
      <th class='desc'>Producto</th>
      <th>Precio</th>
      <th>Cantidad</th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>";
  $mysqli->next_result();
  $consulta_detalle = "call SP_REPORTE_PRODUCTOS_VENTA($id)";
  $resultado_detalle = $mysqli->query($consulta_detalle);
  $count = 0;
  while ($row_detalle = $resultado_detalle->fetch_assoc()) {
    $count++;
    $html .= "  <tr>
    <td class='service'>" . $count . "</td>
    <td class='desc'>" . $row_detalle["producto_nombre"] . "</td>
    <td class='unit'>" . $row_detalle["detalleventa_precio"] . "</td>
    <td class='qty'>" . $row_detalle["detalleventa_cantidad"] . "</td>
    <td class='total'>" . $row_detalle["subtotal"] . "</td>
  </tr>";
  }
  $mysqli->next_result();

  if ($row["venta_tipcomprobante"] == "FACTURA") {
    $subtotal = $row["venta_total"] - $row["venta_impuesto"];
    $html .= " 
    <tr>
    <td colspan='2' rowspan='4' style='background:#FFFFFF;'><b><barcode code='04210000526' size='1.2' class='barcode'  type='QR' disableborder='1'/></b></td>
    
  </tr>
    <tr>
      <td colspan='2' style='background:#FFFFFF;'>SUBTOTAL</td>
      <td  style='background:#FFFFFF;'>" . $subtotal . "</td>
    </tr>  
    <tr>
    <td colspan='2' style='background:#FFFFFF;'>IGV " . $row["venta_porcentaje"] . "%</td>
    <td  style='background:#FFFFFF;'>" . $row["venta_impuesto"] . "</td>
  </tr>
    <tr>
      <td colspan='2' class='total final' style='background:#FFFFFF;' >TOTAL</td>
      <td class='grand total 'style='background:#FFFFFF;'>" . $row['venta_total'] . "</td>
    </tr>
";
  } else {
    $html .= "
     <tr>
      <td colspan='4' class=' total final' style='background:#FFFFFF;'>TOTAL</td>
      <td class='grand total final' style='background:#FFFFFF;'>" . $row['venta_total'] . "</td>
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
