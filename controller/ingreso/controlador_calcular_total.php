<?php
if(!isset($_POST['producto'])){
  $res=[
    "igv"=>0,
    "subtotal"=>0,
    "total"=>0
    
];
 echo json_encode($res);
}else{
  $producto=$_POST['producto']; 

  $impuesto_total=0;
  $subtotal=0;
  foreach($producto as $product){
    $impuesto_total+= $product['impuestosuma'];
    $subtotal+= $product['subtotal'];
  }
  $total=$impuesto_total+$subtotal;
  $resultado=[
      "igv"=>round($impuesto_total,2),
      "subtotal"=>round($subtotal,2),
      "total"=>round($total,2)
  ];
  
  echo json_encode($resultado);
}

