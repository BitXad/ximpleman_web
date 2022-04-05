$(document).on("ready",inicio);
function inicio(){
    buscar_por_fecha();
}
   
function reporte_diario(){

    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario = document.getElementById('buscarusuario_id').value;
    
    buscarporfecha(0, 0, 0);
}

function buscar_por_fecha(){

    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario = document.getElementById('buscarusuario_id').value;
    
    buscarporfecha(fecha_desde, fecha_hasta, usuario);
}

function numberFormat(numero){
        // Variable que contendra el resultado final
        var resultado = "";
 
        // Si el numero empieza por el valor "-" (numero negativo)
        if(numero[0]=="-")
        {
            // Cogemos el numero eliminando los posibles puntos que tenga, y sin
            // el signo negativo
            nuevoNumero=numero.replace(/\,/g,'').substring(1);
        }else{
            // Cogemos el numero eliminando los posibles puntos que tenga
            nuevoNumero=numero.replace(/\,/g,'');
        }
 
        // Si tiene decimales, se los quitamos al numero
        if(numero.indexOf(".")>=0)
            nuevoNumero=nuevoNumero.substring(0,nuevoNumero.indexOf("."));
 
        // Ponemos un punto cada 3 caracteres
        for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i--, j++)
            resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0)? ",": "") + resultado;
 
        // Si tiene decimales, se lo añadimos al numero una vez forateado con 
        // los separadores de miles
        if(numero.indexOf(".")>=0)
            resultado+=numero.substring(numero.indexOf("."));
 
        if(numero[0]=="-")
        {
            // Devolvemos el valor añadiendo al inicio el signo negativo
            return "-"+resultado;
        }else{
            return resultado;
        }
}

function formato_numerico(numero){
    
        
    
    var nStr = Number(numero).toFixed(2);
    nStr += '';
	var x = nStr.split('.');
	var x1 = x[0];
	var x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	
	return x1 + x2;
}

function mostrar_detalle(){
    
    var numfilas = document.getElementById('filas_detalle').value;
    var boton = document.getElementById('boton_detalle').value;
    
    
    if (boton == "[+]"){
        
        for(i=1; i<=Number(numfilas);i++)
            document.getElementById('ocultar_fila'+i).style.display = '';
   
        $("#boton_detalle").val("[-]");
    }
    else{
        for(i=1; i<=Number(numfilas);i++)
            document.getElementById('ocultar_fila'+i).style.display = 'none';
   
        $("#boton_detalle").val("[+]");
    }
    
}

function mostrar_filas(bancos_filas){
    
    var numfilas = $('#numerofilas').val();
    var boton = $('#boton_mostrar').val();
    
    bancos_filas.map(banco => {

        if (boton == "[+]"){
            for(i=1; i<=Number(numfilas);i++)
                $(`#detalle_oculto${i}_${banco}`).css('display','');
        
            $("#boton_mostrar").val("[-]");
        }
        else{
            for(i=1; i<=Number(numfilas);i++)
                $(`#detalle_oculto${i}_${banco}`).css('display','none');
        
            $("#boton_mostrar").val("[+]");
        }
    });
}

