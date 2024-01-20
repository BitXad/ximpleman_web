
    function agregar_plan(tipo = 0, borrar = 0){
        var base_url = document.getElementById("base_url").value;
        var controlador = `${base_url}plan_cuentas/get_tipo_planes`
        if(borrar == 0){
            var cuenta_mayor = document.getElementById("cuenta_mayor");
            document.getElementById("tipo").value = tipo;
        }else{
            var cuenta_mayor = document.getElementById("cuenta_mayor_borrar");
        }
        if (tipo != 0) {
            $.ajax({
                url:controlador,
                type:"POST",
                data:{tipo:tipo},
                success:function(resultado){
                    // alert("ok");
                    result = JSON.parse(resultado);
            
                    var html2 = ``;
                    result.forEach(res => {
                        html2 += `<option value="${res['p_cuenta_id']}">Nivel ${res['p_cuenta_nivel']}. ${res['p_cuenta_nombre']}</option>
                        `;
                    });
                    cuenta_mayor.innerHTML = html2;
                },
                error:function(){
                    alert("algo salio mal al obtener el plan")
                }
            });
        }else{
            document.getElementById("label_cuenta_mayor").style.display = "none";
            cuenta_mayor.style.display = "none";
        }
    }

    function get_planes(tipo = 0){
        var cuenta_mayor = document.getElementById("cuenta_mayor_edit");
        var base_url = document.getElementById("base_url").value;
        var controlador = `${base_url}plan_cuentas/get_tipo_planes`
        document.getElementById("tipo").value = tipo;
        if (tipo != 0) {
            $.ajax({
                url:controlador,
                type:"POST",
                data:{tipo:tipo},
                success:function(resultado){
                    result = JSON.parse(resultado);
                    var html2 = ``;
                    result.forEach(res => {
                        html2 += `<option value="${res['p_cuenta_id']}">Nivel ${res['p_cuenta_nivel']}. ${res['p_cuenta_nombre']}</option>
                        `;
                    });
                    cuenta_mayor.innerHTML = html2;
                },
                error:function(){
                    alert("algo salio mal al obtener el plan")
                }
            });
        }else{
            document.getElementById("label_cuenta_mayor").style.display = "none";
            cuenta_mayor.style.display = "none";
        }
    }

    function plan_escogido(){
        var plan_escogido = document.getElementById("cuenta_mayor_edit").value;
        var base_url = document.getElementById("base_url").value;
        var controlador = `${base_url}plan_cuentas/get_p_cuenta`
        if (tipo != 0) {
            $.ajax({
                url:controlador,
                type:"POST",
                data:{plan_escogido:plan_escogido},
                success:function(resultado){
                    result = JSON.parse(resultado);
                    document.getElementById("new_nombre").value = result['p_cuenta_nombre'];
                },
                error:function(){
                    alert("algo salio mal al obtener el plan")
                }
            });
        }else{
            document.getElementById("label_cuenta_mayor").style.display = "none";
            cuenta_mayor.style.display = "none";
        }
    }

    function mostrar_hijos(id){
        var base_url =  document.getElementById("base_url").value;
        var controler = `${base_url}plan_cuentas/get_cuenta_hijo`;
        var cuenta = document.getElementById(`listahijos${id}`);
        var p_cuenta_id = id;
        $.ajax({
            url: controler,
            type: "POST",
            data: {p_cuenta_id:p_cuenta_id},
            success:function(res){
                cuentas = JSON.parse(res);
                var html = ``;
                cuentas.forEach(cuenta =>{
                    html += `<div class="col-md-1">
                            </div>
                            <div class="col-md-11">
                                <a onclick="mostrar_hijos(${cuenta['p_cuenta_id']})" style="cursor: pointer;"> ${cuenta['p_cuenta_num']}. ${cuenta['p_cuenta_nombre']}<a>
                                <div class="row" id="listahijos${cuenta['p_cuenta_id']}"></div>
                            </div>`
                });
                cuenta.innerHTML = html;
            },
            error:function(){
                alert("algo salio mal al buscar a los hijos");
            }
        });
    }