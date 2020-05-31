<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Configuracion Email Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('configuracion_email/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Email Id</th>
						<th>Email Protocolo</th>
						<th>Email Host</th>
						<th>Email Puerto</th>
						<th>Email Usuario</th>
						<th>Email Clave</th>
						<th>Email Nombre</th>
						<th>Email Prioridad</th>
						<th>Email Charset</th>
						<th>Email Encriptacion</th>
						<th>Email Tipo</th>
						<th>Email Copia</th>
						<th>Estado Id</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($configuracion_email as $c){ ?>
                    <tr>
						<td><?php echo $c['email_id']; ?></td>
						<td><?php echo $c['email_protocolo']; ?></td>
						<td><?php echo $c['email_host']; ?></td>
						<td><?php echo $c['email_puerto']; ?></td>
						<td><?php echo $c['email_usuario']; ?></td>
						<td><?php echo $c['email_clave']; ?></td>
						<td><?php echo $c['email_nombre']; ?></td>
						<td><?php echo $c['email_prioridad']; ?></td>
						<td><?php echo $c['email_charset']; ?></td>
						<td><?php echo $c['email_encriptacion']; ?></td>
						<td><?php echo $c['email_tipo']; ?></td>
						<td><?php echo $c['email_copia']; ?></td>
						<td><?php echo $c['estado_id']; ?></td>
						<td>
                            <a href="<?php echo site_url('configuracion_email/edit/'.$c['email_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('configuracion_email/remove/'.$c['email_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
