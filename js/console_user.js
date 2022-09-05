function validation_user() {
    let password = $('#password').val();
    let user = $('#user').val();
    if (user == "" || password == "") {
        return Swal.fire("Mensaje de Advertencia", "Todos los campos son requeridos", "warning")
    }
    $.ajax({
        url: '../controller/usuario/controlador_validar_usuario.php',
        type: "POST",
        data: {
            password,
            user
        }
    }).done(resp => {
        if (resp == 0) {
            Swal.fire("Mensaje de Advertencia", "Usuario y/o Contraseña incorrecta", "warning")
        } else {
            var data = JSON.parse(resp);
            console.log(data);
            const [info] = data
            const { usuario_estatus, usuario_id, usuario_nombre, rol_id } = info;
            if (usuario_estatus == 'ACTIVO') {
                $.ajax({
                    url: '../controller/usuario/controlador_crear_sesion.php',
                    type: 'POST',
                    data: {
                        idusuario: usuario_id,
                        user: usuario_nombre,
                        rol: rol_id
                    }
                }).done(function (response) {
                    let timerInterval
                    Swal.fire({
                        title: 'BIENVENIDO AL SISTEMA',
                        html: 'Usted sera redireccionado en  <b></b> millisegundos.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    })
                })

            } else {
                Swal.fire("Mensaje de Advertencia", "El usuario no se encuentra activo comuniquese con el administrador", "warning")
            }
        }
    })
}
var table_usuario;
function listar_usuario() {
    table_usuario = $("#tabla_usuario").DataTable({
        "ordering": true,
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "method": "POST",
            "url": "../controller/usuario/controlador_usuario_listar.php",
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "usuario_nombre" },
            { "data": "persona" },
            { "data": "rol_nombre" },
            { "data": "usuario_email" },
            {
                "data": "usuario_imagen",
                render: function (data, type, row) {
                    return `<img src="${data}" class="img-circle m-r-10" style="width:28px;" >`
                }
            },
            {
                "data": "usuario_estatus",
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


    document.getElementById('tabla_usuario_filter').style.display = "none";
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
    table_usuario.on('draw.dt', function () {
        var PageInfo = $('#tabla_usuario').DataTable().page.info();
        table_usuario.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

}
function filterGlobal() {
    $('#tabla_usuario').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}
function listar_combo_persona() {
    $.ajax({
        "url": '../controller/usuario/controlador_listar_combo_persona.php',
        type: 'POST'
    }).done(function (response) {
        var data = JSON.parse(response);
        let divOption = document.querySelector('#cbm_persona')
        let divOptionEdit = document.querySelector('#cbm_persona_editar')

        if (data.length > 0) {
            let html = ''
            data.forEach(dato => {
                const { persona_id, persona } = dato
                html += `   
            <option value="${persona_id}">${persona}</option>
             `
            })
            divOption.insertAdjacentHTML('beforeend', html);
            divOptionEdit.insertAdjacentHTML('beforeend', html);

        } else {
            divOption.innerHTML = `<option value="">No se encontraron resultados</option>`
        }
    })
}
function listar_combo_rol() {
    $.ajax({
        "url": '../controller/usuario/controlador_listar_combo_rol.php',
        type: 'POST'
    }).done(function (response) {
        var data = JSON.parse(response);
        let divOption = document.querySelector('#cbm_rol')
        let divOptionEdit = document.querySelector('#cbm_rol_editar')

        if (data.length > 0) {
            let html = ''
            data.forEach(dato => {
                const { rol_id, rol_nombre } = dato
                html += `   
            <option value="${rol_id}">${rol_nombre}</option>
             `
            })
            divOption.insertAdjacentHTML('beforeend', html);
            divOptionEdit.insertAdjacentHTML('beforeend', html);

        } else {
            divOption.innerHTML = `<option value="">No se encontraron resultados</option>`
            divOptionEdit.innerHTML = `<option value="">No se encontraron resultados</option>`
        }
    })
}
function abrirModal() {
    $('#modal_registrar_usuario').modal({ backdrop: 'static', keyboard: false });
    $('#modal_registrar_usuario').modal('show');
}
function registrar_usuario() {
    let usuario = $('#usuario').val();
    let password = $('#password').val();
    let email = $('#email').val();
    let rol = $('#cbm_rol').val();
    let persona = $('#cbm_persona').val();
    let imagen = $('#imagen').val();
    let expr = /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/;
    if (usuario.length == "" || password.length == "" || persona.length == "" || imagen.length == "" || email.length == "" || rol.length == "") {
        return Swal.fire("Mensaje de Advertencia", "todos los campos son requeridos", "warning")
    }
    if (!(expr.test(email))) {
        return Swal.fire("Mensaje de Advertencia", "El formato de email no es valido", "warning")
    }


    var f = new Date();
    var extension = imagen.split('.').pop();
    var nombre_archivo = "IMG" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMinutes() + "" + f.getSeconds() + "." + extension;
    var formData = new FormData();
    var foto = $("#imagen")[0].files[0];
    formData.append('usuario', usuario)
    formData.append('password', password)
    formData.append('email', email)
    formData.append('rol', rol)
    formData.append('persona', persona)
    formData.append('foto', foto)
    formData.append('nombre_archivo', nombre_archivo)

    $.ajax({
        url: '../controller/usuario/controlador_registrar_usuario.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp > 0) {
                if (resp == 1) {
                    table_usuario.ajax.reload()
                    Swal.fire("Mensaje de Confirmacion", "Se registro el nuevo usuario correctamente", "success")
                } else {
                    Swal.fire("Mensaje de Advertencia", "Elusuario ya existe", "warning")
                }
            } else {
                Swal.fire("Mensaje de Error", "No se pudo ejecutar el registro :C", "error")
            }
        }
    });
    return false;
}

function traerDatosUsuario() {
    let usuario = $("#id_user").val();

    $.ajax({
        "url": '../controller/usuario/controlador_traer_datos_usuario.php',
        type: "POST",
        data: {
            usuario: usuario

        }
    }).done(function (response) {
        var datos = JSON.parse(response);
        console.log(datos)
        if (datos.length > 0) {
            $('.usuario').html(datos[0][1])
            $('#rol_usuario').html(datos[0][7])
            $('.img_us').attr("src",datos[0][17]);

        }

    })
}
$('#tabla_usuario').on('click', '.editar', function () {
    let data = table_usuario.row($(this).parents('tr')).data();
    if (table_usuario.row(this).child.isShown()) {
        data = table_usuario.row(this).data();
    }
    //el modal no se cierra al dar click alos costados
    $('#modal_editar_usuario').modal({ backdrop: 'static', keyboard: false });
    //abrir modal
    $('#modal_editar_usuario').modal('show');
    $('#usuario_editar').val(data.usuario_nombre);
    $('#email_editar').val(data.usuario_email);
    $('#email_actual').val(data.usuario_email);
    $('#id_usuario').val(data.usuario_id);
    $('#cbm_rol_editar').val(data.rol_id).trigger('change');
    $('#cbm_persona_editar').val(data.persona_id).trigger('change');
    $('#cbm_estado_editar').val(data.usuario_estatus).trigger('change');

})
function editar_usuario() {
    let id = $('#id_usuario').val();
    let email = $('#email_editar').val();
    let email_actual = $('#email_actual').val();
    let rol = $('#cbm_rol_editar').val();
    let persona = $('#cbm_persona_editar').val();
    let estado = $('#cbm_estado_editar').val();
    let expr = /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/;
    if (id.length == "" || estado.length == "" || persona.length == "" || email.length == "" || rol.length == "") {
        return Swal.fire("Mensaje de Advertencia", "todos los campos son requeridos", "warning")
    }
    if (!(expr.test(email))) {
        return Swal.fire("Mensaje de Advertencia", "El formato de email no es valido", "warning")
    }

    $.ajax({
        url: '../controller/usuario/controlador_editar_usuario.php',
        type: 'post',
        data: {
            id,
            email,
            email_actual,
            rol,
            persona,
            estado
        }

    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                $('#modal_editar_usuario').modal('hide')
                table_usuario.ajax.reload();
                Swal.fire("Mensaje de Confirmacion", "Datos actualizados", "success")
            } else {
                Swal.fire("Mensaje de Advertencia", "el usuario ya existe", "warning")
            }
        } else {
            Swal.fire("Mensaje de Error", "No se puede actualizar los datos", "error")
        }
    })

}

function actualizar_imagen() {
    let usuario = $('#id_usuario').val();
    let imagen = $('#imagen_editar').val();

    var f = new Date();
    var extension = imagen.split('.').pop();
    var nombre_archivo = "IMG" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMinutes() + "" + f.getSeconds() + "." + extension;
    var formData = new FormData();
    var foto = $("#imagen_editar")[0].files[0];

    if (imagen.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Seleccione una imgaen", "warning")
    }

    formData.append('usuario', usuario)
    formData.append('foto', foto)
    formData.append('nombre_archivo', nombre_archivo)

    $.ajax({
        url: '../controller/usuario/controlador_editar_imagen.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            traerDatosUsuario() ;
            Swal.fire("Mensaje de Confirmacion", "Imagen Actualizada", "success")
        }
    });
    return false;
}
function traerDatosProfile() {
    let usuario = $("#id_user").val();

    $.ajax({
        "url": '../controller/usuario/controlador_traer_datos_usuario.php',
        type: "POST",
        data: {
            usuario: usuario

        }
    }).done(function (response) {
        var datos = JSON.parse(response);
        console.log(datos)
        if (datos.length > 0) {
            $('#contra_nueva').val("");
            $('#contra_nueva_repetir').val("");
            $('#contra_actual').val("");
            $('#img_perfil').attr('src', datos[0][17]);
            $('#contra_bd').val(datos[0][2])
            $('#nombre_usuario').html(datos[0][8])
            $('#rol_u').html(datos[0][7])
            $('#txt_nombre_profile').val(datos[0][9])
            $('#txt_app_profile').val(datos[0][10])
            $('#txt_apm_profile').val(datos[0][11])
            $('#txt_doc_profile').val(datos[0][12])
            $('#cbm_tipo_profile').val(datos[0][13]).trigger('change')
            $('#telefono_profile').val(datos[0][15])
            $('#cbm_sexo_profile').val(datos[0][14]).trigger('change')


        }

    })
}
function actualizar_imagen_profile() {
    let usuario = $('#id_user').val();
    let imagen = $('#img_profile').val();
    if (imagen.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Seleccione una imgaen", "warning")
    }
    var f = new Date();
    var extension = imagen.split('.').pop();
    var nombre_archivo = "IMG" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMinutes() + "" + f.getSeconds() + "." + extension;
    var formData = new FormData();
    var foto = $("#img_profile")[0].files[0];


    formData.append('usuario', usuario)
    formData.append('foto', foto)
    formData.append('nombre_archivo', nombre_archivo)

    $.ajax({
        url: '../controller/usuario/controlador_editar_imagen.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp == 1) {
                traerDatosProfile();
                traerDatosUsuario() ;
                Swal.fire("Mensaje de Confirmacion", "Imagen de perfil actualizada", "success");
            }
        }
    });
    return false;
}

