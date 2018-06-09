<?php defined('BASEPATH') OR exit('No direct script access allowed');
$attributes = array("role"=>"form", "id" => "registrar_empresa", "name" => "registrar_empresa", "class" => "form-horizontal form-label-left");
if(isset($registro)){ 
	$ligaUrl = base_url().'empresa/EmpresaAlta/guardarEmpresa/'.$registro; 
	$tituloForm = 'Editar empresa';
}else{ 
	$ligaUrl = base_url().'empresa/EmpresaAlta/guardarEmpresa'; 
	$tituloForm = 'Registrar empresa';
}
?>
<div class="x_title">
	<h2><?=$tituloForm?></h2>
</div>
<div class="clear"></div>

<div class="x_content">
	<?=form_open_multipart($ligaUrl,$attributes)?>
		<input type="hidden" name="liga" id="liga" value="<?=base_url()?>">
		<div class="form-group <?php if(form_error('nombre_comercial')){ echo 'has-error'; } ?>">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre comercial:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="nombre_comercial" name="nombre_comercial" required="required" class="form-control col-md-7 col-xs-12" value="<?=$nombre_comercial?>">
				<?php echo form_error('nombre_comercial'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('razon_social')){ echo 'has-error'; } ?>">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Razon social:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="razon_social" name="razon_social" required="required" class="form-control col-md-7 col-xs-12" value="<?=$razon_social?>">
				<?php echo form_error('razon_social'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('rfc')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">RFC:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input id="rfc" name="rfc" class="form-control col-md-7 col-xs-12" type="text" value="<?=$rfc?>">
				<?php echo form_error('rfc'); ?>
			</div>
		</div>
		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				<button type="submit" class="btn btn-success">Guardar</button>
				<a class="btn btn-default" href="<?=base_url().'usuarios'?>">Cancelar</a>
			</div>
		</div>
	<?=form_close()?>
</div>
