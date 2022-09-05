var table_cliente;
function listar_cliente() {
    table_cliente = $("#tabla_cliente").DataTable({
        "ordering": true,
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "method": "POST",
            "url": "../controller/cliente/controlador_cliente_listar.php",
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "persona" },
            { "data": "persona_nrodoc" },
            { "data": "persona_tipodoc" },
            { "data": "persona_sexo" },
            { "data": "persona_telefono" },
            {
                "data": "cliente_estatus",
                render: function (data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='badge badge-success badge-pill m-r-5 m-b-5'>" + data + "</span>";
                    } else {
                        return "<span class='badge badge-danger badge-pill m-r-5 m-b-5'>" + data + "</span>";
                    }
                }
            },
            {
                "data": "cliente_estatus",
                render: function (data, type, row) {
                    if (data == 'ACTIVO') {
                        return `  <button style='font-size:13px;min-width:76px;margin-right:1px;' type='button' class='inhabilitar btn inha '><i class="fa fa-times-circle"></i> Inhabilitar</button>`;
                    } else {
                        return `<button style='font-size:13px;min-width:76px;margin-right:1px;' type='button' class='hablitar btn habil'><i class="fa fa-check-square"></i> Habilitar   </button>`;
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
   

    document.getElementById('tabla_cliente_filter').style.display = "none";
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
    table_cliente.on('draw.dt', function () {
        var PageInfo = $('#tabla_cliente').DataTable().page.info();
        table_cliente.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
  
}
function filterGlobal() {
    $('#tabla_cliente').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function abrirModal() {
    document.querySelector('#error_mensaje').style.display = 'none';
    document.querySelector('#registrar_cliente').reset();
    $('#modal_registrar_cliente').modal({ backdrop: 'static', keyboard: false });
    $('#modal_registrar_cliente').modal('show');
    
}

function registrarCliente() {
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
        "url": '../controller/cliente/controlador_registrar_cliente.php',
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
        let form=document.querySelector('#registrar_cliente')
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
                    $('#modal_registrar_cliente').modal('hide');
                    Swal.fire("Mensaje De Confirmacion", "Persona registrada", "success")
                        .then((value) => {
                           form.reset();
                            table_cliente.ajax.reload()
    
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
$('#tabla_cliente').on('click', '.habil', function () {
    var data = table_cliente.row($(this).parents('tr')).data();
    if (table_cliente.row(this).child.isShown()) {
        data = table_cliente.row(this).data();
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
          modificar_estado_cliente(data.cliente_id,'ACTIVO')
          table_cliente.ajax.reload();
        }
      })

})
$('#tabla_cliente').on('click', '.inha', function () {
    var data = table_cliente.row($(this).parents('tr')).data();
    if (table_cliente.row(this).child.isShown()) {
        data = table_cliente.row(this).data();
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
          modificar_estado_cliente(data.cliente_id,'INACTIVO')
          table_cliente.ajax.reload();
        }
      })

})

function modificar_estado_cliente(id,estado){
   $.ajax({
       url:'../controller/cliente/controlador_cambiar_estado.php',
       type:'POST',
       data:{
           id,
           estado
       }
   }).done(resp=>{
       if(resp>0){
        Swal.fire( "Mensaje de Confirmacion","Se modifico correctamente el estado","success" )
        table_cliente.ajax.reload(); 
       }else{
        Swal.fire( "Mensaje de Error","No se pudo modificar ele stado","error" ) 
       }

   })
}