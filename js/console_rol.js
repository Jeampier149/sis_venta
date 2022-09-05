var table_rol;
function listar_rol() {

    table_rol = $("#tabla_rol").DataTable({
        "ordering": true,
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "method": "POST",
            "url": "../controller/rol/controlador_rol_listar.php",
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "rol_nombre" },
            { "data": "rol_feregistro" },
            {
                "data": "rol_estatus",
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
    table_rol.on('draw.dt', function () {
        var PageInfo = $('#tabla_rol').DataTable().page.info();
        table_rol.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    document.getElementById('tabla_rol_filter').style.display = "none";
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

  
}
function filterGlobal() {
    $('#tabla_rol').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function abrirModal() {
    $('#modal_registrar_rol').modal({ backdrop: 'static', keyboard: false });
    $('#modal_registrar_rol').modal('show');
}
function registrar_rol() {
    let rol=$('#txt_rol').val();


    if(rol==""){
          return Swal.fire("Mensaje de advertencia","Todos los campos son requeridos","warning")
    }

    $.ajax({
        url:"../controller/rol/controlador_registrar_rol.php",
        type:"POST",
        data:{
            rol
        }
    }).done(function(resp){
       if(resp>0){
          if(resp==1){
              $('#modal_registrar_rol').modal('hide');
              Swal.fire("Mensaje De Confirmacion", "Rol registrado", "success")
              .then((value) => {
                  table_rol.ajax.reload()
                  $('#txt_rol').val('');
              })
          }else{
            Swal.fire("Mensaje de Advertencia","El rol ya existe","warning")
          }
       }else{
           return Swal.fire("Mensaje de Error","No se pudo registrar el rol","error")
       }
    })
}

$('#tabla_rol').on('click', '.editar', function () {
    let data = table_rol.row($(this).parents('tr')).data();
    if (table_rol.row(this).child.isShown()) {
        data = table_rol.row(this).data();
    }
    //el modal no se cierra al dar click alos costados
    $('#modal_editar_rol').modal({ backdrop: 'static', keyboard: false });
    //abrir modal
    $('#modal_editar_rol').modal('show');

    $('#rol_actual').val(data.rol_nombre);
    $('#id_rol').val(data.rol_id);
    $('#rol_new').val(data.rol_nombre);
    $('#cbm_estatus').val(data.rol_estatus).trigger('change');

})

function editar_rol(){
    let id=$('#id_rol').val();
    let rol_actual=$('#rol_actual').val();
    let rol_new=$('#rol_new').val();
    let estado=$('#cbm_estatus').val();
    
    if(rol_actual=="" || rol_new=="" || estado==""||id==""){
        return Swal.fire("Mensaje de Advertencia","Todos los campos son requeridos","warning")
    }
    $.ajax({
        url:"../controller/rol/controlador_editar_rol.php",
        type:"POST",
        data:{
            id,
            rol_actual,
            rol_new,
            estado
        }
    }).done(function(resp){
     var   response = parseInt(resp);
        switch (response) {
            case 0:
                Swal.fire("Mensaje De Advertencia", "No se pudo actualizar el rol", "error");
                break;
            case 1:
                $('#modal_editar_rol').modal('hide');
                Swal.fire("Mensaje De Confirmacion", "El rol se actualizo correctamente", "success")
                    .then((value) => {
                        table_rol.ajax.reload()

                    })
                break;
            case 2:
                Swal.fire("Mensaje De Advertencia", "El rol ya existe", "warning");
                break;
        }
    })

    
}