function actualizar_datos_personales() {
    let id = $('#id_user').val();
    var nombre = $("#txt_nombre_profile").val();
    var app = $("#txt_app_profile").val();
    var apm = $("#txt_apm_profile").val();
    var documento = $("#txt_doc_profile").val();
    var tipo_doc = $("#cbm_tipo_profile").val();
    var telefono = $("#telefono_profile").val();
    var sexo = $("#cbm_sex_profile").val();
    if (nombre.length == 0 || app.length == 0 || apm.length == 0 || documento.length == 0 || tipo_doc.length == 0 || telefono.length == 0 || sexo.length == 0) {
        return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
    }

    $.ajax({
        "url": '../controller/usuario/controlador_actualizar_datos_profile.php',
        type: "POST",
        data: {
            id,
            nombre,
            app,
            apm,
            documento,
            tipo_doc,
            telefono,
            sexo
        }
    }).done(function (response) {
        var contenedor_mensaje = document.querySelector('#error_mensaje_profile');
        if (isNaN(response)) {
            var data = JSON.parse(response);
            contenedor_mensaje.style.display = "block";
            var html = '';
            data.forEach(mensaje => {
                html += `
                <span style="display:block;"><strong>ERROR!</strong>${mensaje}</span>
                 `
            })
            contenedor_mensaje.innerHTML = html;
        } else {
            if (response > 0) {
                contenedor_mensaje.style.display = "none";
                if (response == 1) {
                    Swal.fire("Mensaje De Confirmacion", "Datos actualizados perfectamente", "success")
                        .then((value) => {
                            traerDatosProfile()
                        })
                } else {
                    Swal.fire("Mensaje De Advertencia", "La persona ya existe", "warning");
                    traerDatosProfile()
                }
            } else {
                Swal.fire("Mensaje De Error", "No se pudo actualizar loss datos del usuario", "error");
            }
        }

    })
}
function Editar_contra() {

    let idusuario = $('#id_user').val();
    let contrabd = $('#contra_bd').val();
    let contraescrita = $('#contra_actual').val();
    let contranu = $('#contra_nueva').val();
    let contrare = $('#contra_nueva_repetir').val();
    if (contraescrita == "" || contranu == "" || contrare == "") {
        return Swal.fire("Mensaje De Advertencia", "Todos los campos son obligatorios", "warning")
    }
    if (contranu !== contrare) {
        return Swal.fire("Mensaje De Advertencia", "Las contraseñas deben coincidir", "warning")
    }
    $.ajax({
        "url": '../controller/usuario/controlador_editar_contra.php',
        type: 'POST',
        data: {
            idusuario: idusuario,
            contrabd: contrabd,
            contraescrita: contraescrita,
            contranu: contranu
        }
    }).done(response => {
        response = parseInt(response);
        switch (response) {
            case 0:
                Swal.fire("Mensaje De Advertencia", "No se pudo actualizar la contraseña", "error");
                break;
            case 1:
                Swal.fire("Mensaje De Confirmacion", "Las contraseña se actualizo correctamente", "success")
                    .then((value) => {
                        traerDatosUsuario();
                        $('#contra_nueva').val("");
                        $('#contra_nueva_repetir').val("");
                        $('#contra_actual').val("");

                    })
                break;
            case 2:
                Swal.fire("Mensaje De Advertencia", "Las contraseña actual no coincide con el usuario", "warning");
                break;
        }
    })


}

