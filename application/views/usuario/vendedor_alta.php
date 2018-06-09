<?php defined('BASEPATH') OR exit('No direct script access allowed');
$attributes = array("role"=>"form", "id" => "registrar_usuario", "name" => "registrar_usuario", "class" => "form-horizontal form-label-left");
if(isset($registro)){ $ligaUrl = base_url().'usuario/UsuarioAlta/guardaUsuario/'.$registro; }else{ $ligaUrl = base_url().'usuario/UsuarioAlta/guardaUsuario'; }
?>
<div class="x_title">
	<h2><?=(isset($registro)) ? "Editar" : "Registrar"?> Vendedor</h2>
</div>
<div class="clear"></div>

<div class="x_content">
	<?=form_open_multipart($ligaUrl,$attributes)?>
		<input type="hidden" name="liga" id="liga" value="<?=base_url()?>">
		<div class="form-group <?php if(form_error('nombre')){ echo 'has-error'; } ?>">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12" value="<?=$nombre?>">
				<?php echo form_error('perfil'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('apellido')){ echo 'has-error'; } ?>">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="apellido" name="apellido" required="required" class="form-control col-md-7 col-xs-12" value="<?=$apellido?>">
				<?php echo form_error('apellido'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('correo')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Correo</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input id="correo" name="correo" class="form-control col-md-7 col-xs-12" type="text" value="<?=$correo?>">
				<?php echo form_error('correo'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('telefono')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Celular</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input id="telefono" name="telefono" class="form-control col-md-7 col-xs-12" type="text" value="<?=$telefono?>">
				<?php echo form_error('telefono'); ?>
			</div>
		</div>
		<input type="hidden" name="perfil" id="perfil" value="2">
		<div class="form-group <?php if(form_error('estado')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estado:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select name="estado" id="estado" estadoAttri='<?=$municipio?>' class="form-control col-md-7 col-xs-12" required="required">
					<option value="">Seleccione</option>
					<?php foreach($estados->result() as $info):?>
					<option value="<?=$info->estado?>" <?=empty($estado) ? "" : ($estado == $info->estado) ? "selected" : ""?> ><?=$info->estado?></option>
					<?php endforeach; ?>
				</select><span id="Buscando"></span>
				<?php echo form_error('estado'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('municipio')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Municipio:</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select name="municipio" id="municipio" class="form-control col-md-7 col-xs-12" required="required">
					<option value="">Seleccione</option>
				</select>
				<?php echo form_error('municipio'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('venta_diaria')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Venta diaria (número de chips)</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input id="venta_diaria" name="venta_diaria" class="form-control col-md-7 col-xs-12" type="text" maxlength="3" value="<?=$venta_diaria?>">
				<?php echo form_error('venta_diaria'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('pass')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input id="pass" name="pass" class="form-control col-md-7 col-xs-12" type="password">
				<?php echo form_error('pass'); ?>
			</div>
		</div>
		<div class="form-group <?php if(form_error('pass1')){ echo 'has-error'; } ?>">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar Contraseña</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input id="pass1" name="pass1" class="form-control col-md-7 col-xs-12" type="password">
				<?php echo form_error('pass1'); ?>
			</div>
		</div>
		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				<button type="submit" class="btn btn-success">Guardar</button>
				<a class="btn btn-default" href="<?=base_url().'vendedores'?>">Cancelar</a>
			</div>
		</div>
	<?=form_close()?>
</div>