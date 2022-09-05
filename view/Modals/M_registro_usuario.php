<div class="modal fade" id="modal_registrar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR USUARIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return false">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Usuario</label>
                            <input type="text" class="form-control" id="usuario" placeholder="Ingrese nuevo rol">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Contraseña</label>
                            <input type="text" class="form-control" id="password" placeholder="Ingrese nuevo rol">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Persona</label>
                            <select class="js-example-basic-single" name="state" id="cbm_persona" style="width:100%;">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Rol</label>
                            <select class="js-example-basic-single" name="state" id="cbm_rol" style="width:100%;">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Ingrese nuevo rol">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Subir Avatar</label><br>
                            <input type="file" id="imagen" accept="image/*" width="100%">

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrar_usuario()">Rstrar</button>
            </div>
        </div>
    </div>
</div>