function fechadefault_widget() {
    n = new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    if (d < 10) { d = '0' + d }
    if (m < 10) { m = '0' + m }
    document.getElementById("fecha_inicio_d").value = y + "-" + m + "-" + d;
    document.getElementById("fecha_fin_d").value = y + "-" + m + "-" + d;
}

function traer_datos_widget() {
    traer_datos_grafico_venta()
    traer_datos_grafico_ingreso()
    let inicio = $('#fecha_inicio_d').val()
    let fin = $('#fecha_fin_d').val()
    $.ajax({
        "url": '../controller/usuario/controlador_datos_widget.php',
        type: 'POST',
        data: {
            inicio,
            fin
        }
    }).done(response => {
        var data = JSON.parse(response)
        console.log(data);
        const [datos] = data
        let cadena = "";
        if (response.length > 0) {
            const { total_venta, total_ingreso, numero_ventas, numero_ingreso } = datos
            cadena += `
       <div class="col-lg-3 col-md-6">
      <div class="ibox bg-success color-white widget-stat">
          <div class="ibox-body">
              <h2 class="m-b-5 font-strong">$.${total_venta}</h2>
              <div class="m-b-5">VENTA TOTAL </div><i class="ti-shopping-cart widget-stat-icon"></i>
              <div><i class="fa fa-level-up m-r-5"></i><small>25% higher</small></div>
          </div>
      </div>
  </div>
  <div class="col-lg-3 col-md-6">
      <div class="ibox bg-info color-white widget-stat">
          <div class="ibox-body">
              <h2 class="m-b-5 font-strong">$.${total_ingreso}</h2>
              <div class="m-b-5">TOTAL INGRESO</div><i class="ti-bar-chart widget-stat-icon"></i>
              <div><i class="fa fa-level-up m-r-5"></i><small>17% higher</small></div>
          </div>
      </div>
  </div>
  <div class="col-lg-3 col-md-6">
      <div class="ibox bg-warning color-white widget-stat">
          <div class="ibox-body">
              <h2 class="m-b-5 font-strong">${numero_ingreso}</h2>
              <div class="m-b-5">NUMERO DE INGRESOS</div><i class="fa fa-money widget-stat-icon"></i>
              <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div>
          </div>
      </div>
  </div>
  <div class="col-lg-3 col-md-6">
      <div class="ibox bg-danger color-white widget-stat">
          <div class="ibox-body">
              <h2 class="m-b-5 font-strong">${numero_ventas}</h2>
              <div class="m-b-5">NUMERO TOTAL VENTAS</div><i class="ti-user widget-stat-icon"></i>
              <div><i class="fa fa-level-down m-r-5"></i><small>-12% Lower</small></div>
          </div>
      </div>
  </div>`;
            $('#mostrar_widget').html(cadena)

        } else {
            cadena += `
            <div class="col-lg-3 col-md-6">
           <div class="ibox bg-success color-white widget-stat">
               <div class="ibox-body">
                   <h2 class="m-b-5 font-strong">$.${total_venta}</h2>
                   <div class="m-b-5">VENTA TOTAL </div><i class="ti-shopping-cart widget-stat-icon"></i>
                   <div><i class="fa fa-level-up m-r-5"></i><small>25% higher</small></div>
               </div>
           </div>
       </div>
       <div class="col-lg-3 col-md-6">
           <div class="ibox bg-info color-white widget-stat">
               <div class="ibox-body">
                   <h2 class="m-b-5 font-strong">$.0</h2>
                   <div class="m-b-5">TOTAL INGRESO</div><i class="ti-bar-chart widget-stat-icon"></i>
                   <div><i class="fa fa-level-up m-r-5"></i><small>17% higher</small></div>
               </div>
           </div>
       </div>
       <div class="col-lg-3 col-md-6">
           <div class="ibox bg-warning color-white widget-stat">
               <div class="ibox-body">
                   <h2 class="m-b-5 font-strong">0</h2>
                   <div class="m-b-5">NUMERO DE INGRESOS</div><i class="fa fa-money widget-stat-icon"></i>
                   <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div>
               </div>
           </div>
       </div>
       <div class="col-lg-3 col-md-6">
           <div class="ibox bg-danger color-white widget-stat">
               <div class="ibox-body">
                   <h2 class="m-b-5 font-strong">0</h2>
                   <div class="m-b-5">NUMERO TOTAL VENTAS</div><i class="ti-user widget-stat-icon"></i>
                   <div><i class="fa fa-level-down m-r-5"></i><small>-12% Lower</small></div>
               </div>
           </div>
       </div>`;
            $('#mostrar_widget').html(cadena)
        }

    })
}

