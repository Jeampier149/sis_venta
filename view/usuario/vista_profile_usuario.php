<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-danger">
            <div class="ibox-head">
                <div class="ibox-title">Simple collapsed panel</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="ibox-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <div class="row ">
                    <div class="col-lg-3 col-md-4 mt-5">
                        <div class="ibox">
                            <form action="" method="post" enctype="multipart/form-data" onsubmit="return false">
                                <div class="ibox-body text-center">
                                    <div class="m-t-20">
                                        <img class="img-circle img-fluid" id="img_perfil" />
                                    </div>
                                    <h5 class="font-strong m-b-10 m-t-10" id="nombre_usuario">Frank Cruz</h5>
                                    <div class="m-b-20 text-muted" id="rol_u">Web Developer</div>
                                    <div class="profile-social m-b-20">
                                        <input type="file" name="" id="img_profile" value="Elegir Archivo">
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-info btn-rounded m-b-5" style="width:100%" onclick="actualizar_imagen_profile()"><i class="fa fa-plus"></i> Actualizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="ibox">
                            <div class="ibox-body">
                                <ul class="nav nav-tabs tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab-7-1" data-toggle="tab"><i class="fa fa-line-chart"></i> Datos Personales</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-7-2" data-toggle="tab"><i class="fa fa-heartbeat"></i> Contraseña</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab-7-1">
                                        <form method="post" enctype="multipart/form-data" onsubmit="return false">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="text" id="id_persona" hidden>
                                                    <label for="">Nombre</label>
                                                    <input type="text" class="form-control" id="txt_nombre_profile" placeholder="Ingrese nuevo nombre"><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">Apellido Paterno</label>
                                                    <input type="text" class="form-control" id="txt_app_profile" placeholder="Ingrese nuevo apellido"><br>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Apellido Materno</label>
                                                    <input type="text" class="form-control" id="txt_apm_profile" placeholder="Ingrese nuevo apellido"><br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" name="" id="docu_actual" hidden>
                                                    <label for="">N° Documento</label>
                                                    <input type="text" class="form-control" id="txt_doc_profile" placeholder="Ingrese nuevo documento"><br>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Tipo Doc</label>
                                                    <select class="js-example-basic-single" name="state" id="cbm_tipo_profile" class="form-control" style="width:100%;">
                                                        <option value="DNI">DNI</option>
                                                        <option value="PASAPORTE">PASAPORTE</option>
                                                        <option value="RUC">RUC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">Telefono</label>
                                                    <input type="text" class="form-control" id="telefono_profile" placeholder="Ingrese telefono"><br>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Sexo</label>
                                                    <select class="js-example-basic-single" name="state" id="cbm_sex_profile" class="form-control" style="width:100%;">
                                                        <option value="MASCULINO">MASCULINO</option>
                                                        <option value="FEMENINO">FEMENINO</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-danger alert-bordered" style="display:none;" id="error_mensaje_profile"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex justify-content-end">
                                                <button class="btn btn-default " type="button" onclick="actualizar_datos_personales()">Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="tab-7-2">
                                        <form method="post" onsubmit="return false" autocomplete="false" id="editar_contra">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="text" name="" id="contra_bd" hidden>
                                                    <label for="">Contraseña Actual</label>
                                                    <input type="text" class="form-control" id="contra_actual" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="">Contraseña Nueva</label>
                                                    <input type="password" class="form-control" id="contra_nueva" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="">Repetir Contraseña </label>
                                                    <input type="password" class="form-control" id="contra_nueva_repetir" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group d-flex justify-content-end mt-5">
                                                <button class="btn btn-default " type="button" onclick="Editar_contra()">Actualizar Contraseña</button>
                                            </div>
                                        </form>

                                    </div>
                                </div><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    traerDatosProfile()

</script>