function buscarporfecha(fecha_desde, fecha_hasta, usuario){

    var base_url    = document.getElementById('base_url').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var nombre_moneda  = document.getElementById('nombre_moneda').value;
    var controlador = base_url+"reportes/buscarporfecha";
    
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({
        url: controlador,
        type:"POST",
        data:{fecha1:fecha_desde, fecha2:fecha_hasta, usuario_id:usuario},
        success:function(resul){
            // $("#resingegr").val("- 0 -");
            // alert(registros.length);
            var data =  JSON.parse(resul);
            let registros = data['registros'];
            let bancos = data['bancos'];
            
            // let caja = new Tipo_transaccion();
            // let ventas = new Tipo_transaccion();
            // let servicios = new Tipo_transaccion();
            // let creditos = new Tipo_transaccion();
            // let envases = new Tipo_transaccion();
            // bancos = bancos.map(banco => new Banco(banco.banco_id,banco.banco_nombre));
            bancos = bancos.map((banco) => {
                this.banco = {
                    "banco_id": banco.banco_id,
                    "banco_nombre": banco.banco_nombre,

                    "ingreso_caja": 0,
                    "ingreso_ventas": 0,
                    "ingreso_servicios": 0,
                    "ingreso_creditos": 0,
                    "ingreso_envases": 0,

                    "ingreso_caja_debito":0,
                    "ingreso_ventas_debito":0,
                    "ingreso_servicios_debito":0,
                    "ingreso_creditos_debito":0,
                    "ingreso_envases_debito":0,

                    "ingreso_caja_transacciones":0,
                    "ingreso_ventas_transacciones":0,
                    "ingreso_servicios_transacciones":0,
                    "ingreso_creditos_transacciones":0,
                    "ingreso_envases_transacciones":0,

                    "ingreso_caja_tarjetascredito":0,
                    "ingreso_ventas_tarjetascredito":0,
                    "ingreso_servicios_tarjetascredito":0,
                    "ingreso_creditos_tarjetascredito":0,
                    "ingreso_envases_tarjetascredito":0,

                    "ingreso_caja_cheque": 0,
                    "ingreso_ventas_cheque": 0,
                    "ingreso_servicios_cheque": 0,
                    "ingreso_creditos_cheque": 0,
                    "ingreso_envases_cheque": 0,

                    "ingreso_total_efectivo": 0,
                    "ingreso_total_debito": 0,
                    "ingreso_total_transaccion": 0,
                    "ingreso_total_credito": 0,
                    "ingreso_total_cheque": 0,
                    

                    "egreso_caja": 0,
                    "egreso_compras": 0,
                    "egreso_ordenes": 0,
                    "egreso_pagos": 0,                    
                    
                    "egreso_caja_debito": 0,
                    "egreso_compras_debito": 0,
                    "egreso_ordenes_debito": 0,
                    "egreso_pagos_debito": 0,                    

                    "egreso_caja_transacciones": 0,
                    "egreso_compras_transacciones": 0,
                    "egreso_ordenes_transacciones": 0,
                    "egreso_pagos_transacciones": 0,  
                    
                    "egreso_caja_tarjetascredito": 0,
                    "egreso_compras_tarjetascredito": 0,
                    "egreso_ordenes_tarjetascredito": 0,
                    "egreso_pagos_tarjetascredito": 0,  
                    
                    "egreso_caja_cheque": 0,
                    "egreso_compras_cheque": 0,
                    "egreso_ordenes_cheque": 0,
                    "egreso_pagos_cheque": 0,
                    
                    "egreso_total_efectivo": 0,
                    "egreso_total_debito": 0,
                    "egreso_total_transaccion": 0,
                    "egreso_total_credito": 0,
                    "egreso_total_cheque": 0
                };
                return this.banco;
            });

            efectivo = {
                "banco_id": 0,//efectivo no tiene id de banco
                "banco_nombre": "EFECTIVO",// nombre 

                "ingreso_caja": 0,
                "ingreso_ventas": 0,
                "ingreso_servicios": 0,
                "ingreso_creditos": 0,
                "ingreso_envases": 0,

                "ingreso_caja_debito":0,
                "ingreso_ventas_debito":0,
                "ingreso_servicios_debito":0,
                "ingreso_creditos_debito":0,
                "ingreso_envases_debito":0,

                "ingreso_caja_transacciones":0,
                "ingreso_ventas_transacciones":0,
                "ingreso_servicios_transacciones":0,
                "ingreso_creditos_transacciones":0,
                "ingreso_envases_transacciones":0,

                "ingreso_caja_tarjetascredito":0,
                "ingreso_ventas_tarjetascredito":0,
                "ingreso_servicios_tarjetascredito":0,
                "ingreso_creditos_tarjetascredito":0,
                "ingreso_envases_tarjetascredito":0,

                "ingreso_caja_cheque": 0,
                "ingreso_ventas_cheque": 0,
                "ingreso_servicios_cheque": 0,
                "ingreso_creditos_cheque": 0,
                "ingreso_envases_cheque": 0,
                
                "ingreso_total_efectivo": 0,
                "ingreso_total_debito": 0,
                "ingreso_total_transaccion": 0,
                "ingreso_total_credito": 0,
                "ingreso_total_cheque": 0,


                "egreso_caja": 0,
                "egreso_compras": 0,
                "egreso_ordenes": 0,
                "egreso_pagos": 0,                    
                
                "egreso_caja_debito": 0,
                "egreso_compras_debito": 0,
                "egreso_ordenes_debito": 0,
                "egreso_pagos_debito": 0,                    

                "egreso_caja_transacciones": 0,
                "egreso_compras_transacciones": 0,
                "egreso_ordenes_transacciones": 0,
                "egreso_pagos_transacciones": 0,  
                
                "egreso_caja_tarjetascredito": 0,
                "egreso_compras_tarjetascredito": 0,
                "egreso_ordenes_tarjetascredito": 0,
                "egreso_pagos_tarjetascredito": 0,  
                
                "egreso_caja_cheque": 0,
                "egreso_compras_cheque": 0,
                "egreso_ordenes_cheque": 0,
                "egreso_pagos_cheque": 0,

                "egreso_total_efectivo": 0,
                "egreso_total_debito": 0,
                "egreso_total_transaccion": 0,
                "egreso_total_credito": 0,
                "egreso_total_cheque": 0
            }
            bancos.unshift(efectivo);// coloca efectivo al inicio del array de bancos            

            if (registros != null){
                    // var fecha1 = fecha_desde;
                    // var fecha2 = fecha_hasta;
                    var esusuario =  $('#buscarusuario_id option:selected').text();
                    var fecha1 = "<span class='text-bold'>Desde: </span>"+moment(fecha_desde).format("DD/MM/YYYY");
                    var fecha2 = "<br><span class='text-bold'>Hasta: </span>"+moment(fecha_hasta).format("DD/MM/YYYY");
                    
                    var totalingresos = 0;
                    var totalegresos = 0;
                    var totalutilidad = 0;
                    var totalefectivo = 0;
                    var subtotal = 0;
                    
                    var ingreso_caja = 0;
                    var ingreso_ventas = 0;
                    var ingreso_servicios = 0;
                    var ingreso_creditos = 0;
                    var ingreso_envases = 0;

                    var ingreso_caja_debito = 0;
                    var ingreso_ventas_debito = 0;
                    var ingreso_servicios_debito = 0;
                    var ingreso_creditos_debito = 0;
                    var ingreso_envases_debito = 0;

                    var ingreso_caja_transacciones = 0;
                    var ingreso_ventas_transacciones = 0;
                    var ingreso_servicios_transacciones = 0;
                    var ingreso_creditos_transacciones = 0;
                    var ingreso_envases_transacciones = 0;
                    
                    var ingreso_caja_tarjetascredito = 0;
                    var ingreso_ventas_tarjetascredito = 0;
                    var ingreso_servicios_tarjetascredito = 0;
                    var ingreso_creditos_tarjetascredito = 0;
                    var ingreso_envases_tarjetascredito = 0;
                    
                    var ingreso_caja_cheque = 0;
                    var ingreso_ventas_cheque = 0;
                    var ingreso_servicios_cheque = 0;
                    var ingreso_creditos_cheque = 0;
                    var ingreso_envases_cheque = 0;
                    
                    var egreso_caja = 0;
                    var egreso_ordenes = 0;
                    var egreso_compras = 0;
                    var egreso_pagos = 0;
                    
                    var totalegreso_efectivo = 0;
                    
                // var n = registros.length; //tamaño del arreglo de la consulta
//              $("#resingegr").val("- "+n+" -");
                
                    var html  = "";
                    // htmle = "";      
                    var estilo = "style='padding:0; '";
                    
                    var total_efectivo = 0;
                    var total_debito = 0;
                    var total_transaccion = 0;
                    var total_credito = 0;
                    var total_cheque = 0;
                    
                    var filas = 0;
                    
                    var i = 0;
                    for(let registro of registros){
                        
                        totalingresos += Number(registro["ingresos"]);
                        totalegresos += Number(registro["egresos"]);
                        totalutilidad += Number(registro["utilidad"]);
                        
                        if(registro["tipotrans_id"]<=2 && registro["forma_id"]==1) totalefectivo += Number(registro["ingresos"]);                       
                        filas++;
                        html += "<tr style='padding:0; ' id='ocultar_fila"+filas+"' >";
                        
                            html += "<td "+estilo+">"+(i+1)+"</td>";
                            html += "<td "+estilo+">"+moment(registro["fecha"]).format("DD/MM/YYYY");+"</td>";
                            html += "<td style='text-align: right; padding:0;'>"+registro["recibo"];
                            
                            var enlace = `${base_url}`;
                            
                            if(registro["recibo"]>0){
                                if (registro["orden"]==1) enlace += `ingreso/imprimir/${registro["recibo"]}`;
                                if (registro["orden"]==2) enlace += `factura/imprimir_recibo/${registro["recibo"]}`; 
                                if (registro["orden"]==3) enlace += `servicio/imprimircomprobante/${registro["recibo"]}`;
                                if (registro["orden"]==4) enlace += `servicio/boletainftecservicio/${registro["recibo"]}`;
                                if (registro["orden"]==5) enlace += `cuotum/recibocuentas/${registro["recibo"]}`;
                                if (registro["orden"]==6) enlace += `venta/prestamos/`;

                                // DEL 7 AL 10 RESERVADO PARA FUTUROS INGRESOS
                                if (registro["orden"]==11) enlace += `egreso/imprimir/${registro["recibo"]}`;
                                if (registro["orden"]==12) enlace += `compra/nota/${registro["recibo"]}`;
                                if (registro["orden"]==13) enlace += `orden_pago/imprimir/${registro["recibo"]}`;
                                if (registro["orden"]==14) enlace += `cuotum/recibodeudas/${registro["recibo"]}`;
                            }
                            let banco_id;
                            //INGRESOS
                            switch (registro["forma_id"]) {
                                case '1'://EFECTIVO
                                    // total_efectivo += Number(registro["ingresos"]);
                                    banco_id = registro["banco_id"];
                                    bancos.map(banco=>{
                                        if(banco.banco_id == banco_id){
                                            if(registro["orden"] <= 6){
                                                banco.ingreso_total_efectivo = parseFloat(banco.ingreso_total_efectivo) + parseFloat(registro["ingresos"]);

                                                if(registro["orden"] == 1) banco.ingreso_caja = parseFloat(banco.ingreso_caja) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 2) banco.ingreso_ventas =  parseFloat(banco.ingreso_ventas) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 3) banco.ingreso_servicios =  parseFloat(banco.ingreso_servicios) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 4) banco.ingreso_servicios =  parseFloat(banco.ingreso_servicios) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 5) banco.ingreso_creditos =  parseFloat(banco.ingreso_creditos) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 6) banco.ingreso_envases =  parseFloat(banco.ingreso_envases) + parseFloat(registro["ingresos"]);

                                            }else if(registro["orden"] > 6){
                                                banco.egreso_total_efectivo = parseFloat(banco.egreso_total_efectivo) + parseFloat(registro["egresos"]);

                                                if(registro["orden"] == 11) banco.egreso_caja = parseFloat(banco.egreso_caja) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 12) banco.egreso_compras = parseFloat(banco.egreso_compras) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 13) banco.egreso_ordenes = parseFloat(banco.egreso_ordenes) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 14) banco.egreso_pagos = parseFloat(banco.egreso_pagos) + parseFloat(registro["egresos"]);
                                            }
                                        }
                                    });
                                    // var banco_id = registros[i]["banco_id"];
                                    // bancos.map(banco=>{
                                        // if(banco.banco_id == banco_id){
                                            // banco.ingreso_caja = parseFloat(banco.ingreso_caja) + parseFloat(Number(registros[i]["egresos"])); 

                                        // }
                                    // })
                                    

                                    // bancos.map(banco=>{
                                    //     if(banco.banco_id == banco_id){
                                    //         banco.ingreso_caja = parseFloat(banco.ingreso_caja) + parseFloat(Number(registros[i]["egresos"])); 
                                    //     }
                                    // })

                                    // if(registros[i]["orden"] == 1) ingreso_caja += Number(registros[i]["ingresos"]);
                                    // if(registros[i]["orden"] == 2) ingreso_ventas += Number(registros[i]["ingresos"]);
                                    // if(registros[i]["orden"] == 3) ingreso_servicios += Number(registros[i]["ingresos"]);
                                    // if(registros[i]["orden"] == 4) ingreso_servicios += Number(registros[i]["ingresos"]);
                                    // if(registros[i]["orden"] == 5) ingreso_creditos += Number(registros[i]["ingresos"]);
                                    // if(registros[i]["orden"] == 6) ingreso_envases += Number(registros[i]["ingresos"]);
                                    
                                    // if(registros[i]["orden"] == 11) egreso_caja += Number(registros[i]["egresos"]);
                                    // if(registros[i]["orden"] == 12) egreso_compras += Number(registros[i]["egresos"]);
                                    // if(registros[i]["orden"] == 13) egreso_ordenes += Number(registros[i]["egresos"]);
                                    // if(registros[i]["orden"] == 14) egreso_pagos += Number(registros[i]["egresos"]);

                                    break;

                                case '2'://TARJETA DE DEBITO
                                    total_debito += Number(registro["ingresos"]);
                                    banco_id = registro["banco_id"];
                                    bancos.map(banco=>{
                                        if(banco.banco_id == banco_id){
                                            if(registro["orden"] <= 6){
                                                banco.ingreso_total_debito = parseFloat(banco.ingreso_total_debito) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 1) banco.ingreso_caja_debito = parseFloat(banco.ingreso_caja_debito) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 2) banco.ingreso_ventas_debito = parseFloat(banco.ingreso_ventas_debito) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 3) banco.ingreso_servicios_debito = parseFloat(banco.ingreso_servicios_debito) + parseFloat(registro["ingresos"]); //Pagos a cuenta por servicios
                                                if(registro["orden"] == 4) banco.ingreso_servicios_debito = parseFloat(banco.ingreso_servicios_debito) + parseFloat(registro["ingresos"]); //pagos saldo por servicios
                                                if(registro["orden"] == 5) banco.ingreso_creditos_debito = parseFloat(banco.ingreso_creditos_debito) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 6) banco.ingreso_envases_debito = parseFloat(banco.ingreso_envases_debito) + parseFloat(registro["ingresos"]);
                                            }else if(registro["orden"] > 6){
                                                banco.egreso_total_debito = parseFloat(banco.egreso_total_debito) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 11) banco.egreso_caja_debito = parseFloat(banco.egreso_caja_debito) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 12) banco.egreso_compras_debito = parseFloat(banco.egreso_compras_debito) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 13) banco.egreso_ordenes_debito = parseFloat(banco.egreso_ordenes_debito) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 14) banco.egreso_pagos_debito = parseFloat(banco.egreso_pagos_debito) + parseFloat(registro["egresos"]);
                                            }
                                            // console.log(banco.egreso_caja_debito)
                                        }
                                    })

                                    break;

                                case '3'://TRANSACCION BANCARIA
                                    total_transaccion += Number(registro["ingresos"]);
                                    banco_id = registro["banco_id"];
                                    bancos.map(banco=>{
                                        if(banco.banco_id == banco_id){
                                            // banco.ingreso_caja = parseFloat(banco.ingreso_caja) + parseFloat(Number(registro["egresos"])); 
                                            if(registro["orden"] <= 6){
                                                banco.ingreso_total_transaccion = parseFloat(banco.ingreso_total_transaccion) + parseFloat(registro["ingresos"])
                                                if(registro["orden"] == 1) banco.ingreso_caja_transacciones = parseFloat(banco.ingreso_caja_transacciones) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 2) banco.ingreso_ventas_transacciones = parseFloat(banco.ingreso_ventas_transacciones) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 3) banco.ingreso_servicios_transacciones = parseFloat(banco.ingreso_servicios_transacciones) + parseFloat(registro["ingresos"]); //Pagos a cuenta por servicios
                                                if(registro["orden"] == 4) banco.ingreso_servicios_transacciones = parseFloat(banco.ingreso_servicios_transacciones) + parseFloat(registro["ingresos"]); //pagos saldo por servicios
                                                if(registro["orden"] == 5) banco.ingreso_creditos_transacciones = parseFloat(banco.ingreso_creditos_transacciones) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 6) banco.ingreso_envases_transacciones = parseFloat(banco.ingreso_envases_transacciones) + parseFloat(registro["ingresos"]);
                                            }else if(registro["orden"] > 6){
                                                banco.egreso_total_transaccion = parseFloat(banco.egreso_total_transaccion) + parseFloat(registro["egresos"])
                                                if(registro["orden"] == 11) banco.egreso_caja_transacciones = parseFloat(banco.egreso_caja_transacciones) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 12) banco.egreso_compras_transacciones = parseFloat(banco.egreso_compras_transacciones) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 13) banco.egreso_ordenes_transacciones = parseFloat(banco.egreso_ordenes_transacciones) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 14) banco.egreso_pagos_transacciones = parseFloat(banco.egreso_pagos_transacciones) + parseFloat(registro["egresos"]);
                                            }
                                        }
                                    })

                                    // if(registros[i]["orden"] == 1) ingreso_caja_transacciones += Number(registros[i]["ingresos"]);
                                    // if(registros[i]["orden"] == 2) ingreso_ventas_transacciones += Number(registros[i]["ingresos"]);
                                    // if(registros[i]["orden"] == 3) ingreso_servicios_transacciones += Number(registros[i]["ingresos"]); //Pagos a cuenta por servicios
                                    // if(registros[i]["orden"] == 4) ingreso_servicios_transacciones += Number(registros[i]["ingresos"]); //pagos saldo por servicios
                                    // if(registros[i]["orden"] == 5) ingreso_creditos_transacciones += Number(registros[i]["ingresos"]);                              
                                    // if(registros[i]["orden"] == 6) ingreso_envases_transacciones += Number(registros[i]["ingresos"]); 

                                    break;

                                case '4'://TARJETAS DE CREDITO
                                    total_credito += Number(registro["ingresos"]);
                                    banco_id = registro["banco_id"];
                                    bancos.map(banco=>{
                                        if(banco.banco_id == banco_id){
                                            // banco.ingreso_caja = parseFloat(banco.ingreso_caja) + parseFloat(Number(registro["egresos"])); 
                                            if(registro["orden"] <= 6){
                                                banco.ingreso_total_credito = parseFloat(banco.ingreso_total_credito) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 1) banco.ingreso_caja_tarjetascredito = parseFloat(banco.ingreso_caja_tarjetascredito) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 2) banco.ingreso_ventas_tarjetascredito = parseFloat(banco.ingreso_ventas_tarjetascredito) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 3) banco.ingreso_servicios_tarjetascredito = parseFloat(banco.ingreso_servicios_tarjetascredito) + parseFloat(registro["ingresos"]); //Pagos a cuenta por servicios
                                                if(registro["orden"] == 4) banco.ingreso_servicios_tarjetascredito = parseFloat(banco.ingreso_servicios_tarjetascredito) + parseFloat(registro["ingresos"]); //pagos saldo por servicios
                                                if(registro["orden"] == 5) banco.ingreso_creditos_tarjetascredito = parseFloat(banco.ingreso_creditos_tarjetascredito) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 6) banco.ingreso_envases_tarjetascredito = parseFloat(banco.ingreso_envases_tarjetascredito) + parseFloat(registro["ingresos"]);
                                            }else if(registro["orden"] > 6){
                                                banco.egreso_total_credito = parseFloat(banco.egreso_total_credito) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 11) banco.egreso_caja_tarjetascredito = parseFloat(banco.egreso_caja_tarjetascredito) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 12) banco.egreso_compras_tarjetascredito = parseFloat(banco.egreso_compras_tarjetascredito) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 13) banco.egreso_ordenes_tarjetascredito = parseFloat(banco.egreso_ordenes_tarjetascredito) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 14) banco.egreso_pagos_tarjetascredito = parseFloat(banco.egreso_pagos_tarjetascredito) + parseFloat(registro["egresos"]);
                                            }
                                        }
                                    })
                                    // if(registros[i]["orden"] == 1) ingreso_caja_tarjetascredito += Number(registros[i]["ingresos"]);
                                    // if(registros[i]["orden"] == 2) ingreso_ventas_tarjetascredito += Number(registros[i]["ingresos"]);
                                    // if(registros[i]["orden"] == 3) ingreso_servicios_tarjetascredito += Number(registros[i]["ingresos"]); //Pagos a cuenta por servicios
                                    // if(registros[i]["orden"] == 4) ingreso_servicios_tarjetascredito += Number(registros[i]["ingresos"]); //pagos saldo por servicios
                                    // if(registros[i]["orden"] == 5) ingreso_creditos_tarjetascredito += Number(registros[i]["ingresos"]);                                    
                                    // if(registros[i]["orden"] == 6) ingreso_envases_tarjetascredito += Number(registros[i]["ingresos"]); 

                                    break;

                                case '5'://CHEQUES
                                    total_cheque += Number(registro["ingresos"]);
                                    
                                    banco_id = registro["banco_id"];
                                    bancos.map(banco=>{
                                        if(banco.banco_id == banco_id){
                                            // banco.ingreso_caja = parseFloat(banco.ingreso_caja) + parseFloat(Number(registro["egresos"])); 
                                            if(registro["orden"] <= 6){
                                                banco.ingreso_total_cheque = parseFloat(banco.ingreso_total_cheque) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 1) banco.ingreso_caja_cheque = parseFloat(banco.ingreso_caja_cheque) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 2) banco.ingreso_ventas_cheque = parseFloat(banco.ingreso_ventas_cheque) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 3) banco.ingreso_servicios_cheque = parseFloat(banco.ingreso_servicios_cheque) + parseFloat(registro["ingresos"]); //Pagos a cuenta por servicios
                                                if(registro["orden"] == 4) banco.ingreso_servicios_cheque = parseFloat(banco.ingreso_servicios_cheque) + parseFloat(registro["ingresos"]); //pagos saldo por servicios
                                                if(registro["orden"] == 5) banco.ingreso_creditos_cheque = parseFloat(banco.ingreso_creditos_cheque) + parseFloat(registro["ingresos"]);
                                                if(registro["orden"] == 6) banco.ingreso_envases_cheque = parseFloat(banco.ingreso_envases_cheque) + parseFloat(registro["ingresos"]);
                                            }else if(registro["orden"] > 6){
                                                banco.egreso_total_cheque = parseFloat(banco.egreso_total_cheque) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 11) banco.egreso_caja_cheque = parseFloat(banco.egreso_caja_cheque) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 12) banco.egreso_compras_cheque = parseFloat(banco.egreso_compras_cheque) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 13) banco.egreso_ordenes_cheque = parseFloat(banco.egreso_ordenes_cheque) + parseFloat(registro["egresos"]);
                                                if(registro["orden"] == 14) banco.egreso_pagos_cheque = parseFloat(banco.egreso_pagos_cheque) + parseFloat(registro["egresos"]);
                                            }
                                        }
                                    })
                                    // if(registros[i]["orden"] == 1) ingreso_caja_cheque += Number(registros[i]["ingresos"]);
                                    // if(registros[i]["orden"] == 2) ingreso_ventas_cheque += Number(registros[i]["ingresos"]);
                                    // if(registros[i]["orden"] == 3) ingreso_servicios_cheque += Number(registros[i]["ingresos"]); //Pagos a cuenta por servicios
                                    // if(registros[i]["orden"] == 4) ingreso_servicios_cheque += Number(registros[i]["ingresos"]); //pagos saldo por servicios
                                    // if(registros[i]["orden"] == 5) ingreso_creditos_cheque += Number(registros[i]["ingresos"]);                                 
                                    // if(registros[i]["orden"] == 6) ingreso_envases_cheque += Number(registros[i]["ingresos"]);    

                                    break;  
                            
                                default:
                                    // console.log(registros[i]["forma_id"])
                                    break;
                            }
                            
                            //EGRESOS
                            
                            
                        html += " <a href="+enlace+" target='_BLANK' class='no-print'><fa class='fa fa-print'></fa></a>";

                        html += "</td>";
                        html += "<td style='text-align: center; padding:0;'>"+registro["factura"]+"</td>";
                        html += "<td "+estilo+">"+registro["detalle"]+"</td>";
                        html += `<td style='text-align: center; padding:0;'>${registro["banco"]}</td>`;
                        html += "<td style='text-align: right; padding:0;'>";
                            if (Number(registro["ingresos"])>0) html += formato_numerico(registro["ingresos"]);
                        html += "</td>";
                        
                        html += "<td style='text-align: right; padding:0;'>";
                            if (Number(registro["egresos"]>0)) html += formato_numerico(registro["egresos"]);
                        html += "</td>";
                        
                        if(tipousuario_id == 1){
                            html += "<td style='text-align: right; padding:0;'>";
                                if (Number(registro["utilidad"])>0) html += formato_numerico(registro["utilidad"]);
                            html += "</td>";
                        }
                            
                        html += "</tr>";
                    
                    }
                    
                    html += "<input type='hidden' value='"+filas+"' id='filas_detalle'/>";
