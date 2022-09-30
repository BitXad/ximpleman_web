<script src="<?php echo base_url('resources/js/script.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/Impresora.js'); ?>"></script>
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>

<div class="row">
            <div class="col-12">
                <h1>Imprimir ticket de venta desde JavaScript usando plugin</h1>
                <a href="//parzibyte.me/blog">By Parzibyte</a>
                <br>
                <a class="btn btn-danger btn-sm" href="../../index.html">Documentación</a>
            </div>
            <!-- Aquí pon las col-x necesarias, comienza tu contenido, etcétera -->
            <div class="col-12 col-lg-6">

                <h2>Ajustes de impresora</h2>
                <strong>Nombre de impresora seleccionada: </strong>
                <p id="impresoraSeleccionada"></p>
                <div class="form-group">
                    <select class="form-control" id="listaDeImpresoras"></select>
                </div>
                <button class="btn btn-primary btn-sm" id="btnRefrescarLista">Refrescar lista</button>
                <button class="btn btn-primary btn-sm" id="btnEstablecerImpresora">Establecer como predeterminada</button>
                <h2>Ticket de prueba</h2>
                <p>Utiliza el siguiente botón para imprimir un recibo de prueba en la impresora predeterminada:</p>
                <button class="btn btn-success" id="btnImprimir">Imprimir ticket</button>

            </div>
            <div class="col-12 col-lg-6">
                <h2>Log</h2>
                <button class="btn btn-warning btn-sm" id="btnLimpiarLog">Limpiar log</button>
                <pre id="estado"></pre>
            </div>
        </div>
<!--<script src="<?php echo base_url('resources/js/script.js'); ?>"></script>
    <script src="<?php echo base_url('resources/js/script.js'); ?>"></script>-->
