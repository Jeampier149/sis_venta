<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-danger">
            <div class="ibox-head">
                <div class="ibox-title">MANTENIMIENTO PERSONA</div>
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
                <table id="tabla_persona" class="display responsive nowrap table" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Persona</th>
                            <th>N° Documento</th>
                            <th>Tipo Documento</th>
                            <th>sexo</th>
                            <th>telefono</th>
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


<div class="modal fade" id="modal_registrar_persona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR ROL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" id="txt_nombre" placeholder="Ingrese nuevo nombre"><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Apellido Paterno</label>
                        <input type="text" class="form-control" id="txt_app" placeholder="Ingrese nuevo apellido"><br>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Apellido Materno</label>
                        <input type="text" class="form-control" id="txt_apm" placeholder="Ingrese nuevo apellido"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">N° Documento</label>
                        <input type="text" class="form-control" id="txt_doc" placeholder="Ingrese nuevo documento"><br>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Tipo Doc</label>
                        <select class="js-example-basic-single" name="state" id="cbm_tipo" class="form-control" style="width:100%;">
                            <option value="DNI">DNI</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="RUC">RUC</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Telefono</label>
                        <input type="text" class="form-control" id="txt_telefono" placeholder="Ingrese telefono"><br>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Sexo</label>
                        <select class="js-example-basic-single" name="state" id="cbm_sex" class="form-control" style="width:100%;">
                            <option value="MASCULINO">MASCULINO</option>
                            <option value="FEMENINO">FEMENINO</option>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-bordered" style="display:none;" id="error_mensaje"></div>
                    </div>



                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrarPersona()">Registrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_editar_persona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDITAR PERSONA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <input type="text" id="id_persona" hidden>
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" id="txt_nombre_editar" placeholder="Ingrese nuevo nombre"><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Apellido Paterno</label>
                        <input type="text" class="form-control" id="txt_app_editar" placeholder="Ingrese nuevo apellido"><br>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Apellido Materno</label>
                        <input type="text" class="form-control" id="txt_apm_editar" placeholder="Ingrese nuevo apellido"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="text" name="" id="docu_actual" hidden>
                        <label for="">N° Documento</label>
                        <input type="text" class="form-control" id="txt_doc_nuevo" placeholder="Ingrese nuevo documento"><br>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Tipo Doc</label>
                        <select class="js-example-basic-single" name="state" id="cbm_tipo_editar" class="form-control" style="width:100%;">
                            <option value="DNI">DNI</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="RUC">RUC</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Telefono</label>
                        <input type="text" class="form-control" id="telefono_editar" placeholder="Ingrese telefono"><br>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Sexo</label>
                        <select class="js-example-basic-single" name="state" id="cbm_sex_editar" class="form-control" style="width:100%;">
                            <option value="MASCULINO">MASCULINO</option>
                            <option value="FEMENINO">FEMENINO</option>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="">Estado</label>
                        <select class="js-example-basic-single" name="state" id="cbm_estado_editar" class="form-control" style="width:100%;">
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                <div class="col-lg-12 ">
                    <div class="alert alert-danger alert-bordered" style="display:none;" id="error_mensaje_editar"></div>
                </div>
                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editarPersona()">Registrar</button>
            </div>
        </div>
    </div>
</div>
<script src="../js/console_persona.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        listar_persona()

    });
</script>