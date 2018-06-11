<?php defined('BASEPATH') OR exit('No direct script access allowed');
//$attributes = array("role"=>"form", "id" => "buscar_numeros", "name" => "buscar_numeros", "class" => "form-horizontal form-label-left");
?>
<input type="hidden" name="liga" id="liga" value="<?=base_url()?>">
<div class="x_title">
	<h2>Empresas registradas</h2>
	<ul class="nav navbar-right panel_toolbox">
		<li><button type="button" class="btn btn-success" style="color:#fff" onclick="location.href='<?=base_url().'registrar_empresa'?>'"><i class="fa fa-plus"></i> Registrar</button></li>
	</ul>
</div>
<div class="clearfix"></div>
<div class="x_content">
	<table id="datatable" class="table table-striped table-bordered">
	  <thead>
	    <tr>
			<th style="text-align:center">Nombre comercial</th>
			<th style="text-align:center">RFC</th>
			<th style="text-align:center">Opciones</th>
	    </tr>
	  </thead>
	  <tbody>
	  		<?php foreach($empresas->result() as $info): ?>
	  		<td><?=$info->nombre_comercial?></td>
	  		<td><?=$info->rfc?></td>
	  		<td style="text-align:center;">
	  			<a href="#"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;&nbsp;
	  			<a href="#"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;
	  		</td>
	  		<?php endforeach; ?>
	  </tbody>
	</table>
</div>

<!-- <div id="modal2" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title" id="myModalLabel">Detalles de la linea</h4>
		</div>
		<div class="modal-body" id="contenidoModal">

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>

		</div>
	</div>
</div> -->
