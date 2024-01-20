function guardar_formula()
{
//    alert("guardar formula");
    
    var monto = document.getElementById('venta_totalfinal').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'formula/registrar_formula/';
    
    var formula_nombre = document.getElementById('formula_nombre').value;
    var formula_unidad = document.getElementById('formula_unidad').value;
    var formula_cantidad = document.getElementById('formula_cantidad').value;
    //var formula_costounidad = document.getElementById('formula_costounidad').value;
    var formula_costounidad = monto;
    var formula_preciounidad = document.getElementById('formula_preciounidad').value;
    
    
        
        if (monto>0)
        {
           document.getElementById('divventas0').style.display = 'none'; //ocultar el vid de ventas 
           document.getElementById('divventas1').style.display = 'block'; // mostrar el div de loader

            $.ajax({url: controlador,
            type: "POST",
            data:{formula_nombre:formula_nombre, formula_unidad:formula_unidad, formula_cantidad:formula_cantidad, formula_costounidad:formula_costounidad,formula_preciounidad:formula_preciounidad}, 
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                //var factura_id = resultado;
                
                alert("aquiiii");
                
               // window.open(base_url+"factura/imprimir_factura_id/"+factura_id+"/1", '_blank');


            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },        
        
            });
        
           document.getElementById('divventas0').style.display = 'block'; //ocultar el vid de ventas 
           document.getElementById('divventas1').style.display = 'none'; // mostrar el div de loader
            
        }
    
}
