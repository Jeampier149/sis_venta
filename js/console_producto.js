var table_producto;
function listar_producto() {
    table_producto = $("#tabla_producto").DataTable({
        "ordering": true,
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "method": "POST",
            "url": "../controller/producto/controlador_producto_listar.php",
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "producto_nombre" },
            { "data": "producto_presentacion" },
            { "data": "categoria_nombre" },
            { "data": "unidad_nombre" },
            { "data": "producto_stock" },
            { "data": "producto_precioventa" },
            {
                "data": "producto_foto",
                render: function (data, type, row) {
                    return `<img src="${data}" class="img-circle m-r-10" style="width:28px;" >`
                }
            },
            {
                "data": "producto_estatus",
                render: function (data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='badge badge-success badge-pill m-r-5 m-b-5'>" + data + "</span>";
                    } else {
                        return "<span class='badge badge-danger badge-pill m-r-5 m-b-5'>" + data + "</span>";
                    }
                }
            },
            { "defaultContent": "<button style='font-size:13px;margin-right:1px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i> Editar</button> " }

        ],
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },

        select: true,
    });
   

    document.getElementById('tabla_producto_filter').style.display = "none";
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
    table_producto.on('draw.dt', function () {
        var PageInfo = $('#tabla_producto').DataTable().page.info();
        table_producto.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
  
}
function filterGlobal() {
    $('#tabla_producto').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function abrirModal() {
    $('#modal_registrar_producto').modal({ backdrop: 'static', keyboard: false });
    $('#modal_registrar_producto').modal('show');
    
}
function registrar_producto() {
    let producto = $('#producto_nombre').val();
    let presentacion = $('#producto_presentacion').val();
    let unidad_medida= $('#cbm_unidad').val();
    let categoria = $('#cbm_categoria').val();
    let precio_venta = $('#producto_precio').val();
    let imagen = $('#img_producto').val();
    if (producto.length == "" || presentacion.length == "" || unidad_medida.length == "" || categoria.length == ""|| precio_venta.length == "") {
        return Swal.fire("Mensaje de Advertencia", "todos los campos son requeridos", "warning")
    }
    var f = new Date();
    var extension = imagen.split('.').pop();
    var nombre_archivo = "IMG" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMinutes() + "" + f.getSeconds() + "." + extension;
    var formData = new FormData();
    var foto = $("#img_producto")[0].files[0];
    formData.append('producto', producto)
    formData.append('presentacion', presentacion)
    formData.append('unidad_medida', unidad_medida)
    formData.append('categoria', categoria)
    formData.append('precio_venta', precio_venta)
    formData.append('foto', foto)
    formData.append('nombre_archivo', nombre_archivo)

    $.ajax({
        url: '../controller/producto/controlador_registrar_producto.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            var contenedor_mensaje=document.querySelector('#error_mensaje');
            if(isNaN(resp)){
                var data=JSON.parse(resp);
                contenedor_mensaje.style.display="block";
                var html='';
                data.forEach( mensaje =>{
                     html+=`
                    <span style="display:block;"><strong>WOW!</strong>${mensaje}</span>
                     `
                })
              contenedor_mensaje.innerHTML=html;
            }else{
                if (resp > 0) {
                    let formulario=document.querySelector('#registrar_prod')
                    if (resp == 1) {
                        table_producto.ajax.reload()
                        $('#modal_registrar_producto').modal('hide');
                        Swal.fire("Mensaje de Confirmacion", "Se registro el nuevo producto correctamente", "success")
                        .then((value) => {
                   
                         formulario.reset();
                         contenedor_mensaje.style.display="none"
    
                        })
                    } else {
                        Swal.fire("Mensaje de Advertencia", "El producto ya existe", "warning")
                    }
                } else {
                    Swal.fire("Mensaje de Error", "No se pudo ejecutar el registro :C", "error")
                }
            }
        
        }
    });
    return false;
}

function listar_combo_unidad() {
    $.ajax({
        "url": '../controller/producto/controlador_listar_combo_unidad.php',
        type: 'POST'
    }).done(function (response) {
        var data = JSON.parse(response);
        let divOption = document.querySelector('#cbm_unidad')
        let divOptionEditar = document.querySelector('#cbm_unidad_editar')
      console.log(data)
       
        if (data.length > 0) {
            let html = ''
            data.forEach(dato => {
                const { unidad_id, unidad_nombre } = dato
                html += `   
            <option value="${unidad_id}">${unidad_nombre}</option>
             `
            })
            divOption.insertAdjacentHTML('beforeend', html);
            divOptionEditar.insertAdjacentHTML('beforeend', html);
         

        } else {
            divOption.innerHTML = `<option value="">No se encontraron resultados</option>`
           
        }
    })
}
function listar_combo_categoria() {
    $.ajax({
        "url": '../controller/producto/controlador_listar_combo_categoria.php',
        type: 'POST'
    }).done(function (response) {
        var data = JSON.parse(response);
        let divOption = document.querySelector('#cbm_categoria')
        let divOptionEditar = document.querySelector('#cbm_categoria_editar')
        if (data.length > 0) {
            let html = ''
            data.forEach(dato => {
                const { categoria_id, categoria_nombre } = dato
                html += `   
            <option value="${categoria_id}">${categoria_nombre}</option>
             `
            })
            divOption.insertAdjacentHTML('beforeend', html);
            divOptionEditar.insertAdjacentHTML('beforeend', html);
         

        } else {
            divOption.innerHTML = `<option value="">No se encontraron resultados</option>`
           
        }
    })
}

$('#tabla_producto').on('click', '.editar', function () {
    let data = table_producto.row($(this).parents('tr')).data();
    if (table_producto.row(this).child.isShown()) {
        data = table_producto.row(this).data();
    }
    //el modal no se cierra al dar click alos costados
    $('#modal_editar_producto').modal({ backdrop: 'static', keyboard: false });
    //abrir modal
    $('#modal_editar_producto').modal('show');
    $('#id_producto').val(data.producto_id);
    $('#producto_actual').val(data.producto_nombre);
    $('#producto_editar').val(data.producto_nombre);    
    $('#presentacion_editar').val(data.producto_presentacion)   
    $('#precio_editar').val(data.producto_precioventa);
    $('#cbm_unidad_editar').val(data.unidad_id).trigger('change');
    $('#cbm_categoria_editar').val(data.categoria_id).trigger('change');
    $('#cbm_estado_editar').val(data.producto_estatus).trigger('change');
    document.querySelector('#error_mensaje_editar').style.display = 'none';
})

function editar_producto() {
    let id= $('#id_producto').val();
    let producto= $('#producto_editar').val();
    let producto_actual= $('#producto_actual').val();
    let presentacion = $('#presentacion_editar').val();
    let precio = $('#precio_editar').val();
    let categoria = $('#cbm_categoria_editar').val();
    let unidad = $('#cbm_unidad_editar').val();
    let estado = $('#cbm_estado_editar').val();
    if ( id.length == ""||estado.length == ""||producto_actual.length == "" || producto.length == "" || presentacion.length == "" ||precio.length==""||categoria.length==""||unidad.length=="") {
        return Swal.fire("Mensaje de Advertencia", "todos los campos son requeridos", "warning")
    }
  
    $.ajax({
        url: '../controller/producto/controlador_editar_producto.php',
        type: 'post',
        data: {
            id,
            producto,
            producto_actual,
            presentacion,
            precio,
            categoria,
            unidad,
            estado
        }
       
    }).done(function(response) {
        var contenedor_mensaje=document.querySelector('#error_mensaje_editar');
        if(isNaN(response)){
            mensaje=JSON.parse(response);
            contenedor_mensaje.style.display="block";
            var html='';
            mensaje.forEach(error=>{
                html+=`
                <span style="display:block;"><strong>WOW!</strong>${error}</span>
                 `
            })
            contenedor_mensaje.innerHTML=html;
        }else{
            if(response>0){
                if(response==1){
                   $('#modal_editar_producto').modal('hide')
                   table_producto.ajax.reload();
                   Swal.fire("Mensaje de Confirmacion", "Datos actualizados", "success") 
                }else{
                   Swal.fire("Mensaje de Advertencia", "el producto ya existe", "warning") 
                }
              }else{
               Swal.fire("Mensaje de Error", "No se puedo actualizar los datos", "error") 
              }
        }
     
    })

}
function actualizar_imagen_producto(){
    let producto = $('#id_producto').val();
    let imagen = $('#img_editar').val();
   
    var f = new Date();
    var extension = imagen.split('.').pop();
    var nombre_archivo = "IMG" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMinutes() + "" + f.getSeconds() + "." + extension;
    var formData = new FormData();
    var foto = $("#img_editar")[0].files[0];

    if(imagen.length==0){
        return Swal.fire("Mensaje de Advertencia", "Seleccione una imgaen","warning")
    }

    formData.append('producto', producto)
    formData.append('foto', foto)
    formData.append('nombre_archivo', nombre_archivo)

    $.ajax({
        url: '../controller/producto/controlador_editar_imagen_producto.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
          alert(resp)
        }
    });
    return false;
}