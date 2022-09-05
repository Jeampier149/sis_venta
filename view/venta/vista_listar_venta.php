<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-danger">
            <div class="ibox-head">
                <div class="ibox-title">MANTENIMIENTO VENTA</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="ibox-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="form-group d-flex align-items-end mt-3 flex-wrap">
                <div class="col-lg-4">
                    <label for="">Fecha Inicio</label>
                    <input type="date" name="fechai" id="fecha_inicio" class="form-control">
                </div>
                <div class="col-lg-4">
                    <label for="">Fecha Fin</label>
                    <input type="date" name="fechaf" id="fecha_fin" class="form-control">
                </div>
                <div class="col-lg-2">    
                    <button class="btn boton-exito" style="width:100%" onclick="listarVenta()"><i class="glyphicon glyphicon-search"> </i> Buscar</button>
                </div>
                <div class="col-12 col-lg-2">
                    <button class="btn boton-general" style="width:100%" onclick="cargar_contenido('contenido_principal','venta/vista_registrar_venta.php')">Nuevo Registro</button>
                </div>
            </div>
            <div class="ibox-body">
                <table id="tabla_venta" class="display responsive nowrap table" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Cliente</th>
                            <th>T.Comprobante</th>
                            <th>S.Comprobante</th>
                            <th>N°Comprobante</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Impuesto</th>
                            <th>Estatus</th>
                            <th>Acci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>



<script src="../js/console_venta.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        fechadefault()
        listarVenta()

    });
</script>