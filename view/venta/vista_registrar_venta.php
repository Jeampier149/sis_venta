<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-danger ">
          
            <div class="ibox-body ">
                <div class="row d-flex justify-content-around mt-4 ">
                    <div class="col-5">
                        <div class="ibox ibox-info">
                            <div class="ibox-head titu">
                                <div class="ibox-title data">DATOS DEL COMPROBANTE</div>
                            </div>
                            <div class="ibox-body shad venta_equi">
                                <div class="col-12 mb-4">
                                    <label for="">Tipo Comprobante</label>
                                    <select class="js-example-basic-single" id="cbm_compro" class="form-control" style="width:100%;">
                                        <option value="BOLETA">BOLETA</option>
                                        <option value="FACTURA">FACTURA</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="">Impuesto</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa-solid fa-percent"></i></div>
                                        <input class="form-control" type="text" id="impuesto" placeholder="Ingresar Impuesto">
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="">Serie Comprobante</label>
                                    <input type="text" id="serie" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="">Numero Comprobante</label>
                                    <input type="text" id="num" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-5">
                        <div class="ibox ibox-info">
                            <div class="ibox-head titu">
                                <div class="ibox-title data">DATOS DE LA VENTA</div>
                            </div>
                            <div class="ibox-body shad">
                                <div class="col-12 mb-4">
                                    <label for="">Cliente</label>
                                    <select class="js-example-basic-single" id="cbm_cliente" class="form-control" style="width:100%;">
                                    </select>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="">Producto</label>
                                    <select class="js-example-basic-single" name="state" id="cbm_producto" class="form-control" style="width:100%;">
                                    </select>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="">Stock Actual</label>
                                    <input type="number" id="stock" class="form-control" readonly>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="">Precio</label>
                                    <input type="number" id="precio" class="form-control" readonly>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="">Cantidad</label>
                                    <input type="text" id="cantidad" class="form-control">
                                </div>
                                <div class="col-12">
                                    <button class="btn boton-exito" style="width:100%" onclick="agregar_producto()">Agregar</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row" id="detall" style="padding:50px; display:none;">
                    <div class="ibox ibox-info">
                        <div class="ibox-head titu">
                            <div class="ibox-title data">DATOS DEL COMPROBANTE</div>
                        </div>
                        <div class="ibox-body shad">
                            <div class="row">
                                <div class="col-12" style="display:none!important;" id="tb_blo">

                                    <table id="tabla_detalle_ingreso " class="table-responsive table" style="width:100%">
                                        <thead>
                                            <th>ID</th>
                                            <th>PRODUCTO</th>
                                            <th>PRECIO</th>
                                            <th>CANTIDAD</th>
                                            <th>SUBTOTAL</th>
                                            <th>ACCIONES</th>
                                        </thead>
                                        <tbody id="tb_pv">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row d-flex flex-column align-items-start align-items-md-end ocultar mt-5" id="tabl_p" class="ocultar">
                                <div class=" col-12 col-md-3  mb-2">
                                    <div class="input-group ">
                                        <div class="input-group-addon">S./ Sub Total</div>
                                        <input class="form-control" type="text" id="sub_mostrar" placeholder="input group" readonly>
                                    </div>
                                </div>
                                <div class=" col-12 col-md-3 mb-2">

                                    <div class="input-group">
                                        <div class="input-group-addon">S./ IGV </div>
                                        <input class="form-control" type="text" id="igv_mostrar" placeholder="input group" readonly>
                                    </div>
                                </div>

                                <div class=" col-12 col-md-3 ">

                                    <div class="input-group">
                                        <div class="input-group-addon">S/. Monto Total</div>
                                        <input class="form-control" type="text" id="total_mostrar" placeholder="input group" readonly width="90px">
                                    </div>

                                </div>
                            </div>
                            <div class="row d-flex justify-content-end mt-4 ocultar" id="reg">
                                <div class="col-3">
                                    <button class="btn boton-exito" style="width:100%" onclick="registrar_venta()">Registrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/console_venta.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: 'SELECCIONE UNA OPCION'
        });
        listar_combo_producto()
        listar_combo_cliente()
        var tipo_c = $('#cbm_compro').val()
        if (tipo_c == "BOLETA") {
            $('#impuesto').prop('disabled', true);
        } else {
            $('#impuesto').prop('disabled', false);
        }

    });
    $('#cbm_compro').change(function() {
        var tipo_c = $('#cbm_compro').val()
        if (tipo_c == "BOLETA") {
            $('#impuesto').prop('disabled', true);
        } else {
            $('#impuesto').prop('disabled', false);
        }
    })
    $('#cbm_producto').on('select2:select', function() {
        let id = $('#cbm_producto').val();
        $('#stock').val(array_stock[id])
        $('#precio').val(array_precio[id])
    })
</script>