var chart_venta
function traer_datos_grafico_venta() {
    var arr_p = []
    var arr_c = []
    let inicio = $('#fecha_inicio_d').val()
    let fin = $('#fecha_fin_d').val()
    $.ajax({
        "url": '../controller/usuario/controlador_datos_grafico_venta.php',
        type: 'POST',
        data: {
            inicio,
            fin
        }
    }).done(response => {
        var data = JSON.parse(response)
        if (data.length > 0) {
            data.forEach(info => {
                arr_p.push(info.producto_nombre)
                arr_c.push(parseInt(info.cantidad))

            })
            console.log(arr_c)
            console.log(arr_c)
            var ctx = document.getElementById('myChart_venta').getContext('2d');
            if (chart_venta) {
                chart_venta.reset();
                chart_venta.destroy();
            }
            chart_venta = new Chart(ctx, {

                type: 'line',
                data: {
                    labels: arr_p,
                    datasets: [{
                        label: 'TOP 5 DE PRODUCTOS VENDIDOS ',
                        data: arr_c,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1,

                    }]
                },
                responsive: true,
                options: {
                    layout: {
                        padding: 10
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                stepSize: 1,
                                beginAtZero: true
                            }
                        }],

                    }
                },
            });
        } else {
            var ctx = document.getElementById('myChart_venta');
            if (chart_venta) {
                chart_venta.reset();
                chart_venta.destroy();
            }
            chart_venta = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['NO HAY PRODUCTOS'],
                    datasets: [{
                        label: 'TOP 5 DE  VENDIDOS',
                        data: [0, 0],
                        backgroundColor: '#8FAECE',
                        borderColor: '#8FAECE',
                        options: {
                            layout: {
                                padding: 20
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        callback: function (value) { if (value % 1 === 0) { return value; } }
                                    }
                                }]
                            }
                        },
                        borderWidth: 1
                    }]
                },

            });
        }

    })
}

