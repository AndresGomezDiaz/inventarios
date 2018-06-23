<?php defined('BASEPATH') OR exit('No direct script access allowed');
$attributes = array("role"=>"form", "id" => "registrar_producto", "name" => "registrar_producto", "class" => "form-horizontal form-label-left");
if(isset($registro)){ 
	$ligaUrl = base_url().'producto/ProductoAlta/guardarProducto/'.$registro; 
	$tituloForm = 'Editar producto';
}else{ 
	$ligaUrl = base_url().'producto/ProductoAlta/guardarProducto'; 
	$tituloForm = 'Registrar producto';
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
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de producto:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select name="tipo" id="tipo" estadoattri='' class="form-control col-md-7 col-xs-12" required="required">
					<option value="">Seleccione</option>	
					<option value="MP" <?=($tipo === 'MP') ? 'selected' : ''?> >Materia prima</option>
					<option value="PT" <?=($tipo === 'PM') ? 'selected' : ''?> >Poducto terminado</option>
				</select>
				<?php echo form_error('tipo'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('familia')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Familia:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select name="familia" id="familia" estadoattri='' class="form-control col-md-7 col-xs-12" required="required">
					<option value="">Seleccione</option>	
					<?php foreach($familias->result() as $infoFamilia): ?>
						<option value="<?=$infoFamilia->id?>"><?=$infoFamilia->nombre?></option>
					<?php endforeach; ?>
				</select>
				<?php echo form_error('familia'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('unidad')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Unidad:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select name="unidad" id="unidad" estadoattri='' class="form-control col-md-7 col-xs-12" required="required">
					<option value="">Seleccione</option>	
					<?php foreach($unidades->result() as $infoUnidad): ?>
						<option value="<?=$infoUnidad->id?>"><?=$infoUnidad->nombre?></option>
					<?php endforeach; ?>
				</select>
				<?php echo form_error('unidad'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('presentacion')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Presentación:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select name="presentacion" id="presentacion" estadoattri='' class="form-control col-md-7 col-xs-12" required="required">
					<option value="">Seleccione</option>	
					<?php foreach($presentaciones->result() as $infopresentacion): ?>
						<option value="<?=$infopresentacion->id?>"><?=$infopresentacion->nombre?></option>
					<?php endforeach; ?>
				</select>
				<?php echo form_error('presentacion'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('cantidad_x_presentacion')){ echo 'has-error'; } ?>">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad por presentación:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="cantidad_x_presentacion" name="cantidad_x_presentacion" required="required" class="form-control col-md-7 col-xs-12" value="<?=$cantidad_x_presentacion?>">
				<?php echo form_error('cantidad_x_presentacion'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('precio_costo')){ echo 'has-error'; } ?>">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Precio costo:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="precio_costo" name="precio_costo" required="required" class="form-control col-md-7 col-xs-12" value="<?=$precio_costo?>">
				<?php echo form_error('precio_costo'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('precio_venta')){ echo 'has-error'; } ?>">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Precio venta:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="precio_venta" name="precio_venta" required="required" class="form-control col-md-7 col-xs-12" value="<?=$precio_venta?>">
				<?php echo form_error('precio_venta'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('descripcion')){ echo 'has-error'; } ?>">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="descripcion" name="descripcion" required="required" class="form-control col-md-7 col-xs-12" value="<?=$descripcion?>">
				<?php echo form_error('descripcion'); ?>
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
