<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-danger">
            <div class="ibox-head">
                <div class="ibox-title">MANTENIMIENTO PRODUCTOS</div>
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
                <table id="tabla_producto" class="display responsive nowrap table" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Presentacion</th>
                            <th>Categoria</th>
                            <th>U. Medida</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>foto</th>
                            <th>Estatus</th>
                            <th>Acci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Presentacion</th>
                            <th>Categoria</th>
                            <th>U. Medida</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>foto</th>
                            <th>Estatus</th>
                            <th>Acci&oacute;n</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_registrar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR PRODUCTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return false" id="registrar_prod">

                    <div class="col-lg-12">
                        <label for="">Producto</label>
                        <input type="text" class="form-control" id="producto_nombre" placeholder="Ingrese nuevo rol"><br>
                    </div>
                    <div class="col-lg-12">
                        <label for="">Presentacion</label>
                        <input type="text" class="form-control" id="producto_presentacion" placeholder="Ingrese nuevo rol"><br>
                    </div>
                    <div class="col-lg-12">
                        <label for="">Categoria</label>
                        <select class="js-example-basic-single" name="state" id="cbm_categoria" class="form-control" style="width:100%;">
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label for="">Unidad de Medida</label>
                        <select class="js-example-basic-single" name="state" id="cbm_unidad" class="form-control" style="width:100%;">
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label for="">Precio de Venta</label>
                        <input type="text" class="form-control" id="producto_precio" placeholder="Ingrese nuevo rol"><br>

                    </div>
                    <div class="col-lg-12">
                        <label for="">Producto Foto</label> <br>
                        <input type="file" name="" id="img_producto" value="">

                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="alert alert-danger alert-bordered" style="display:none;" id="error_mensaje"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrar_producto()">Registrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_editar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDITAR PRODUCTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return false">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="" id="id_producto" hidden>
                            <label for="">Producto</label>
                            <input type="text" name="" id="producto_actual" hidden>
                            <input type="text" class="form-control" id="producto_editar" placeholder="Ingrese nuevo rol">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Presentacion</label>
                            <input type="text" class="form-control" id="presentacion_editar" placeholder="Ingrese nuevo rol">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Categoria</label>
                            <select class="js-example-basic-single" name="state" id="cbm_categoria_editar" class="form-control" style="width:100%;">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Unidad de Medida</label>
                            <select class="js-example-basic-single" name="state" id="cbm_unidad_editar" class="form-control" style="width:100%;">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Precio de Venta</label>
                            <input type="text" class="form-control" id="precio_editar" placeholder="Ingrese nuevo rol">
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
                        <div class="col-lg-9">
                            <label for="">Producto Foto</label> <br>
                            <input type="file" name="" id="img_editar" value="Elegir Archivo">

                        </div>
                        <div class="col-lg-2 mt-3">
                            <button class="btn btn-success" onclick="actualizar_imagen_producto()">Actualizar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-3">
                            <div class="alert alert-danger alert-bordered" style="display:none;" id="error_mensaje_editar"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_producto()">Registrar</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/console_producto.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        listar_producto()
        listar_combo_unidad()
        listar_combo_categoria()
    });
</script>