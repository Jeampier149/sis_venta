<div class="modal fade" id="modal_editar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDITAR USUARIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return false">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" id="id_usuario" hidden>
                            <label for="">Usuario</label>
                            <input type="text" class="form-control" id="usuario_editar" placeholder="Ingrese nuevo rol">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Persona</label>
                            <select class="js-example-basic-single" name="state" id="cbm_persona_editar" style="width:100%;">
                            </select>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Rol</label>
                            <select class="js-example-basic-single" name="state" id="cbm_rol_editar" style="width:100%;">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Email</label>
                            <input type="text" class="form-control" id="email_editar" placeholder="Ingrese nuevo rol">
                            <input type="text" id="email_actual" hidden>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Estado</label>
                            <select class="js-example-basic-single" name="state" id="cbm_estado_editar" style="width:100%;">
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-8">
                            <label for="">Subir Avatar</label><br>
                            <input type="file" id="imagen_editar" accept="image/*" >
                        </div>
                        <div class="col-lg-2 mt-3">
                            <button class="btn btn-success" onclick="actualizar_imagen()">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_usuario()">Rstrar</button>
            </div>
        </div>
    </div>
</div>