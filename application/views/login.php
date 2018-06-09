<?php $attributes = array("role"=>"form", "id" => "form-login", "name" => "form-login"); ?>
<?=form_open(base_url().'Login/acceso',$attributes)?>
<?=form_hidden('token',$token)?>
	<h1><img src="<?=base_url().'assets/images/logo.png'?>" width="70%" ><br /><br />Iniciar sesión</h1>
	<div>
		<input type="text" class="form-control" name="usuario" placeholder="Correo" required="" />
	</div>
	<div>
		<input type="password" class="form-control" name="pass" placeholder="Contraseña" required="" />
	</div>
	<div style="text-align:right;">
		<img src="<?=base_url().'assets/images/logoDabiaani.png'?>" width="20%" >&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">Ingresar</button>
	</div>
	<div class="clearfix"></div>
<?=form_close()?>
<?php if($this->session->flashdata('error')){ ?>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
	<strong>Error!</strong> Datos de acceso incorrectos.
</div>
<?php } ?>
<div>
</div>
