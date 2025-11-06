$(document).on("ready",inicio);


function inicio(){
    var nowsql = now_sql();
    filtro = " and date(ingreso_fecha) = date("+nowsql+")";
        fechadeingreso(filtro);
} 

function now_sql() {
  const fecha = new Date();
  const year = fecha.getFullYear();
  const month = agregarCeroSiNecesario(fecha.getMonth() + 1);
  const day = agregarCeroSiNecesario(fecha.getDate());
  const hours = agregarCeroSiNecesario(fecha.getHours());
  const minutes = agregarCeroSiNecesario(fecha.getMinutes());
  const seconds = agregarCeroSiNecesario(fecha.getSeconds());

  return `'${year}-${month}-${day} ${hours}:${minutes}:${seconds}'`;
}

function agregarCeroSiNecesario(numero) {
  return numero < 10 ? `0${numero}` : numero;
}

function buscar_ingresos()
{
    //var base_url    = document.getElementById('base_url').value;
    //var controlador = base_url+"ingreso";
    var opcion      = document.getElementById('select_compra').value;
    var nowsql = now_sql();
    
    if(opcion == 1){
        filtro = " and date(ingreso_fecha) = date("+nowsql+")";
        mostrar_ocultar_buscador("ocultar");
        fechadeingreso(filtro);
    }else if(opcion == 2){ //compras de hoy
        filtro = " and date(ingreso_fecha) = date_add(date("+nowsql+"), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
        fechadeingreso(filtro);
    }else if(opcion == 3){//compras de hayer
        filtro = " and date(ingreso_fecha) >= date_add(date("+nowsql+"), INTERVAL -1 WEEK)";//compras de la semana
        mostrar_ocultar_buscador("ocultar");
        fechadeingreso(filtro);
    }else if(opcion == 4){
        filtro = " ";//todos los compras
        mostrar_ocultar_buscador("ocultar");
        fechadeingreso(filtro);
    }else if(opcion == 5){
        mostrar_ocultar_buscador("mostrar");
    }
}

function buscar_por_fechas()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"ingreso";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
   
    filtro = " and date(ingreso_fecha) >= '"+fecha_desde+"'  and  date(ingreso_fecha) <='"+fecha_hasta+"' ";
    
    fechadeingreso(filtro);
    
}

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

function buscaringreso(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        var filtrar = document.getElementById('filtrar').value;
        let filtro = " and(i.ingreso_numero = '"+filtrar+"' or i.ingreso_nombre like '%"+filtrar+"%'";
        filtro += " or i.ingreso_monto like '%"+filtrar+"%' or i.ingreso_concepto like '%"+filtrar+"%')";
        fechadeingreso(filtro);
    }
}

    
    // 👉 NUEVO: almacena el último resultado para exportar
    let _ingresosDatos = [];


