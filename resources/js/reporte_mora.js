var base_url;
$(document).on("ready",function(){
    base_url = document.getElementById('base_url').value;
    tabla_moras();
});

function tabla_moras() {
    let usuario = $('#buscarusuario_id').val();
    let controlador = `${base_url}reportes/get_moras`
    console.log(controlador)
    $.ajax({
        url: controlador,
        type: "POST",
        cache: false,
        data:{
            usuario: usuario
        },
        success: (result) => {
            let html = ``;
            let i = 1;
            let moras = JSON.parse(result);
            let total_capital = 0;
            let total_intereses = 0;
            let total_mora = 0;
            let total_deuda = 0;
            let deuda_cuota = 0;
            for(let mora of moras){
                let total = parseFloat(mora['credito_monto']) + parseFloat(mora['cuota_interes']) + parseFloat(mora['multa'])

                html += `<tr>
                            <td>${i}</td>
                            <td>${mora['cliente_nombre']}<sub>[${mora['credito_id']}]</sub></td>
                            <td class="text-center">${mora['cliente_celular']}</td>
                            <td class="text-center">${mora['razon']} (${mora['venta_id']})</td>
                            <td class="text-center">${mora['deudas_mora']}</td>
                            <td class="text-center">${parseFloat(mora['monto_deuda']).toFixed(2)}</td>
                            <td class="text-center">${mora['dias_mora']}</td>
                            <td class="text-center">${mora['credito_monto']}</td>
                            <td class="text-center">${mora['cuota_interes']}</td>
                            <td class="text-center">${parseFloat(mora['multa']).toFixed(2)}</td>
                            <td class="text-center">${parseFloat(total).toFixed(2)}</td>
                        </tr>`
                i++;
                total_capital += parseFloat(mora['credito_monto']);
                total_intereses += parseFloat(mora['cuota_interes']);
                total_mora += parseFloat(parseFloat(mora['multa']).toFixed(2));
                total_deuda += parseFloat(total);
                deuda_cuota += parseFloat(mora['monto_deuda'])
            }
            html += `<tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>${parseFloat(deuda_cuota).toFixed(2)}</th>
                        <th></th>
                        <th><b>${parseFloat(total_capital).toFixed(2)}</b></th>
                        <th><b>${parseFloat(total_intereses).toFixed(2)}</b></th>
                        <th><b>${parseFloat(total_mora).toFixed(2)}</b></th>
                        <th><b>${parseFloat(total_deuda).toFixed(2)}</b></th>
                    </tr>`
            $("#tablaMora").html(html);
        },
        error: () => {
            alert("Error al obtener las moras")
        }
    })
}