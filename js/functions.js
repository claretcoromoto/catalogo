
var editando = false;

function transformarEnEditable(nodo) {
//El nodo recibido es SPAN
    if (editando == false) {
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodoContenedorForm = document.getElementById('contenedorForm'); //Nodo DIV
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var ids = nodosEnTr[0].textContent;
        var nb = nodosEnTr[1].textContent;
        var ina = nodosEnTr[2].textContent;
        var opciones = nodosEnTr[3].textContent;
        var nuevoCodigoHtml = '<td><input type="text" name="ids" id="ids" value="' + ids + '" size="5"></td>' +
                '<td><input type="text" name="nb" id="nb" value="' + nb + '" size="10"</td>' +
                '<td><input type="text" name="ina" id="ina" value="' + ina + '" size="5"</td>' +
                ' <td>En edición</td>';

        nodoTr.innerHTML = nuevoCodigoHtml;
        
        nodoContenedorForm.innerHTML = 'Pulse Aceptar para guardar los cambios o cancelar para anularlos' +
             '<form name = "formulario" action= "./actualizar_en_base_datos.php"  onsubmit="capturarEnvio()" onreset="anular()">'+
               '<input class="boton" type = "button" value="Aceptar" onclick="mostrar()"> <input class="boton" type="reset" value="Cancelar">';
        editando = "true";
    }
    else {
        alert('Solo se puede editar una línea. Recargue la página para poder editar otra');
    }
}

function capturarEnvio(){
    
   var idss=document.querySelector('#ids').value;
   var inb=document.querySelector('#nb').value;
   var ic=document.querySelector('#na').value;
            var nodoContenedorForm = document.getElementById('contenedorForm'); //Nodo DIV
            nodoContenedorForm.innerHTML = 'Pulse Aceptar para guardar los cambios o cancelar para anularlos'+
            '<form name = "formulario" action= "./actualizar_en_base_datos.php"  onsubmit="capturarEnvio()" onreset="anular()">'+
            '<input type="hidden" name="ids" value="'+document.getElementById('#ids').value+'">'+
            '<input type="hidden" name="nb" value="'+document.getElementById('#nb').value+'">'+
            '<input type="hidden" name="ina" value="'+document.getElementById('#ina').value+'">'+
     '<input class="boton" type = "submit" value="Aceptar" onclick="mostrar()"> <input class="boton" type="reset" value="Cancelar">';
            document.formulario.submit();
}

function mostrar() {
//    var idss = document.querySelector('#ids').value;
//    var inb = document.querySelector('#nb').value;
    var iac = document.querySelector('#ina').value;
    alert('' + iac + '');
//    alert('' + inb + '');

    document.formulario.action = "./actualizar_en_base_datos.php?ina=" + iac + "";
    document.formulario.submit();
}

function anular() {
    window.location.reload();
}