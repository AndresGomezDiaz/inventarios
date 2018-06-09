<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="x_title">
	<h2>Vendedores</h2>
	<ul class="nav navbar-right panel_toolbox">
		<li><button type="button" class="btn btn-success" style="color:#fff" onclick="location.href='<?=base_url().'registra_vendedor'?>'"><i class="fa fa-plus"></i> Registrar</button></li>
	</ul>
</div>
<div class="clearfix"></div>

<div class="x_content">
	<table id="datatable" class="table table-striped table-bordered">
	  <thead>
	  	<tr>
			<th>Nombre</th>
			<th>Apellidos</th>
			<th>Correo</th>
			<th>Perfil</th>
			<th>Estatus</th>
			<th style="text-align:center;">Bloquear</th>
			<th style="text-align:center;">Editar</th>
			<th style="text-align:center;">Eliminar</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach($usuarios->result() as $info): ?>
		<tr>
			<td><?=$info->nombre?></td>
			<td><?=$info->apellido?></td>
			<td><?=$info->correo?></td>
			<td><?=($info->perfil == 1) ? "Administrador" : "Vendedor (".$info->id_usuario.")"?></td>
			<th><?=($info->estatus == 1) ? "Activo" : "Inactivo"?></th>
			<?php if($info->estatus == 1){ ?>
				<td align="center"><a href="<?=base_url().'inactivar_vendedor/'.$info->id_usuario?>"><i class="fa fa-ban fa-2x fa-2x"></i></a></td>
			<?php }else{ ?>
				<td align="center"><a href="<?=base_url().'activar_vendedor/'.$info->id_usuario?>"><i class="fa fa-check fa-2x fa-2x"></i></a></td>
			<?php } ?>
			<td align="center"><a href="<?=base_url().'edita_vendedor/'.$info->id_usuario?>"><i class="fa fa-edit fa-2x fa-2x"></i></a></td>
			<td align="center"><a href="<?=base_url().'elimina_vendedor/'.$info->id_usuario?>"><i class="fa fa-trash fa-2x"></i></a></td>
	    </tr>
	  	<?php endforeach; ?>
	  </tbody>
	</table>
</div>