var chart_ingreso
function traer_datos_grafico_ingreso() {
    var arr_pr = []
    var arr_ca = []
    let inicio = $('#fecha_inicio_d').val()
    let fin = $('#fecha_fin_d').val()
    $.ajax({
        "url": '../controller/usuario/controlador_datos_grafico_ingreso.php',
        type: 'POST',
        data: {
            inicio,
            fin
        }
    }).done(response => {
        var data = JSON.parse(response)
        console.log(data)
        if (data.length > 0) {
            data.forEach(info => {
                arr_pr.push(info.producto_nombre)
                arr_ca.push(parseInt(info.cantidad))
            })
            var ctx = document.getElementById('myChart_ingreso').getContext('2d');
            if (chart_ingreso) {
                chart_ingreso.reset();
                chart_ingreso.destroy();
            }
            chart_ingreso = new Chart(ctx, {

                type: 'line',
                data: {
                    labels: arr_pr,
                    datasets: [{
                        label: 'TOP 5 DE PRODUCTOS INGRESADOS ',
                        data: arr_ca,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1,
                    }]
                },
                options: {
                    layout: {
                        padding: 10
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,

                            }
                        }],

                    }
                },
            });
        } else {
            var ctx = document.getElementById('myChart_ingreso');
            if (chart_ingreso) {
                chart_ingreso.reset();
                chart_ingreso.destroy();
            }
            chart_ingreso = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['NO HAY PRODUCTOS'],
                    datasets: [{
                        label: 'TOP 5 DE PRODUCTOS INGRESADOS ',
                        data: [0],
                        backgroundColor: 'rgba(255, 99,132)',
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        options: {
                            layout: {
                                padding: 20
                            },
                            scales: {
                                yAxes: [{
                                    stepSize: 1,
                                    stacked: true,
                                    ticks: {
                                        min: 0,
                                    }

                                }]

                            }
                        },
                        borderWidth: 1
                    }]
                },

            });
        }

    })
}
