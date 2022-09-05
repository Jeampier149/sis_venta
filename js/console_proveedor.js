var table_proveedor;
function listar_proveedor() {
    table_proveedor = $("#tabla_proveedor").DataTable({
        "ordering": true,
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "method": "POST",
            "url": "../controller/proveedor/controlador_proveedor_listar.php",
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "persona" },
            { "data": "proveedor_contacto" },
            { "data": "proveedor_numero" },
            { "data": "persona_nrodoc" },
            { "data": "persona_tipodoc" },
            {
                "data": "proveedor_estatus",
                render: function (data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='badge badge-success badge-pill m-r-5 m-b-5'>" + data + "</span>";
                    } else {
                        return "<span class='badge badge-danger badge-pill m-r-5 m-b-5'>" + data + "</span>";
                    }
                }
            },
            {
                "data": "proveedor_estatus",
                render: function (data, type, row) {
                    if (data == 'ACTIVO') {
                        return `  <button style='font-size:13px;min-width:76px;margin-right:1px;' type='button' class='inhabilitar btn inha '><i class="fa fa-times-circle"></i> Inhabilitar</button>
                                  <button style='font-size:13px;min-width:76px;margin-right:1px;' type='button' class='editar btn btn-info '><i class="fa fa-edit"></i> Editar</button>`;
                    } else {
                        return `<button style='font-size:13px;min-width:76px;margin-right:1px;' type='button' class='hablitar btn habil'><i class="fa fa-check-square"></i> Habilitar   </button>
                        <button style='font-size:13px;min-width:76px;margin-right:1px;' type='button' class='editar btn btn-info '><i class="fa fa-edit"></i> Editar</button>`;
                    }
                }
            }


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


    document.getElementById('tabla_proveedor_filter').style.display = "none";
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
    table_proveedor.on('draw.dt', function () {
        var PageInfo = $('#tabla_proveedor').DataTable().page.info();
        table_proveedor.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

}
function filterGlobal() {
    $('#tabla_proveedor').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function abrirModal() {
    document.querySelector('#error_mensaje').style.display = 'none';
    $('#modal_registrar_proveedor').modal({ backdrop: 'static', keyboard: false });
    $('#modal_registrar_proveedor').modal('show');

}

function registrarProveedor() {
    var nombre = $("#txt_nombre").val();
    var razon = $("#txt_razon").val();
    var contacto = $("#txt_contacto").val();
    var num_contacto = $("#txt_num_contacto").val();
    var app = $("#txt_app").val();
    var apm = $("#txt_apm").val();
    var documento = $("#txt_doc").val();
    var tipo_doc = $("#cbm_tipo").val();
    var telefono = $("#txt_telefono").val();
    var sexo = $("#cbm_sex").val();
    if (nombre.length == 0 || razon.length == 0 || contacto.length == 0 || num_contacto == 0 || app.length == 0 || apm.length == 0 || documento.length == 0 || tipo_doc.length == 0 || telefono.length == 0 || sexo.length == 0) {
        return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
    }

    $.ajax({
        "url": '../controller/proveedor/controlador_registrar_proveedor.php',
        type: "POST",
        data: {
            nombre,
            razon,
            contacto,
            num_contacto,
            app,
            apm,
            documento,
            tipo_doc,
            telefono,
            sexo
        }
    }).done(function (response) {
        let form = document.querySelector('#registrar_proveedor')
        var contenedor_mensaje = document.querySelector('#error_mensaje');
        if (isNaN(response)) {
            var data = JSON.parse(response);
            contenedor_mensaje.style.display = "block";
            var html = '';
            data.forEach(mensaje => {
                html += `
                <span style="display:block;"><strong>WOW!</strong>${mensaje}</span>
                 `
            })
            contenedor_mensaje.innerHTML = html;

        } else {
            if (response > 0) {
                contenedor_mensaje.style.display = "none";
                if (response == 1) {
                    $('#modal_registrar_proveedor').modal('hide');
                    Swal.fire("Mensaje De Confirmacion", "Persona registrada", "success")
                        .then((value) => {
                            form.reset();
                            table_proveedor.ajax.reload()

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
$('#tabla_proveedor').on('click', '.habil', function () {
    var data = table_proveedor.row($(this).parents('tr')).data();
    if (table_proveedor.row(this).child.isShown()) {
        data = table_proveedor.row(this).data();
    }

    Swal.fire({
        title: 'Desea habilitar al cliente?',
        text: "Esta seguro de Habilitar el cliente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, habilitar!'
    }).then((result) => {
        if (result.isConfirmed) {
            modificar_estado_proveedor(data.proveedor_id, 'ACTIVO')
            table_proveedor.ajax.reload();
        }
    })

})
$('#tabla_proveedor').on('click', '.inha', function () {
    var data = table_proveedor.row($(this).parents('tr')).data();
    if (table_proveedor.row(this).child.isShown()) {
        data = table_proveedor.row(this).data();
    }

    Swal.fire({
        title: 'Desea Inhabilitar al cliente?',
        text: "Esta seguro de Inhabilitar el cliente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Inhabilitar!'
    }).then((result) => {
        if (result.isConfirmed) {
            modificar_estado_proveedor(data.proveedor_id, 'INACTIVO')
            table_proveedor.ajax.reload();
        }
    })

})

function modificar_estado_proveedor(id, estado) {
    $.ajax({
        url: '../controller/proveedor/controlador_cambiar_estado.php',
        type: 'POST',
        data: {
            id,
            estado
        }
    }).done(resp => {
        if (resp > 0) {
            Swal.fire("Mensaje de Confirmacion", "Se modifico correctamente el estado", "success")
            table_proveedor.ajax.reload();
        } else {
            Swal.fire("Mensaje de Error", "No se pudo modificar ele stado", "error")
        }

    })
}

$('#tabla_proveedor').on('click', '.editar', function () {
    let data = table_proveedor.row($(this).parents('tr')).data();
    if (table_proveedor.row(this).child.isShown()) {
        data = table_proveedor.row(this).data();
    }
    //el modal no se cierra al dar click alos costados
    $('#modal_editar_proveedor').modal({ backdrop: 'static', keyboard: false });
    //abrir modal
    $('#modal_editar_proveedor').modal('show');

    $('#id_proveedor').val(data.proveedor_id);
    $('#txt_contacto_editar').val(data.proveedor_contacto);
    $('#txt_num_contacto_editar').val(data.proveedor_numero);
    $('#txt_razon_editar').val(data.proveedor_razonsocial);

})

function editarProveedor() {
    let id = $('#id_proveedor').val()
    let contacto = $('#txt_contacto_editar').val()
    let num_contacto = $('#txt_num_contacto_editar').val()
    let razon = $('#txt_razon_editar').val()
    if (contacto == "" || num_contacto == "" || razon == "" || id == "") {
        return Swal.fire("Mensaje de Advertencia", "Todos los campos son requeridos", "warning")
    }
    $.ajax({
        url: "../controller/proveedor/controlador_editar_proveedor.php",
        type: "POST",
        data: {
            id,
            contacto,
            num_contacto,
            razon
        }
    }).done(function (resp) {
        if (resp > 0) {
            $('#modal_editar_proveedor').modal('hide')
            table_proveedor.ajax.reload();
            Swal.fire("Mensaje de confirmacion", "Proveedor actualizado", "success")
        } else {
            Swal.fire("Mensaje de Error", "No se pudo aactualizar el proveedor", "error")
        }
    })
}