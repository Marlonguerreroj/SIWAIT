

/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
 lo que se puede copiar tal como esta aqui */
function nuevoAjax()
{
    var xmlhttp = false;
    try {
        // Creacion del objeto AJAX para navegadores no IE Ejemplo:Mozilla, Safari 
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            // Creacion del objet AJAX para IE
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
                xmlhttp = new XMLHttpRequest();
        }
    }
    return xmlhttp;
}

function chequearEnter2(event, elemento, este, siguiente, total) {
    if (event.keyCode === 13) {
        var dato = este.value;
        ajax = nuevoAjax();
        parametros = "referencia=" + dato;
        url = "../Script/AjaxPhp.php";
        ajax.open("POST", url, true);
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajax.send(parametros);
        ajax.onreadystatechange = function ()
        {
            if (ajax.readyState == 4) {
                if (ajax.status == 200) {
                    var rta = ajax.responseText;
                    if (rta == "") {
                        elemento.value = "No encontro datos";
                    } else {
                        var rta2 = rta.split("/");
                        elemento.value = rta2[1];
                        siguiente.readOnly = false;
                        siguiente.value = 1;
                        total.value = rta2[1];


                    }
                } else {
                    elemento.value = "No encontro datos";

                }
            } else {
                elemento.value = "Procesando registro...";
            }
        }
    }
}

function registrarSerial(codigo0, referencia0, sucursal0, pedido0, descripcion0) {

    var codigo = codigo0.value;
    var referencia = referencia0.value;
    var sucursal = sucursal0.value;
    var pedido = pedido0.value;
    var descripcion = descripcion0.value;

    ajax = nuevoAjax();
    parametros = "codigo=" + codigo + "&referencia=" + referencia + "&sucursal=" + sucursal + "&pedido=" + pedido + "&descripcion=" + descripcion;
    url = "../Script/AjaxPhp2.php";
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send(parametros);
    ajax.onreadystatechange = function ()
    {
        if (ajax.readyState == 4)
        {
            if (ajax.status == 200)
            {
                var rta = ajax.responseText;
                if (rta == "") {
                    elemento.value = "No encontro datos";
                } else {
                    alert("Se ha añadido un serial");
                    codigo0.value = "";
                    referencia0.value = "";
                    sucursal0.value = "";
                    pedido0.value = "";
                    descripcion0.value = "";
                }
            }
            else
            {

            }
        }
        else
        {
            elemento.value = "Procesando registro...";
        }
    }

}

function registrarAdministradorCliente() {

    var documento = procesarregistraradmincliente.documento.value;
    var valor = procesarregistraradmincliente.valor.value;
    var campo = "divError";
    ajax = nuevoAjax();

    parametros = "documento=" + documento + "&valor=" + valor;
    url = "procesar/proc.jsp";
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send(parametros);
    ajax.onreadystatechange = function ()
    {
        if (ajax.readyState == 4)
        {
            if (ajax.status == 200)
            {
                var rta = ajax.responseText;
                document.getElementById(campo).innerHTML = rta;
            }
            else
            {
                var rta = ajax.responseText;
                document.getElementById(campo).innerHTML = rta;
            }
        }
        else
        {
            document.getElementById(campo).value = "Procesando registro";
        }
    }

}
