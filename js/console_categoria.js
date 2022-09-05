var table_categoria;
function listar_categoria() {

    table_categoria = $("#tabla_categoria").DataTable({
        "ordering": true,
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "method": "POST",
            "url": "../controller/categoria/controlador_categoria_listar.php",
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "categoria_nombre" },
            { "data": "categoria_feregistro" },
            {
                "data": "categoria_estatus",
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
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
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
    table_categoria.on('draw.dt', function () {
        var PageInfo = $('#tabla_categoria').DataTable().page.info();
        table_categoria.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    document.getElementById('tabla_categoria_filter').style.display = "none";
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

  
}
function filterGlobal() {
    $('#tabla_categoria').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function abrirModal() {
    $('#modal_registrar_categoria').modal({ backdrop: 'static', keyboard: false });
    $('#modal_registrar_categoria').modal('show');
}
function registrar_categoria() {
    let categoria=$('#txt_categoria').val();
    if(categoria==""){
          return Swal.fire("Mensaje de advertencia","Todos los campos son requeridos","warning")
    }

    $.ajax({
        url:"../controller/categoria/controlador_registrar_categoria.php",
        type:"POST",
        data:{
            categoria
        }
    }).done(function(resp){
       if(resp>0){
          if(resp==1){
              $('#modal_registrar_categoria').modal('hide');
              Swal.fire("Mensaje De Confirmacion", "Categoria registrada", "success")
              .then((value) => {
                  table_categoria.ajax.reload()
                  $('#txt_categoria').val('');
              })
          }else{
            Swal.fire("Mensaje de Advertencia","La categoria ya existe","warning")
          }
       }else{
           return Swal.fire("Mensaje de Error","No se pudo registrar la categoria","error")
       }
    })
}
$('#tabla_categoria').on('click', '.editar', function () {
    let data = table_categoria.row($(this).parents('tr')).data();
    if (table_categoria.row(this).child.isShown()) {
        data = table_categoria.row(this).data();
    }
    //el modal no se cierra al dar click alos costados
    $('#modal_editar_categoria').modal({ backdrop: 'static', keyboard: false });
    //abrir modal
    $('#modal_editar_categoria').modal('show');

    $('#categoria_actual').val(data.categoria_nombre);
    $('#id_categoria').val(data.categoria_id);
    $('#categoria_new').val(data.categoria_nombre);
    $('#cbm_estatus_categoria').val(data.categoria_estatus).trigger('change');

})

function editar_categoria(){
    let id=$('#id_categoria').val();
    let categoria_actual=$('#categoria_actual').val();
    let categoria_new=$('#categoria_new').val();
    let estado=$('#cbm_estatus_categoria').val();
    
    if(categoria_actual=="" || categoria_new=="" || estado==""||id==""){
        return Swal.fire("Mensaje de Advertencia","Todos los campos son requeridos","warning")
    }
    $.ajax({
        url:"../controller/categoria/controlador_editar_categoria.php",
        type:"POST",
        data:{
            id,
            categoria_actual,
            categoria_new,
            estado
        }
    }).done(function(resp){
     var   response = parseInt(resp);
        switch (response) {
            case 0:
                Swal.fire("Mensaje De Advertencia", "No se pudo actualizar el rol", "error");
                break;
            case 1:
                $('#modal_editar_categoria').modal('hide');
                Swal.fire("Mensaje De Confirmacion", "El rol se actualizo correctamente", "success")
                    .then((value) => {
                        table_categoria.ajax.reload()

                    })
                break;
            case 2:
                Swal.fire("Mensaje De Advertencia", "El rol ya existe", "warning");
                break;
        }
    })

    
}