<?php defined('BASEPATH') OR exit('No direct script access allowed');
$attributes = array("role"=>"form", "id" => "registrar_almacen", "name" => "registrar_almacen", "class" => "form-horizontal form-label-left");
if(isset($registro)){ 
	$ligaUrl = base_url().'almacen/AlmacenAlta/guardarAlmacen/'.$registro; 
	$tituloForm = 'Editar almacen';
}else{ 
	$ligaUrl = base_url().'almacen/AlmacenAlta/guardarAlmacen'; 
	$tituloForm = 'Registrar almacen';
}
?>
<div class="x_title">
	<h2><?=$tituloForm?></h2>
</div>
<div class="clear"></div>

<div class="x_content">
	<?=form_open_multipart($ligaUrl,$attributes)?>
		<input type="hidden" name="liga" id="liga" value="<?=base_url()?>">
		<div class="form-group <?php if(form_error('nombre')){ echo 'has-error'; } ?>">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12" value="<?=$nombre?>">
				<?php echo form_error('nombre'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('tipo')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de almacen:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select name="tipo" id="tipo" estadoattri='' class="form-control col-md-7 col-xs-12" required="required">
					<option value="">Seleccione</option>	
					<option value="MP" <?=empty($tipo) ? "" : ($tipo === 'MP') ? "selected" : ""?> >Materia prima</option>
					<option value="PT" <?=empty($tipo) ? "" : ($tipo === 'PT') ? "selected" : ""?> >Producto terminado</option>
				</select>
				<?php echo form_error('tipo'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('empresa')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Empresa:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select name="empresa" id="empresa" estadoattri='' class="form-control col-md-7 col-xs-12" required="required">
					<option value="">Seleccione</option>
					<?php foreach($empresas->result() as $infoEmpresa):?>
					<option value="<?=$infoEmpresa->id?>" <?=empty($empresa) ? "" : ($empresa === $infoEmpresa->id) ? "selected" : ""?> ><?=$infoEmpresa->nombre_comercial?></option>
					<?php endforeach; ?>
				</select>
				<?php echo form_error('empresa'); ?>
			</div>
		</div>
		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				<button type="submit" class="btn btn-success">Guardar</button>
				<a class="btn btn-default" href="<?=base_url().'almacen'?>">Cancelar</a>
			</div>
		</div>
	<?=form_close()?>
</div>
