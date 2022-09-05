<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-danger">
            <div class="ibox-head">
                <div class="ibox-title">MANTENIMIENTO UNIDAD DE MEDIDAS</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="ibox-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="form-group d-flex mt-3 flex-wrap">
                <div class="col-12 col-md-10 ">
                    <div class="input-group">
                        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    </div>
                </div>
                <div class=" form-group col-12 col-md-2">

                    <button class="btn boton-general" style="width:100%" onclick="abrirModal()">Nuevo Registro</button>
                </div>
            </div>
            <div class="ibox-body">
                <table id="tabla_unidad" class="display responsive nowrap table" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Unidad</th>
                            <th>Abreviatura</th>
                            <th>Fecha de Registro</th>
                            <th>Estatus</th>
                            <th>Acci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Unidad</th>
                            <th>Abreviatura</th>
                            <th>Fecha de Registro</th>
                            <th>Estatus</th>
                            <th>Acci&oacute;n</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_registrar_unidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR UNIDAD DE MEDIDA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <label for="">Unidad de Medida</label>
                    <input type="text" class="form-control" id="txt_unidad" placeholder="Ingrese nuevo rol"><br>
                </div>
                <div class="col-lg-12">
                    <label for="">Abreviatura</label>
                    <input type="text" class="form-control" id="txt_unidad_abreviatura" placeholder="Ingrese nuevo rol"><br>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrar_unidad()">Registrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_editar_unidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDITAR UNIDAD MEDIDA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <input type="text" id="id_unidad" hidden>
                    <label for="">Unidad de Medida</label>
                    <input type="text" id="unidad_actual"hidden >
                    <input type="text" class="form-control" id="unidad_new" placeholder="Ingrese nueva categoria"><br>
                </div>
                <div class="col-lg-12">
                    <label for="">Abreviatura</label>
                    <input type="text" id="abreviatura_actual"hidden >
                    <input type="text" class="form-control" id="txt_unidad_abreviatura_new" placeholder="Ingrese nuevo rol"><br>
                </div>
                <div class="col-lg-12">
                    <label for="">Estado</label>
                    <select class="js-example-basic-single" name="state" id="cbm_estatus_unidad" style="width:100%;">
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                    </select><br><br>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_unidad()">Registrar</button>
            </div>
        </div>
    </div>
</div>
<script src="../js/console_unidad.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        listar_unidad()
    });
</script>