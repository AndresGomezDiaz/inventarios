<?php defined('BASEPATH') OR exit('No direct script access allowed');
$attributes = array("role"=>"form", "id" => "registrar_familia", "name" => "registrar_familia", "class" => "form-horizontal form-label-left");
if(isset($registro)){ 
	$ligaUrl = base_url().'familia/FamiliaAlta/guardarFamilia/'.$registro; 
	$tituloForm = 'Editar familia';
}else{ 
	$ligaUrl = base_url().'familia/FamiliaAlta/guardarfamilia'; 
	$tituloForm = 'Registrar familia';
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
		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				<button type="submit" class="btn btn-success">Guardar</button>
				<a class="btn btn-default" href="<?=base_url().'familia'?>">Cancelar</a>
			</div>
		</div>
	<?=form_close()?>
</div>
