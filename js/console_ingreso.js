function fechadefault() {
    n = new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    if (d < 10) { d = '0' + d }
    if (m < 10) { m = '0' + m }
    document.getElementById("fecha_inicio").value = y + "-" + m + "-" + d;
    document.getElementById("fecha_fin").value = y + "-" + m + "-" + d;
}
var table_ingreso
var total = 0;
var igv = 0;
function listarIngreso() {
    var fechainicio = $('#fecha_inicio').val()
    var fechafin = $('#fecha_fin').val()

    table_ingreso = $("#tabla_ingreso").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": true },
        "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/ingreso/controlador_ingreso_listar.php",
            type: 'POST',
            data: {
                fechainicio: fechainicio,
                fechafin: fechafin
            }
        },
        "order": [[1, 'asc']],
        "columns": [
            { "defaultContent": "" },
            { "data": "usuario_nombre" },
            { "data": "persona_proveedor" },
            { "data": "ingreso_tipcomprobante" },
            { "data": "ingreso_seriecomprobante" },
            { "data": "ingreso_numcomprobante" },
            { "data": "ingreso_fecha" },
            { "data": "ingreso_total" },
            { "data": "ingreso_impuesto" },
            {
                "data": "ingreso_estatus",
                render: function (data, type, row) {
                    if (data == 'INGRESADO') {
                        return "<span class='badge badge-success badge-pill m-r-5 m-b-5'>" + data + "</span>";
                    }

                    if (data == 'ANULADO') {
                        return "<span class='badge badge-danger badge-pill m-r-5 m-b-5'>" + data + "</span>";
                    }
                }
            },
            {
                "defaultContent": `<button style='font-size:13px;margin-right:1px;' type='button' class='imprimir btn btn-primary'><i class='fa fa-print'></i> Imprimir</button>
                <button style='font-size:13px;margin-right:1px;' type='button' class='anular btn btn-primary'><i class='fa fa-print'></i> Anular</button>`  }
        ],

        language: {
            "decimal": "",
            "emptyTable": "No hay informaci??n",
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

        select: true
    });

    table_ingreso.on('draw.dt', function () {
        let PageInfo = $('#tabla_ingreso').DataTable().page.info();
        table_ingreso.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

}

/*  -----------------JS DE VISTA REGISTRAR INGRESO-----------     */
function listar_combo_producto_ingreso() {
    $.ajax({
        "url": '../controller/ingreso/controlador_listar_producto_ingreso.php',
        type: 'POST'
    }).done(function (response) {
        console.log(JSON.parse(response))
        var data = JSON.parse(response);
        let divOption = document.querySelector('#cbm_producto')

        if (data.length > 0) {
            let html = ''
            data.forEach(dato => {
                const { producto_id, producto_nombre } = dato
                html += `   
            <option value="${producto_id}">${producto_nombre}</option>
             `
            })
            divOption.insertAdjacentHTML('beforeend', html);

        } else {
            divOption.innerHTML = `<option value="">No se encontraron resultados</option>`
        }
    })
}
function listar_combo_proveedor_ingreso() {
    $.ajax({
        "url": '../controller/ingreso/controlador_listar_proveedor_ingreso.php',
        type: 'POST'
    }).done(function (response) {
        console.log(JSON.parse(response))
        var data = JSON.parse(response);
        let divOption = document.querySelector('#cbm_proveedor')

        if (data.length > 0) {
            let html = ''
            data.forEach(dato => {
                const { proveedor_id, proveedor_razonsocial } = dato
                html += `   
            <option value="${proveedor_id}">${proveedor_razonsocial}</option>
             `
            })
            divOption.insertAdjacentHTML('beforeend', html);

        } else {
            divOption.innerHTML = `<option value="">No se encontraron resultados</option>`
        }
    })
}

var row_producto = []
function agregar_producto() {
    let id = $('#cbm_producto').val()
    let producto = $('#cbm_producto option:selected').text()
    let id_producto = $('#cbm_producto').val()
    let cantidad = parseInt($('#cantidad').val())
    let impuesto = $('#impuesto').val()
    let subtotal = parseFloat($('#precio').val()) * cantidad
    let precio = $('#precio').val()
    if (id == "") { return Swal.fire("Mensaje De Advertencia", "No hay productos disponibles", "warning"); }
    if (cantidad < 0) { return Swal.fire("Mensaje De Advertencia", "La cantidad no puede ser menor a 0", "warning"); }
    impuestosuma = "";
    if (impuesto.length < 0) {
        impuestosuma = 0;
    } else {
        impuestosuma = parseFloat((impuesto / 100) * subtotal)
    }
    const obj = {
        id,
        precio,
        producto,
        id_producto,
        cantidad,
        subtotal,
        impuestosuma
    }
    document.getElementById("tabl_p").classList.remove('ocultar');
    document.getElementById("tb_blo").style.display = "block";
    document.querySelector('#detall').style.display = "block";
    document.getElementById("reg").classList.remove('ocultar');

    const existe = row_producto.some(valor => valor.id == obj.id)
    if (existe) {
        const temporal = row_producto.map(t => {
            if (t.id == obj.id) {
                t.cantidad = t.cantidad + obj.cantidad;
                t.subtotal = t.subtotal + obj.subtotal;
                t.impuestosuma = t.impuestosuma + obj.impuestosuma;

                return t;
            } else {
                return t;
            }
        })
        row_producto = [...temporal]
    } else {
        row_producto = [...row_producto, obj]
    }
    tb_p.innerHTML = ""
    row_producto.forEach(row => {
        var fila = `
        <tr id='${row.id}' > 
            <td class='id'>${row.id}</td>
            <td>${row.producto}</td>
            <td>${row.precio}</td>
           <td>${row.cantidad}</td>
           <td>${row.subtotal}</td>
           <td><button class='btn boton-borrar eliminar_producto' data-id=${row.id}><i class="fa-solid fa-circle-xmark"></i> Eliminar</button></td>
         </tr>`
        $('#tb_p').append(fila)
    })

    calcular_back(row_producto);


}

$(document).on('click', '.eliminar_producto', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
    var eliminar = event.target.getAttribute('data-id')
    row_producto = row_producto.filter(valor => {
        return valor.id != eliminar
    })

    console.log(row_producto)

    calcular_back(row_producto);
});