//                    html += "<tr style='background-color: #aaaaaa !important; -webkit-print-color-adjust: exact; color-adjust: exact;'>";
//                        html += "<td colspan='4'><b>TOTALES </b></td>";
//                        html += "<td> </td>";
//                        html += "<td style='text-align: right'><b>"+formato_numerico(totalingresos)+"</b></td>";
//                        html += "<td style='text-align: right'><b>"+formato_numerico(totalegresos)+"</b></td>";
//                        html += "<td style='text-align: right'><b>"+formato_numerico(totalutilidad)+"</b></td>";                    
//                    html += "</tr>";

                    var estilo = "style='border-top-style: solid;  border-color: black;  border-top-width: 1px; font-size:14; padding:0; '";
                    var estilo2 = "style='padding:0; text-align:right;'";
                    var estilox = "style='padding:0;'";
                    var bancos_filas = bancos.map(banco => banco.banco_id); // regresa un array con solo los id de los bancos
                    html += "<tr>";
                        html += "<td "+estilo+" colspan='5'><b>TOTAL INGRESOS "+nombre_moneda+" <input type='button' value='[+]' onclick='mostrar_filas(["+bancos_filas+"])' id='boton_mostrar' class='btn btn-xs'/> </b></td>";
                        html += "<td "+estilo+" ></td>";
                        html += "<td "+estilo+" ><b>"+formato_numerico(totalingresos)+"</b></td>";
                        html += "<td "+estilo+" ></td>";
                        html += "<td "+estilo+" ></td>";
                    html += "</tr>";
                    var numerofilas = 0;

                    for(let j = 0; j < bancos.length; j++){
                        let no_ingresos = () => {
                            let aux;
                            aux = bancos[j].ingreso_total_efectivo + bancos[j].ingreso_total_debito + bancos[j].ingreso_total_transaccion + bancos[j].ingreso_total_credito + bancos[j].ingreso_total_cheque; 
                            return (aux == 0);
                        };

                        if(no_ingresos()) break;
                        let sumatoria_ingresos =    parseFloat(bancos[j].ingreso_total_efectivo) +
                                                    parseFloat(bancos[j].ingreso_total_debito) +
                                                    parseFloat(bancos[j].ingreso_total_transaccion) +
                                                    parseFloat(bancos[j].ingreso_total_credito) +
                                                    parseFloat(bancos[j].ingreso_total_cheque);
                        html += "<tr>";
                            html += `<td ${estilo} colspan='6'><b>${bancos[j].banco_nombre}</b></td>`;
                            html += `<td ${estilo} colspan='3'><b>${sumatoria_ingresos.toFixed(2)}</b></td>`;
                        html += "</tr>";

                        
                        total_efectivo = bancos[j].ingreso_total_efectivo;
                        console.log(total_efectivo)
                        if(total_efectivo>0){
                            html += "<tr>";
                                html += "<td></td>";
                                html += "<td "+estilox+" colspan='4'><b>OPERACIONES EN EFECTIVO "+nombre_moneda+"</b></td>";
                                html += "<td "+estilo2+" ></td>";
                                html += "<td "+estilo2+" ><b>"+formato_numerico(total_efectivo)+"</b></td>";
                                html += "<td "+estilo2+" ></td>";
                                html += "<td "+estilo2+" ></td>";
                            html += "</tr>";
                        
                            
                            ingreso_caja = bancos[j].ingreso_caja + bancos[j].ingreso_caja_debito + bancos[j].ingreso_caja_transacciones + bancos[j].ingreso_caja_tarjetascredito + bancos[j].ingreso_caja_cheque;
                            console.log(ingreso_caja)
                            if (ingreso_caja>0){
                                // console.log(ingreso_caja);
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>INGRESOS A CAJA "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(ingreso_caja)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            
                            }
                            ingreso_ventas = bancos[j].ingreso_ventas + bancos[j].ingreso_ventas_debito + bancos[j].ingreso_ventas_transacciones + bancos[j].ingreso_ventas_tarjetascredito + bancos[j].ingreso_ventas_cheque;
                            console.log(ingreso_ventas)
                            if (ingreso_ventas>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>INGRESOS POR VENTAS "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(ingreso_ventas)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
    
                            ingreso_servicios = bancos[j].ingreso_servicios + bancos[j].ingreso_servicios_debito + bancos[j].ingreso_servicios_transacciones + bancos[j].ingreso_servicios_tarjetascredito + bancos[j].ingreso_servicios_cheque;
                            console.log(ingreso_servicios   )
                            if (ingreso_servicios>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>INGRESOS POR SERVICIOS "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(ingreso_servicios)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
    
                            ingreso_creditos = bancos[j].ingreso_creditos + bancos[j].ingreso_creditos_debito + bancos[j].ingreso_creditos_transacciones + bancos[j].ingreso_creditos_tarjetascredito + ingreso_creditos_cheque;
                            console.log(ingreso_creditos)
                            if (ingreso_creditos>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>INGRESOS POR DEUDAS X COBRAR "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(ingreso_creditos)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
    
                            ingreso_envases = bancos[j].ingreso_envases + bancos[j].ingreso_envases_debito + bancos[j].ingreso_envases_transacciones + bancos[j].ingreso_envases_tarjetascredito + bancos[j].ingreso_envases_cheque;
                            console.log(ingreso_envases)
                            if (ingreso_envases>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>INGRESOS POR PRESTAMO DE ENVASES "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(ingreso_envases)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                        }     
                        
                        
                        total_debito = bancos[j].ingreso_total_debito;
                        // console.log(total_debito)
                        // console.log(total_debito)
                        if(total_debito > 0){
                        html += "<tr>";
                            html += "<td></td>";
                            html += "<td "+estilox+" colspan='4'><b>TARJETAS DE DEBITO "+nombre_moneda+"</b></td>";
                            html += "<td "+estilo2+" ></td>";
                            html += "<td "+estilo2+" ><b>"+formato_numerico(total_debito)+"</b></td>";
                            html += "<td "+estilo2+" ></td>";
                            html += "<td "+estilo2+" ></td>";
                        html += "</tr>";
                        
                                ingreso_caja_debito = bancos[j].ingreso_caja_debito ;
                                if (ingreso_caja_debito > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS A CAJA "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_caja_debito)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }
                                ingreso_ventas_debito = bancos[j].ingreso_ventas_debito;
                                if (ingreso_ventas_debito > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR VENTAS "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_ventas_debito)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }   
                                ingreso_servicios_debito = bancos[j].ingreso_servicios_debito;
                                if (ingreso_servicios_debito > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR SERVICIOS "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_servicios_debito_debito)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }
                                ingreso_creditos_debito = bancos[j].ingreso_creditos_debito;
                                if (ingreso_creditos_debito > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR DEUDAS X COBRAR "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_creditos_debito)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }                    
                                ingreso_envases_debito = bancos[j].ingreso_envases_debito
                                if (ingreso_envases_debito > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR PRESTAMOS DE ENVASES "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_envases_debito)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }                    
                        
                        
                        }

                        total_transaccion = bancos[j].ingreso_total_transaccion
                        console.log(total_transaccion)
                        if(total_transaccion >0){
                        html += "<tr>";
                            html += "<td></td>";
                            html += "<td "+estilox+" colspan='4'><b>TRANSACCIONES BANCARIAS "+nombre_moneda+"</b></td>";
                            html += "<td "+estilo2+" ></td>";
                            html += "<td "+estilo2+" ><b>"+formato_numerico(total_transaccion)+"</b></td>";
                            html += "<td "+estilo2+" ></td>";
                            html += "<td "+estilo2+" ></td>";
                        html += "</tr>";
                            ingreso_caja_transacciones = bancos[j].ingreso_caja_transacciones
                                if (ingreso_caja_transacciones > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS A CAJA "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_caja_transacciones)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }
                                ingreso_ventas_transacciones = bancos[j].ingreso_ventas_transacciones;
                                if (ingreso_ventas_transacciones > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR VENTAS "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_ventas_transacciones)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }
                                ingreso_servicios_transacciones = bancos[j].ingreso_servicios_transacciones;
                                if (ingreso_servicios_transacciones > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR SERVICIOS "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_servicios_transacciones)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }
                                ingreso_creditos_transacciones = bancos[j].ingreso_creditos_transacciones;
                                if (ingreso_creditos_transacciones > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR DEUDAS X COBRAR "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_creditos_transacciones)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }               
                                ingreso_envases_transacciones = bancos[j].ingreso_envases_transacciones;
                                if (ingreso_envases_transacciones > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR PRESTAMOS DE ENVASES "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_envases_transacciones)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }               
                        
                        }

                        total_credito = bancos[j].ingreso_total_credito;
                        if(total_credito>0){
                        html += "<tr>";
                            html += "<td></td>";
                            html += "<td "+estilox+" colspan='4'><b>TARJETAS DE CREDITO "+nombre_moneda+"</b></td>";
                            html += "<td "+estilo2+" ></td>";
                            html += "<td "+estilo2+" ><b>"+formato_numerico(total_credito)+"</b></td>";
                            html += "<td "+estilo2+" ></td>";
                            html += "<td "+estilo2+" ></td>";
                        html += "</tr>";
                            ingreso_caja_tarjetascredito = bancos[j].ingreso_caja_tarjetascredito
                                if (ingreso_caja_tarjetascredito > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS A CAJA "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_caja_tarjetascredito)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }
                                ingreso_ventas_tarjetascredito = bancos[j].ingreso_ventas_tarjetascredito
                                if (ingreso_ventas_tarjetascredito > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR VENTAS "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_ventas_tarjetascredito)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }
                                ingreso_servicios_tarjetascredito = bancos[j].ingreso_servicios_tarjetascredito
                                if (ingreso_servicios_tarjetascredito > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR SERVICIOS "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_servicios_tarjetascredito)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }
                                ingreso_creditos_tarjetascredito = bancos[j].ingreso_creditos_tarjetascredito
                                if (ingreso_creditos_tarjetascredito > 0){
                                    numerofilas++;
                                    html += "<tr  style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR DEUDAS X COBRAR "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_creditos_tarjetascredito)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }                                      
                                ingreso_envases_tarjetascredito = bancos[j].ingreso_envases_tarjetascredito
                                if (ingreso_envases_tarjetascredito > 0){
                                    numerofilas++;
                                    html += "<tr  style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR PRESTAMOS DE ENVASES "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_envases_tarjetascredito)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }                                      
                        
                        }

                        total_cheque = bancos[j].ingreso_total_cheque
                        if(total_cheque>0){
                        html += "<tr>";
                            html += "<td></td>";
                            html += "<td "+estilox+" colspan='4'><b>OPERACIONE EN CHEQUE "+nombre_moneda+"</b></td>";
                            html += "<td "+estilo2+" ></td>";
                            html += "<td "+estilo2+" ><b>"+formato_numerico(total_cheque)+"</b></td>";
                            html += "<td "+estilo2+" ></td>";
                            html += "<td "+estilo2+" ></td>";
                        html += "</tr>";
                        ingreso_caja_cheque = bancos[j].ingreso_caja_cheque
                                if (ingreso_caja_cheque > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS A CAJA "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_caja_cheque)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }
                                ingreso_ventas_cheque = bancos[j].ingreso_ventas_cheque
                                if (ingreso_ventas_cheque > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR VENTAS "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_ventas_cheque)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }
                                ingreso_servicios_cheque = bancos[j].ingreso_servicios_cheque
                                if (ingreso_servicios_cheque > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR SERVICIOS "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_servicios_cheque)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }
                                ingreso_creditos_cheque = bancos[j].ingreso_creditos_cheque
                                if (ingreso_creditos_cheque > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS POR DEUDAS X COBRAR "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_creditos_cheque)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }                                            
                                ingreso_envases_cheque = bancos[j].ingreso_envases_cheque
                                if (ingreso_envases_cheque > 0){
                                    numerofilas++;
                                    html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                        html += "<td colspan='2'></td>";
                                        html += "<td "+estilox+" colspan='3'>INGRESOS PRESTAMOS DE ENVASES "+nombre_moneda+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" >"+formato_numerico(ingreso_envases_cheque)+"</td>";
                                        html += "<td "+estilo2+" ></td>";
                                        html += "<td "+estilo2+" ></td>";
                                    html += "</tr>";
                                }                        
                        
                        }
                    }
                    

                    html += "<tr>";
                        //html += "<td colspan='2'></td>";
                        html += "<td "+estilo+" colspan='5'><b>TOTAL EGRESOS "+nombre_moneda+"</b></td>";
                        html += "<td "+estilo+" colspan='2'></td>";
                        html += "<td "+estilo+"><b>"+formato_numerico(totalegresos)+"</b></td>";
                        html += "<td "+estilo+" colspan='1'></td>";
                    html += "</tr>";
                    for(let j = 0; j < bancos.length; j++){
                        
                        let no_egresos = () => {
                            let aux = false;
                            aux = bancos[j].egreso_total_efectivo + bancos[j].egreso_total_debito + bancos[j].egreso_total_transaccion + bancos[j].egreso_total_credito + bancos[j].egreso_total_cheque 
                            return (aux == 0);
                        };

                        if(no_egresos()) break;

                        let sumatoriaEgresos = parseFloat(bancos[j].egreso_total_efectivo)+
                                                parseFloat(bancos[j].egreso_total_transaccion)+
                                                parseFloat(bancos[j].egreso_total_credito)+
                                                parseFloat(bancos[j].egreso_total_debito)+
                                                parseFloat(bancos[j].egreso_total_cheque);

                        html += `<tr>
                                    <td ${estilo} colspan='7'><b>${bancos[j].banco_nombre}</b></td>
                                    <td ${estilo} colspan='2'><b>${sumatoriaEgresos.toFixed(2)}</b></td>
                                </tr>`;
                        let egreso_total_efectivo = bancos[j].egreso_total_efectivo;

                        // console.log(egreso_total_banco)
                        if(egreso_total_efectivo > 0){
                            html += "<tr>";
                                html += "<td></td>";
                                html += "<td "+estilox+" colspan='5'><b>OPERACIONES EN EFECTIVO "+nombre_moneda+"</b></td>";
                                html += "<td "+estilo2+" ></td>";
                                html += "<td "+estilo2+" ><b>"+formato_numerico(egreso_total_efectivo)+"</b></td>";
                                html += "<td "+estilo2+" ></td>";
                                html += "<td "+estilo2+" ></td>";
                            html += "</tr>";
                        
                            let egreso_caja = bancos[j].egreso_caja;
                            if (egreso_caja>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS DE CAJA "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_caja)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            

                            egreso_compras = bancos[j].egreso_compras;
                            if (egreso_compras>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR COMPRAS "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_compras)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                            egreso_ordenes = bancos[j].egreso_ordenes;

                            if (egreso_ordenes>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR ORDENES DE PAGO "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_ordenes)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                            egreso_pagos = bancos[j].egreso_pagos;
                            if (egreso_pagos>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR PAGOS DE CREDITO "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_pagos)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                        }
                    }
                        // let total_egreso_transacciones = bancos[j].egreso_caja_transacciones+
                        //                                 bancos[j].egreso_compras_transacciones+
                        //                                 bancos[j].egreso_ordenes_transacciones+
                        //                                 bancos[j].egreso_pagos_transacciones;
                        let total_egreso_transacciones = bancos[j].egreso_total_transaccion;

                        console.log(total_egreso_transacciones)
                        if(total_egreso_transacciones > 0){
                            html += "<tr>";
                                html += "<td></td>";
                                html += "<td "+estilox+" colspan='5'><b>TRANSACCIONES "+nombre_moneda+"</b></td>";
                                html += "<td "+estilo2+" ></td>";
                                html += "<td "+estilo2+" ><b>"+formato_numerico(total_egreso_transacciones)+"</b></td>";
                                html += "<td "+estilo2+" ></td>";
                                html += "<td "+estilo2+" ></td>";
                            html += "</tr>";
                        
                            let egreso_caja = bancos[j].egreso_caja_transacciones;
                            if (egreso_caja>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS DE CAJA "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_caja)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }

                            egreso_compras = bancos[j].egreso_compras_transacciones;
                            if (egreso_compras>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR COMPRAS "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_compras)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                            egreso_ordenes = bancos[j].egreso_ordenes_transacciones;

                            if (egreso_ordenes>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR ORDENES DE PAGO "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_ordenes)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                            egreso_pagos = bancos[j].egreso_pagos_transacciones;
                            if (egreso_pagos>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR PAGOS DE CREDITO "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_pagos)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                        }
                        
                        // let egreso_total_tarjetascredito = bancos[j].egreso_caja_tarjetascredito+
                        //                         bancos[j].egreso_compras_tarjetascredito+
                        //                         bancos[j].egreso_ordenes_tarjetascredito+
                        //                         bancos[j].egreso_pagos_tarjetascredito;
                        let egreso_total_tarjetascredito = bancos[j].egreso_total_credito;
                        // console.log(egreso_total_tarjetascredito)
                        if(egreso_total_tarjetascredito > 0){
                            html += "<tr>";
                                html += "<td></td>";
                                html += "<td "+estilox+" colspan='5'><b>TARJETA DE CREDITO "+nombre_moneda+"</b></td>";
                                html += "<td "+estilo2+" ></td>";
                                html += "<td "+estilo2+" ><b>"+formato_numerico(egreso_total_tarjetascredito)+"</b></td>";
                                html += "<td "+estilo2+" ></td>";
                                html += "<td "+estilo2+" ></td>";
                            html += "</tr>";
                        
                            let egreso_caja = bancos[j].egreso_caja_tarjetascredito;
                            if (egreso_caja>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS DE CAJA "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_caja)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }

                            egreso_compras = bancos[j].egreso_compras_tarjetascredito;
                            if (egreso_compras>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR COMPRAS "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_compras)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                            egreso_ordenes = bancos[j].egreso_ordenes_tarjetascredito;

                            if (egreso_ordenes>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR ORDENES DE PAGO "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_ordenes)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                            egreso_pagos = bancos[j].egreso_pagos_tarjetascredito;
                            if (egreso_pagos>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR PAGOS DE CREDITO "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_pagos)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                        }
                        
                        let egreso_total_debito = bancos[j].egreso_total_debito;
                        // console.log(egreso_total_caja)
                        if(egreso_total_debito > 0){
                            html += "<tr>";
                                html += "<td></td>";
                                html += "<td "+estilox+" colspan='5'><b>TARJETAS DE DEBITO "+nombre_moneda+"</b></td>";
                                html += "<td "+estilo2+" ></td>";
                                html += "<td "+estilo2+" ><b>"+formato_numerico(egreso_total_debito)+"</b></td>";
                                html += "<td "+estilo2+" ></td>";
                                html += "<td "+estilo2+" ></td>";
                            html += "</tr>";
                        
                            let egreso_caja = bancos[j].egreso_caja_debito;
                            if (egreso_caja>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS DE CAJA "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_caja)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }

                            egreso_compras = bancos[j].egreso_compras_debito;
                            if (egreso_compras>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR COMPRAS "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_compras)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                            egreso_ordenes = bancos[j].egreso_ordenes_debito;

                            if (egreso_ordenes>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR ORDENES DE PAGO "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_ordenes)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                            egreso_pagos = bancos[j].egreso_pagos_debito;
                            if (egreso_pagos>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR PAGOS DE CREDITO "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_pagos)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                        }
                        
                        let egreso_total_cheque = bancos[j].egreso_total_cheque;
                        // console.log(egreso_total_caja)
                        if(egreso_total_cheque > 0){
                            html += "<tr>";
                                html += "<td></td>";
                                html += "<td "+estilox+" colspan='5'><b>CHEQUES "+nombre_moneda+"</b></td>";
                                html += "<td "+estilo2+" ></td>";
                                html += "<td "+estilo2+" ><b>"+formato_numerico(egreso_total_cheque)+"</b></td>";
                                html += "<td "+estilo2+" ></td>";
                                html += "<td "+estilo2+" ></td>";
                            html += "</tr>";
                        
                            let egreso_caja = bancos[j].egreso_caja_cheque;
                            if (egreso_caja>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS DE CAJA "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_caja)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }

                            egreso_compras = bancos[j].egreso_compras_cheque;
                            if (egreso_compras>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR COMPRAS "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_compras)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                            egreso_ordenes = bancos[j].egreso_ordenes_cheque;

                            if (egreso_ordenes>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR ORDENES DE PAGO "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_ordenes)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                            egreso_pagos = bancos[j].egreso_pagos_cheque;
                            if (egreso_pagos>0){
                                numerofilas++;
                                html += "<tr style='display:none;' id='detalle_oculto"+numerofilas+"_"+j+"'>";
                                    html += "<td colspan='2'></td>";
                                    html += "<td "+estilox+" colspan='3'>EGRESOS POR PAGOS DE CREDITO "+nombre_moneda+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" ></td>";
                                    html += "<td "+estilo2+" >"+formato_numerico(egreso_pagos)+"</td>";
                                    html += "<td "+estilo2+" ></td>";
                                html += "</tr>";
                            }
                        }
                        

                    }
                    console.log(bancos)

                    subtotal = totalingresos - totalegresos;
                    
                    html += "<tr style='font-size:12px;'>";
                       html += "<td "+estilo+"></td>";
                        html += "<td "+estilo+" colspan='5'><b>SUB TOTAL EN CAJA "+nombre_moneda+"</b></td>";
                        html += "<td "+estilo+"></td>";
                        html += "<td "+estilo+" colspan='2'><b>"+formato_numerico(subtotal)+"</b></td>";
                        html += "<td "+estilo+"></td>";
                    html += "</tr>";
                    
                    var totalbanco = 0;
                    let banco_registrados = bancos.splice(1,bancos.length);//elimina a efectivo de bancos
                    // console.log(banco_registrados)
                    for(let banco_dif of banco_registrados){
                        
                        let ingresos_bancos = 0;
                        let egresos_bancos = 0;
                        ingresos_bancos = parseFloat(banco_dif.ingreso_total_efectivo)+parseFloat(banco_dif.ingreso_total_debito)+parseFloat(banco_dif.ingreso_total_transaccion)+parseFloat(banco_dif.ingreso_total_credito)+parseFloat(banco_dif.ingreso_total_cheque)
                        // console.log(ingresos_bancos)
                        egresos_bancos = parseFloat(banco_dif.egreso_total_efectivo)+parseFloat(banco_dif.egreso_total_debito)+parseFloat(banco_dif.egreso_total_transaccion)+parseFloat(banco_dif.egreso_total_credito)+parseFloat(banco_dif.egreso_total_cheque)
                        // console.log(egresos_bancos)
                        
                        totalbanco = ingresos_bancos - egresos_bancos;  //lo que queda son las transaciones por banco/debito/credito
                    
                        html += `<tr style='font-size:12px;'>
                                    <td ${estilox}></td>
                                    <td ${estilox} colspan='8'><b>${banco_dif.banco_nombre}</b></td>
                                </tr>`
                        html += "<tr style='font-size:12px;'>";
                            html += "<td "+estilox+"></td>";
                            html += "<td "+estilox+"></td>";
                            html += "<td "+estilox+" colspan='5'><b>TOTAL TRANSACCIONES BANCO/TARJ. CREDITO/DEBITO "+nombre_moneda+"</b></td>";
                            html += "<td "+estilox+" style='text-align: right'><b>"+formato_numerico(totalbanco != 0 ? totalbanco : 0)+"</b></td>";
                            html += "<td "+estilox+"></td>";
                        html += "</tr>";
                    }
                    
                    var efectivo_caja = 0;
                    // efectivo_caja = subtotal - totalbanco;
                    let efectivo_caja_diferencia = bancos.shift();
                    efectivo_caja_diferencia = parseFloat(efectivo_caja_diferencia.ingreso_total_efectivo) - parseFloat(efectivo_caja_diferencia.egreso_total_efectivo)
                    // efectivo_caja_diferencia = subtotal - totalbanco;
                    
                    html += "<tr style='font-size:12px;'>";
    //                    html += "<td "+estilo+"></td>";
                        html += "<td "+estilo+" colspan='5'><b>TOTAL EFECTIVO EN CAJA "+nombre_moneda+"</b></td>";
                        html += "<td "+estilo+"></td>";
                        html += "<td "+estilo+" colspan='2'><b>"+formato_numerico(efectivo_caja_diferencia)+"</b></td>";
                        html += "<td "+estilo+"></td>";
                    html += "</tr>";
                    if (tipousuario_id==1){
                        html += "<tr style='font-size:12px;'>";
                            html += "<td colspan='8'><b>UTILIDAD "+nombre_moneda+"</b></td>";
                            html += "<td colspan='2' style='text-align: right;'><b>"+formato_numerico(totalutilidad)+"</b></td>";
                        html += "</tr>";
                    }
                    
                      html += "<input  type='hidden' value='"+numerofilas+"' id='numerofilas' name='numerofilas' />"

                    $("#tablatotalresultados").html(html);
                   
                    $('#elusuario').html("<span class='text-bold'>Usuario: </span>"+esusuario);
                    $('#fecha1impresion').html(fecha1);
                    $('#fecha2impresion').html(fecha2);
//                   
//                    $("#tablaingresos").html(html);
//                    $("#tablaegresos").html(htmle);
//                    $("#totalingresos").html(numberFormat(Number(totalingreso).toFixed(2)));
//                    $("#totalegresos").html(numberFormat(Number(totalegreso).toFixed(2)));
//                    if(tipousuario_id == 1){
//                        $("#totalutilidad").html(numberFormat(Number(totalutilidad).toFixed(2)));
//                    }
//                    $("#totalingresotarj").html(numberFormat(Number(totalingresotarj).toFixed(2)));
//                    $("#saldoencaja").html(numberFormat(Number(totalingresoefec-totalegreso).toFixed(2)));
                    
                document.getElementById('loader').style.display = 'none';
            }
               document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaingresoresultados").html(html);
           $("#tablaventaresultados").html(html);
           $("#tablacobroresultados").html(html);
           $("#tablaegresoresultados").html(html);
           $("#tablacompraresultados").html(html);
           $("#tablapagoresultados").html(html);
           $("#tablatotalresultados").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        }
        
    });   

}

function porformapago(fecha_desde, fecha_hasta, usuario, formapago, nombre1, nombre2){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"reportes/reportesformapago";
    var tipoformapago = "";
    if(formapago == 1){
        tipoformapago = 1;
    }else if(formapago == 2){
        tipoformapago = 2;
    }else if(formapago == 3){
        tipoformapago = 3;
    }else if(formapago == 4){
        tipoformapago = 4;
    }else if(formapago == 5){
        tipoformapago = 5;
    }else if(formapago == 61){
        tipoformapago = 61;
    }
    
     /*var limite = 1000; */
     
    $.ajax({url: controlador,
           type:"POST",
           data:{fecha1:fecha_desde, fecha2:fecha_hasta, usuario_id:usuario, formapago: tipoformapago},
          
           success:function(resul){
              
                            
                //$("#resingegr").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                    var totalingreso = 0;
                    //var totalegreso = 0;
                    var totalutilidad = 0;

                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#resingegr").val("- "+n+" -");
                   
                    html = "";
                    html1 = "";
                    cabecerahtml1= "";
                    
                    var cont = 1;
                    for (var i = 0; i < n ; i++){
                      totalingreso  += parseFloat(registros[i]['ingreso']);
                      //totalegreso   += parseFloat(registros[i]['egreso']);
                      totalutilidad += parseFloat(registros[i]['utilidad']);
                        html += "<tr>";
                      
                        html += "<td>"+cont+"</td>";
                        
                       html += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss")+"</td>";
                       html += "<td>"+registros[i]["detalle"]+"</td>";
                       html += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                    //   html += "<td class='text-right'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                       //html += "<td class='text-right'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";

                       
                       
                        html += "</tr>";
                       cont += 1;
                   }

                    /* *****************INICIO para reporte TOTAL****************** */
                    var colorletra = "";
                    if(formapago !=1){
                        colorletra = "text-red";
                    }
                    cabecerahtml= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='mosv"+formapago+"' onclick='mostrar"+formapago+"(); return false'>+</a></td><td style='width:61%;'>"+nombre1+": </td><td style='width:17%;'  class='text-right'><span id='parasum"+formapago+"' class='"+colorletra+"'>"+numberFormat(Number(totalingreso).toFixed(2))+"</span></td><td style='width:17%;' class='text-right'></td></tr>"+"</table>";
            //                "<tr><td style='width:5%;'></td><td style='width:60%;'>"+nombre2+": </td><td style='width:35%;' class='text-right'>"+numberFormat(Number(totalutilidad).toFixed(2))+"</td></tr></table>";
                    //cabecerahtml2= "<label  class='control-label col-md-12'><div class='col-md-1'><a href='#' id='mosventa'onclick='mostrarventa(); return false'>+</a></div><div class='col-md-6'>Ingreso de Ventas: </div><div class='col-md-4'>"+numberFormat(Number(totalingreso2).toFixed(2))+"; &nbsp; &nbsp;Utilidad: "+numberFormat(Number(totalutilidad2).toFixed(2))+"</div><div class='col-md-3'></div></label>";
                    cabecerahtml += "<div id='ocultov"+formapago+"' style='display: none;'>";
                    cabecerahtml += "<div id='mapv"+formapago+"'>";
                    
                    cabecerahtml += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml += "<tr>";
                    cabecerahtml += "<th>N°</th>";
                    cabecerahtml += "<th>Fecha</th>";
                    cabecerahtml += "<th>Detalle</th>";
                    cabecerahtml += "<th>Ingreso</th>";
                //    cabecerahtml += "<th>Utilidad</th>";
                    cabecerahtml += "</tr>";
                    
                    piehtml = "</table></div></div>";
                    /* *****************F I N para reporte TOTAL****************** */
                   $("#tablaformapagoresultados"+formapago).html(cabecerahtml+html+piehtml);
                   return totalingreso;
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaformapagoresultados"+formapago).html(html);
        }
        
    });   

}
