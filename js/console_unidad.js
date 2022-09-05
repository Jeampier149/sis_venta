var table_unidad;
function listar_unidad() {

    table_unidad = $("#tabla_unidad").DataTable({
        "ordering": true,
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "method": "POST",
            "url": "../controller/unidad_medida/controlador_unidad_listar.php",
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "unidad_nombre" },
            { "data": "unidad_abreviatura" },
            { "data": "unidad_feregistro" },
            {
                "data": "unidad_estatus",
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
    table_unidad.on('draw.dt', function () {
        var PageInfo = $('#tabla_unidad').DataTable().page.info();
        table_unidad.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    document.getElementById('tabla_unidad_filter').style.display = "none";
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

  
}
function filterGlobal() {
    $('#tabla_unidad').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function abrirModal() {
    $('#modal_registrar_unidad').modal({ backdrop: 'static', keyboard: false });
    $('#modal_registrar_unidad').modal('show');
}
function registrar_unidad() {
    let unidad_medida=$('#txt_unidad').val();
    let unidad_abreviatura=$('#txt_unidad_abreviatura').val();
    if(unidad_medida==""|| unidad_abreviatura==""){
          return Swal.fire("Mensaje de advertencia","Todos los campos son requeridos","warning")
    }

    $.ajax({
        url:"../controller/unidad_medida/controlador_registrar_unidad.php",
        type:"POST",
        data:{
            unidad_medida,
            unidad_abreviatura
        }
    }).done(function(resp){
  
       if(resp>0){
          if(resp==1){
              $('#modal_registrar_unidad').modal('hide');
              Swal.fire("Mensaje De Confirmacion", "Unidad de medida registrada", "success")
              .then((value) => {
                  table_unidad.ajax.reload()
                  $('#txt_unidad').val('');
                  $('#txt_unidad_abreviatura').val('');
              })
          }else{
            Swal.fire("Mensaje de Advertencia","La unidad de medida ya existe","warning")
          }
       }else{
           return Swal.fire("Mensaje de Error","No se pudo registrar la unidad de medida","error")
       }
    })
}
$('#tabla_unidad').on('click', '.editar', function () {
    let data = table_unidad.row($(this).parents('tr')).data();
    if (table_unidad.row(this).child.isShown()) {
        data = table_unidad.row(this).data();
    }
    //el modal no se cierra al dar click alos costados
    $('#modal_editar_unidad').modal({ backdrop: 'static', keyboard: false });
    //abrir modal
    $('#modal_editar_unidad').modal('show');

    $('#id_unidad').val(data.unidad_id);
    $('#unidad_actual').val(data.unidad_nombre); 
    $('#unidad_new').val(data.unidad_nombre);
    $('#abreviatura_actual').val(data.unidad_abreviatura); 
    $('#txt_unidad_abreviatura_new').val(data.unidad_abreviatura);
    $('#cbm_estatus_unidad').val(data.unidad_estatus).trigger('change');

})

function editar_unidad(){
    let id=$('#id_unidad').val();
    let unidad_actual=$('#unidad_actual').val();
    let unidad_new=$('#unidad_new').val();
    let abrev_actual=$('#abreviatura_actual').val();
    let abrev_new=$('#txt_unidad_abreviatura_new').val();
    let estado=$('#cbm_estatus_unidad').val();
    
    if(unidad_actual=="" || unidad_new=="" || estado==""||id==""||abrev_actual=="" || abrev_new=="" ){
        return Swal.fire("Mensaje de Advertencia","Todos los campos son requeridos","warning")
    }
    $.ajax({
        url:"../controller/unidad_medida/controlador_editar_unidad.php",
        type:"POST",
        data:{
            id,
            unidad_actual,
            unidad_new,
            abrev_actual,
            abrev_new,
            estado
        }
    }).done(function(resp){
     var   response = parseInt(resp);
  
        switch (response) {
            case 0:
                Swal.fire("Mensaje De Advertencia", "No se pudo actualizar la unidad de medida", "error");
                break;
            case 1:
                $('#modal_editar_unidad').modal('hide');
                Swal.fire("Mensaje De Confirmacion", "La unida de medida se actualizo correctamente", "success")
                    .then((value) => {
                        table_unidad.ajax.reload()

                    })
                break;
            case 2:
                 Swal.fire("Mensaje De Advertencia", "La unidad de medida y/o abreviatura ya existe", "warning");
                break;
        }
    })

    
}