function calcular_back(producto) {
    $.ajax({
        url: '../controller/ingreso/controlador_calcular_total.php',
        type: 'POST',
        data: {
            producto
        }
    }).done(resp => {
        console.log(resp)
        var data = JSON.parse(resp);
        if (data.subtotal == 0) {
            $('#sub_mostrar').val(data.subtotal)
            $('#igv_mostrar').val(data.igv)
            $('#total_mostrar').val(data.total);
            igv = data.igv
            total = data.total
            document.getElementById("tabl_p").classList.add('ocultar');
            document.getElementById("tb_blo").style.display = "none";
            document.querySelector('#detall').style.display = "none";
            document.getElementById("reg").classList.add('ocultar');
        } else {
            $('#sub_mostrar').val(data.subtotal)
            $('#igv_mostrar').val(data.igv)
            $('#total_mostrar').val(data.total);
            total = data.total
            igv = data.igv
        }


    })


}


function registrar_ingreso() {
    console.log(total)
    let usuario_id = $('#id_user').val();
    let proveedor_id = $('#cbm_proveedor').val();
    let tipo_comprobante = $('#cbm_compro').val()
    let serie_comprobante = $('#serie').val()
    let num_comprobante = $('#num').val()
    let impuesto = $('#impuesto').val()
    console.log(igv)

    if (proveedor_id == "" || tipo_comprobante == "" || serie_comprobante == "" || num_comprobante == "") {
        return Swal.fire("Mensaje De Advertencia", "campos vacios", "warning")
    }
    if (total <= 0) {
        return Swal.fire("Mensaje De Error", "no se puede resgistrar el ingreso total igual a 0", "error")
    }

    if (impuesto.length == 0) {
        impuesto = 0;
    }
    $.ajax({
        'url': '../controller/ingreso/controlador_registrar_ingreso.php',
        type: 'POST',
        data: {
            usuario_id,
            proveedor_id,
            tipo_comprobante,
            serie_comprobante,
            num_comprobante,
            igv,
            total,
            impuesto

        }
    }).done(resp => {
        if (resp > 0) {
            registrar_detalle_ingreso(parseInt(resp))
        } else {
            return Swal.fire("Mensaje De Error", "no se puede resgistrar el ingreso :'v", "error")
        }
    })

}

function registrar_detalle_ingreso(id) {
    console.log(id)
    let array_precio = row_producto.map(dato => {
        return dato.precio
    })
    let array_cantidad = row_producto.map(dato => {
        return dato.cantidad
    })
    let array_producto = row_producto.map(dato => {
        return dato.id_producto
    })

    let arr_producto = JSON.stringify(array_producto)
    let arr_cantidad = JSON.stringify(array_cantidad)
    let arr_precio = JSON.stringify(array_precio)

    $.ajax({
        url: '../controller/ingreso/controlador_registrar_detalle_ingreso.php',
        type: 'POST',
        data: {
            id,
            arr_precio,
            arr_producto,
            arr_cantidad,
        }
    }).done(resp => {
        var id_ingreso = parseInt(id)
        if (resp > 0) {
            Swal.fire({
                title: 'Datos de confirmacion',
                text: "Datos registrados correctamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Imprimir Reporte'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#contenido_principal').load('../view/ingreso/vista_listar_ingreso.php')
                    window.open("../libs/reportes/reporte_ingresos.php?id=" + id_ingreso + "#zoom-100%", "reporte", "scrollbars=NO")

                } else {
                    $('#contenido_principal').load('../view/ingreso/vista_listar_ingreso.php')
                    Swal.fire('Mensaje de confirmacion', 'Datos registrados', 'success')

                }
            })
        } else {
            return Swal.fire("Mensaje De Error", "no se puede resgistrar el detalle  ingreso", "error")
        }
    })

}
$('#tabla_ingreso').on('click', '.imprimir', function () {
    let data = table_ingreso.row($(this).parents('tr')).data();
    if (table_ingreso.row(this).child.isShown()) {
        data = table_ingreso.row(this).data();
    }
    window.open("../libs/reportes/reporte_ingresos.php?id=" + data.ingreso_id + "#zoom-100%", "reporte", "scrollbars=NO")


})
$('#tabla_ingreso').on('click', '.anular', function () {
    let data = table_ingreso.row($(this).parents('tr')).data();
    if (table_ingreso.row(this).child.isShown()) {
        data = table_ingreso.row(this).data();
    }
    var id_ing = data.ingreso_id

    Swal.fire({
        title: 'Anular ingreso',
        text: "Esta seguro de anular el ingreso?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Anullar ingreso'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../controller/ingreso/controlador_anular_ingreso.php',
                type: 'POST',
                data: {
                    id_ing
                }
            }).done(resp => {
                if(resp==1){
                    table_ingreso.ajax.reload()
                    Swal.fire('Mensaje de confirmacion', 'Ingreso anulado', 'success')
                  
                }else{
                    return Swal.fire("Mensaje De Error", "no se pudo anular el ingreso", "error")
                }
               

            })
        }
    })


})