<?= $this->extend('layouts/login_layout.php'); ?>
<?= $this->section('content'); ?>

<section class="login-section">
	<div class="left-section">
		<div class="logo-text"><a href="<?php echo base_url()?>"><img src="<?= base_url('public/images/adani-renewables.png'); ?>" style="margin:0.15cm 0.2cm;float:right;" width="" height="66"></a></div>
		<div class="center-section d-flex align-items-center justify-content-center">
			<form method="post" id="long_master" action="<?= url_to('logininsert.download');?>" class="form-section">
				
				<div class="title">Sign in to Account</div>
				<?php if(session()->getFlashdata('contact_admin')==1){
				?>
				<h6 style="color:#f33923">Please contact admin.</h6>
				<?php } session()->remove('contact_admin');
				if(session()->getFlashdata('wrong_username')==1){
				?>
				<h6 style="color:#f33923">Wrong Username.</h6>
				<?php } session()->remove('wrong_username');
				if(session()->getFlashdata('username_empty')==1){
				?>
				<h6 style="color:#f33923">Username can't be empty.</h6>
				<?php } session()->remove('username_empty');
				if(session()->getFlashdata('both_empty')==1){
					?>
					<h6 style="color:#f33923">Username and Password can't be empty.</h6>
					<?php } session()->remove('both_empty');
				?>
				
				<div class="form-group">
					<label class="label">Username</label>
					<input type="text" class="form-control" id="name" name="username" placeholder="Username">
					<span class="form-note">Your unique user name to login</span>
				</div>
				<div class="form-group">
					<label class="label">Password</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Password">
					<span class="form-note">Your strong password</span>
				</div>
				<div class="d-flex align-items-center justify-content-between">
					<div class="checkbox-group">
						<input id="rememberme" type="checkbox" class="checkbox-control">
						<label for="rememberme" class="label">Remember Me</label>
					</div>

					<div class="form-group mb-none">
						<button type="submit" id="submit" name="signIn" class="btn btn-primary">Login</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="right-section">
		<div class="center-section d-flex align-items-center justify-content-center">
			<div class="">
				<h2 class="login-title">N-Compas </h2>
				<p class="login-info-new">(All Encompassing Competency Management System) </p>
				<p class="login-info">Welcome to N-Compas, your complete IT solutions for managing effectively all the aspects of competency mapping, assessment and development process. </p>
			</div>
		</div>
	</div>
</section>

<?= $this->endsection(); ?>