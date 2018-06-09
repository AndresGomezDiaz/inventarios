<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="x_title">
	<h2>Sub-Vendedores</h2>
	<ul class="nav navbar-right panel_toolbox">
		<li><button type="button" class="btn btn-primary" style="color:#fff" data-toggle="modal" data-target="#modal1">Filtrar</button></li>
		<li><button type="button" class="btn btn-success" style="color:#fff" onclick="location.href='<?=base_url().'registra_empleado'?>'"><i class="fa fa-plus"></i> Registrar</button></li>
	</ul>
</div>
<div class="clearfix"></div>

<div class="x_content">
	<table id="datatable" class="table table-striped table-bordered">
	  <thead>
	  	<tr>
	    	<th>Vendedor</th>
			<th>Empleado</th>
			<th>Correo</th>
			<th>Estatus</th>
			<th style="text-align:center;">Bloquear</th>
			<th style="text-align:center;">Editar</th>
			<th style="text-align:center;">Eliminar</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach($empleados->result() as $info): ?>
	  		<tr>
				<td><?=$info->nom_vendedor.' '.$info->apellido_vendedor?></td>
				<td><?=$info->nombre.' '.$info->apellido?></td>
				<td><?=$info->correo?></td>
				<th><?=($info->estatus == 1) ? "Activo" : "Inactivo"?></th>
				<td align="center"><a href="<?=base_url().'edita_empleado/'.$info->id_empleado?>"><i class="fa fa-ban fa-2x fa-2x"></i></a></td>
				<td align="center"><a href="<?=base_url().'activar_empleado/'.$info->id_empleado?>"><i class="fa fa-edit fa-2x fa-2x"></i></a></td>
				<td align="center"><a href="<?=base_url().'inactivar_empleado/'.$info->id_empleado?>"><i class="fa fa-trash fa-2x"></i></a></td>
			</tr>
	  	<?php endforeach; ?>
	  </tbody>
	</table>
</div>
