var table_persona;
function listar_persona() {
    table_persona = $("#tabla_persona").DataTable({
        "ordering": true,
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "method": "POST",
            "url": "../controller/persona/controlador_persona_listar.php",
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "persona" },
            { "data": "persona_nrodoc" },
            { "data": "persona_tipodoc" },
            { "data": "persona_sexo" },
            { "data": "persona_telefono" },
            {
                "data": "persona_estatus",
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
   

    document.getElementById('tabla_persona_filter').style.display = "none";
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
    table_persona.on('draw.dt', function () {
        var PageInfo = $('#tabla_persona').DataTable().page.info();
        table_persona.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
  
}
function filterGlobal() {
    $('#tabla_persona').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function abrirModal() {
    document.querySelector('#error_mensaje').style.display = 'none';
    $('#modal_registrar_persona').modal({ backdrop: 'static', keyboard: false });
    $('#modal_registrar_persona').modal('show');
    
}

function registrarPersona() {
    var nombre = $("#txt_nombre").val();
    var app = $("#txt_app").val();
    var apm = $("#txt_apm").val();
    var documento = $("#txt_doc").val();
    var tipo_doc = $("#cbm_tipo").val();
    var telefono = $("#txt_telefono").val();
    var sexo = $("#cbm_sex").val();
    if (nombre.length == 0 || app.length == 0 || apm.length == 0 || documento.length == 0 || tipo_doc.length == 0 || telefono.length == 0|| sexo.length == 0) {
        return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
    }

    $.ajax({
        "url": '../controller/persona/controlador_registrar_persona.php',
        type: "POST",
        data: {
            nombre,
            app,
            apm,
            documento,
            tipo_doc,
            telefono,
            sexo
        }
    }).done(function (response) {
        var contenedor_mensaje=document.querySelector('#error_mensaje');
        if(isNaN(response)){
            var data=JSON.parse(response);
            contenedor_mensaje.style.display="block";
            var html='';
            data.forEach( mensaje =>{
                 html+=`
                <span style="display:block;"><strong>WOW!</strong>${mensaje}</span>
                 `
            })
          contenedor_mensaje.innerHTML=html;
        }else{
            if (response > 0) {
                contenedor_mensaje.style.display="none";
                if (response == 1) {
                    $('#modal_registrar_persona').modal('hide');
                    Swal.fire("Mensaje De Confirmacion", "Persona registrada", "success")
                        .then((value) => {
                           // formulario.reset();
                            table_persona.ajax.reload()
    
                        })
                } else {
                    Swal.fire("Mensaje De Advertencia", "La persona ya existe", "warning");
                }
            } else {
                Swal.fire("Mensaje De Error", "No se pudo registrar la persona", "error");
            }
        }
    
    })

}
$('#tabla_persona').on('click', '.editar', function () {
    let data = table_persona.row($(this).parents('tr')).data();
    if (table_persona.row(this).child.isShown()) {
        data = table_persona.row(this).data();
    }
    //el modal no se cierra al dar click alos costados
    $('#modal_editar_persona').modal({ backdrop: 'static', keyboard: false });
    //abrir modal
    $('#modal_editar_persona').modal('show');
    $('#id_persona').val(data.persona_id);
    $('#txt_nombre_editar').val(data.persona_nombre);    
    $('#txt_app_editar').val(data.persona_app)   
    $('#txt_apm_editar').val(data.persona_apm);
    $('#txt_doc_nuevo').val(data.persona_nrodoc);
    $('#telefono_editar').val(data.persona_telefono);
    $('#docu_actual').val(data.persona_nrodoc);
    $('#cbm_tipo_editar').val(data.persona_tipodoc).trigger('change');
    $('#cbm_sex_editar').val(data.persona_sexo).trigger('change');
    $('#cbm_estado_editar').val(data.persona_estatus).trigger('change');
    document.querySelector('#error_mensaje_editar').style.display = 'none';

})

function editarPersona() {
    var id= $('#id_persona').val()
    var nombre = $("#txt_nombre_editar").val();
    var app = $("#txt_app_editar").val();
    var apm = $("#txt_apm_editar").val();
    var documento_nuevo = $("#txt_doc_nuevo").val();
    var documento_actual = $("#docu_actual").val();
    var tipo_doc = $("#cbm_tipo_editar").val();
    var telefono = $("#telefono_editar").val();
    var sexo = $("#cbm_sex_editar").val();
    var estado= $("#cbm_estado_editar").val();
    if (nombre.length == 0 ||id.length == 0 || app.length == 0 || apm.length == 0 || documento_nuevo.length == 0 ||documento_actual.length == 0 || tipo_doc.length == 0 || telefono.length == 0|| sexo.length == 0|| estado.length == 0) {
        return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
    }

    $.ajax({
        "url": '../controller/persona/controlador_editar_persona.php',
        type: "POST",
        data: {
            id,
            nombre,
            app,
            apm,
            documento_nuevo,
            documento_actual,
            tipo_doc,
            telefono,
            sexo,
            estado
        }
    }).done(function (response) {
        var contenedor_mensaje=document.querySelector('#error_mensaje_editar');
        if(isNaN(response)){
            var data=JSON.parse(response);
            contenedor_mensaje.style.display="block";
            var html='';
            data.forEach( mensaje =>{
                 html+=`
                <span style="display:block;"><strong>WOW!</strong>${mensaje}</span>
                 `
            })
          contenedor_mensaje.innerHTML=html;
        }else{
            if (response > 0) {
                contenedor_mensaje.style.display="none";
                if (response == 1) {
                    $('#modal_editar_persona').modal('hide');
                    Swal.fire("Mensaje De Confirmacion", "Persona registrada", "success")
                        .then((value) => {
                           // formulario.reset();
                            table_persona.ajax.reload()
    
                        })
                } else {
                    Swal.fire("Mensaje De Advertencia", "La persona ya existe", "warning");
                }
            } else {
                Swal.fire("Mensaje De Error", "No se pudo registrar la persona", "error");
            }
        }
    
    })

}