function fechadeingreso(filtro)
{
   
    
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"ingreso/buscarfecha";
    var categoria = document.getElementById('categoria_id').value;
    if (categoria==0) {
        var categ = " ";
    }else{
        var categ = " and i.ingreso_categoria='"+categoria+"' ";
    }
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({
        url: controlador,
        type:"POST",
        data:{
            filtro:filtro,
            categoria:categoria,
        },success:(resul) => {     
            $("#pillados").val("- 0 -");
            var registros =  JSON.parse(resul);
            _ingresosDatos = Array.isArray(registros) ? registros : []; // 👉 NUEVO
            if (registros != null){
                var nombre_moneda = document.getElementById('nombre_moneda').value;
                var lamoneda_id = document.getElementById('lamoneda_id').value;
                var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
                var total_otramoneda = Number(0);
                var total_otram = Number(0);
                
                var cont = 0;
                var total = Number(0);
                
                var n = registros.length; //tama単o del arreglo de la consulta
                $("#pillados").html("Registros Encontrados: "+n+"");
                
                html = "";
            
                for (var i = 0; i < n ; i++){
                    
                    var suma = Number(registros[i]["ingreso_monto"]);
                    var total = Number(suma+total);
                    
                    html += "<tr>";
                    
                    html += "<td>"+(i+1)+"</td>";
                    html += "<td><b>"+registros[i]["ingreso_nombre"]+"</b><sub> ["+registros[i]["ingreso_id"]+"]</sub></td>";
                    html += "<td align='center'>"+registros[i]["ingreso_numero"]+"</td>";  
                    html += "<td align='center'>"+moment(registros[i]["ingreso_fecha"]).format('DD/MM/YYYY HH:mm:ss')+"</td>";  
                    html += "<td>"+registros[i]["ingreso_categoria"]+"</br>"; 
                    html += "<b>"+registros[i]["ingreso_concepto"]+"</b></td>"; 
                    html += "<td align='right'>"+numberFormat(Number(registros[i]["ingreso_monto"]).toFixed(2));
                    html += "<br>";
                    if(lamoneda_id == 1){
                        total_otram = Number(registros[i]["ingreso_monto"])/Number(registros[i]["ingreso_tc"]);
                        total_otramoneda += total_otram;
                    }else{
                        total_otram = Number(registros[i]["ingreso_monto"])*Number(registros[i]["ingreso_tc"]);
                        total_otramoneda += total_otram;
                    }
                    html += "<span style='font-size: 8px'>"+numberFormat(Number(total_otram).toFixed(2))+"</span>";
                    html += "</td>"; 
                        html += "</td>"; 
                    html += "</td>"; 
                    html += "<td>"+registros[i]["moneda_descripcion"];
                    html += "<br>";
                    if(lamoneda_id == 1){
                        html += "<span style='font-size: 8px'>"+lamoneda[1]['moneda_descripcion']+"</span>";
                    }else{
                        html += "<span style='font-size: 8px'>"+lamoneda[0]['moneda_descripcion']+"</span>";
                    }
                    html += "</td>";
                    html += "<td>";
                    if(registros[i]["forma_id"] >0){
                        html += registros[i]["forma_nombre"];
                        if(registros[i]["forma_id"]> 1){
                            html += "<br><b>Glosa: </b>"+registros[i]["ingreso_glosa"];
                        }
                    }
                    html += "</td>";
                    html += "<td>";
                    if(registros[i]["banco_id"] >0){
                        html += registros[i]["banco_nombre"]+" ("+registros[i]["banco_numcuenta"]+")";
                    }
                    html += "</td>";
                    html += "<td>"+registros[i]["usuario_nombre"]+"</td>";
                    html += "<td  class='no-print'><a href='"+base_url+"ingreso/imprimir/"+registros[i]["ingreso_id"]+"' title='Carta' target='_blank' class='btn btn-success btn-xs'><span class='fa fa-print'></a>";
                    
//                        html += "<a href='"+base_url+"ingreso/boucher/"+registros[i]["ingreso_id"]+"' title='Bouche' target='_blank' class='btn btn-facebook btn-xs'><span class='fa fa-print'></a>";
                    
                    if (registros[i]["factura_id"]>0) {
                    html += "<a href='"+base_url+"factura/imprimir_factura_id/"+registros[i]["factura_id"]+"/2' title='Factura' target='_blank' class='btn btn-warning btn-xs'><span class='fa fa-list'></a>";
                    }
                    html += "<a href='"+base_url+"ingreso/edit/"+registros[i]["ingreso_id"]+"'  class='btn btn-info btn-xs'><span class='fa fa-pencil'></a>";
                    html += "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+i+"' title='Eliminar'><span class='fa fa-trash'></span></a>";
                    html += "<!------------------------ INICIO modal para confirmar eliminación ------------------->";
                    html += "<div class='modal fade' id='myModal"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                    html += "<div class='modal-dialog' role='document'>";
                    html += "<br><br>";
                    html += "<div class='modal-content'>";
                    html += "<div class='modal-header'>";
                    html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                    html += "</div>";
                    html += "<div class='modal-body'>";
                    html += "<!------------------------------------------------------------------->";
                    html += "<h3><b> <span class='fa fa-trash'></span></b>";
                    html += "Desea eliminar el ingreso <b># "+registros[i]["ingreso_numero"]+"?</b>";
                    html += "</h3>";
                    html += "<!------------------------------------------------------------------->";
                    html += "</div>";
                    html += "<div class='modal-footer aligncenter'>";
                    html += "<a href='"+base_url+"ingreso/remove/"+registros[i]["ingreso_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                    html += " <a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                    html += "<!------------------------ FIN modal para confirmar eliminación ------------------->";
                    html += "</td>";
                    
                    html += "</tr>";
                } 
                    html += "<tr>";
                    html += "<td></td>";
                    html += "<td></td>";
                    html += "<td></td>";
                    html += "<td></td>";
                    html += "<td align='right'><font size='4'><b>TOTAL</b></font></td>";
                    html += "<td align='right'><font size='4'><b>"+numberFormat(Number(total).toFixed(2))+"</b></font>";
                    html += "<br>";
                    html += "<span style='font-size: 9px'>"+numberFormat(Number(total_otramoneda).toFixed(2))+"</span>"
                    html += "</td>";
                    html += "<td><font size='4'><b>"+nombre_moneda+"</b></font>";
                    html += "<br>";
                    if(lamoneda_id == 1){
                        html += "<span style='font-size: 9px'>"+lamoneda[1]['moneda_descripcion']+"</span>";
                    }else{
                        html += "<span style='font-size: 9px'>"+lamoneda[0]['moneda_descripcion']+"</span>";
                    }
                    html += "</td>";
                    html += "<td></td>";
                    html += "<td></td>";
                    html += "<td></td>";
                    html += "</tr>";
                
                $("#fechadeingreso").html(html);
                document.getElementById('loader').style.display = 'none';
            }
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#fechadeingreso").html(html);
        }
        
    });   

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

/* ========= Exportar resultados a Excel (CSV) ========= */
function exportIngresosExcel(){
  if(!_ingresosDatos || _ingresosDatos.length === 0){
    alert("No hay datos para exportar. Realiza primero una consulta o filtro.");
    return;
  }

  // Datos de moneda para columna equivalente
  var nombre_moneda = document.getElementById('nombre_moneda').value;
  var lamoneda_id   = document.getElementById('lamoneda_id').value;
  var lamoneda      = JSON.parse(document.getElementById('lamoneda').value);

  // Moneda equivalente (la que no es la base seleccionada)
  let otraMonedaNombre = "";
  if (Array.isArray(lamoneda) && lamoneda.length >= 2){
    otraMonedaNombre = (String(lamoneda_id) === "1")
      ? lamoneda[1]['moneda_descripcion']
      : lamoneda[0]['moneda_descripcion'];
  }

  // Cabecera Excel-friendly
  let CSV = 'sep=,' + '\r\n';

  // Encabezados (agregamos HORA)
  const headers = [
    'N°',
    'NOMBRE',
    '# RECIBO',
    'FECHA',
    'HORA',
    'CATEGORIA',
    'CONCEPTO',
    `MONTO (${nombre_moneda})`,
    `MONTO EQ. (${otraMonedaNombre})`,
    'MONEDA',
    'FORMA DE PAGO',
    'GLOSA',
    'BANCO',
    'CUENTA',
    'USUARIO'
  ];
  CSV += headers.join(',') + '\r\n';

  // Cuerpo
  let totalBase = 0, totalEq = 0;
  for(let i=0; i<_ingresosDatos.length; i++){
    const r = _ingresosDatos[i] || {};

    const monto = toNumber(r["ingreso_monto"]);
    // cálculo equivalente como en la vista (usa ingreso_tc por registro)
    let eq = 0;
    const tc = toNumber(r["ingreso_tc"]);
    if(String(lamoneda_id) === "1"){
      eq = tc ? (monto / tc) : 0;
    }else{
      eq = monto * tc;
    }
    totalBase += monto;
    totalEq   += eq;

    // separar FECHA y HORA
    const [fechaSolo, horaSola] = splitDateTime(r["ingreso_fecha"]);

    const fila = [
      i+1,
      safeCSV(r["ingreso_nombre"]),
      safeCSV(r["ingreso_numero"]),
      safeCSV(fechaSolo),                 // FECHA
      safeCSV(horaSola),                  // HORA
      safeCSV(r["ingreso_categoria"]),
      safeCSV(r["ingreso_concepto"]),
      fixed2(monto),
      fixed2(eq),
      safeCSV(r["moneda_descripcion"]),
      safeCSV(r["forma_nombre"] || ''),   // puede venir null
      safeCSV(r["ingreso_glosa"]  || ''),
      safeCSV(r["banco_nombre"]   || ''),
      safeCSV(r["banco_numcuenta"]|| ''),
      safeCSV(r["usuario_nombre"] || '')
    ];
    CSV += fila.join(',') + '\r\n';
  }

  // Fila de totales (desplazada por la nueva columna HORA)
  CSV += [
    '', '', '', '', '', 'TOTAL',
    fixed2(totalBase),
    fixed2(totalEq),
    nombre_moneda,
    '', '', '', '', '', ''
  ].join(',') + '\r\n';

  // Nombre de archivo
  const nombre = "Ingresos_" + timeStamp();
  const uri = 'data:text/csv;charset=utf-8,' + encodeURIComponent(CSV);

  const link = document.createElement("a");
  link.href = uri;
  link.style.display = "none";
  link.download = nombre + ".csv"; // Excel lo abre directo
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

/* ======= Helpers ======= */
function safeCSV(val){
  if (val === null || val === undefined) return '';
  let s = String(val).replace(/\r?\n|\r/g, ' ').replace(/"/g, '""');
  if (/[",]/.test(s)) s = `"${s}"`;
  return s;
}
function toNumber(v){
  const n = Number(v);
  return isNaN(n) ? 0 : n;
}
function fixed2(n){
  return (toNumber(n)).toFixed(2);
}
function timeStamp(){
  const d = new Date();
  const pad = (x)=> (x<10?'0':'')+x;
  return `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}_${pad(d.getHours())}-${pad(d.getMinutes())}-${pad(d.getSeconds())}`;
}

/* ===== Nuevo helper para dividir fecha y hora ===== */
function splitDateTime(val){
  if (!val && val !== 0) return ['',''];
  let s = String(val).trim();

  if (s.endsWith('Z')) s = s.slice(0, -1);    // ISO con Z
  if (s.includes('T')){                        // ISO "YYYY-MM-DDTHH:MM:SS"
    const [d, t] = s.split('T');
    return [d || '', cleanTime(t || '')];
  }
  if (s.includes(' ')){                        // "YYYY-MM-DD HH:MM:SS"
    const idx = s.indexOf(' ');
    const d = s.slice(0, idx);
    const t = s.slice(idx+1);
    return [d || '', cleanTime(t || '')];
  }
  if (/^\d{4}-\d{2}-\d{2}$/.test(s)) return [s, '']; // solo fecha
  if (/^\d{2}:\d{2}(:\d{2}(\.\d+)?)?$/.test(s)) return ['', cleanTime(s)]; // solo hora

  const m = s.match(/^(\d{4}-\d{2}-\d{2})(.+)$/);    // fecha + offset sin T
  if (m) return [m[1], cleanTime(m[2].trim())];

  return [s, '']; // fallback
}
function cleanTime(t){
  return t.replace(/\.\d+$/, ''); // quita milisegundos
}

