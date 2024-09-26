<section class="login-section">
	<div class="left-section">
		<div class="logo-text"><img src="<?php echo BASE_URL; ?>/public/images/coromandel.png" style="margin:0.15cm 0.2cm;float:right;" width="176" height="66"></div>
		<div class="center-section d-flex align-items-center justify-content-center">
			<form method="post" id="long_master" action="<?php echo base_url()?>index/login_insert_otp" class="form-section">
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $uid; ?>">
				<div class="title">Confirmation</div>
				<?php if($this->session->userdata('mobotp')==1){
				?>
				<h6 style="color:#f33923">Mobile Otp is wrong.</h6>
				<?php } $this->session->unset_userdata('mobotp');
				if($this->session->userdata('emailotp')==1){
				?>
				<h6 style="color:#f33923">Email Otp is wrong.</h6>
				<?php } $this->session->unset_userdata('emailotp');
				if($this->session->userdata('otp_empty')==1){
				?>
				<h6 style="color:#f33923">OTPs can't be empty.</h6>
				<?php } $this->session->unset_userdata('otp_empty');
				?>
				<?php 
				$num = $user_info['office_number'];
				$maskedPhone = substr($num, 0, 2) . "******" . substr($num, 7, 4);
				?>
				<div class="form-group">
					<label class="label">Mobile/Email OTP</label>
					<input type="text" class="form-control" id="mob_otp" name="mob_otp" placeholder="OTP">
					<span class="form-note">OTP is sent to your Mobile Number and Email:<?php echo $maskedPhone; ?>/<?php echo $user_info['email']; ?></span>
				</div>
				<!--<div class="form-group">
					<label class="label">Email OTP</label>
					<input type="text" name="email_otp" id="email_otp" class="form-control" placeholder="Email OTP">
					<span class="form-note">OTP has been sent to Id:<?php echo $user_info['email']; ?></span>
				</div>-->
				<div class="d-flex align-items-center justify-content-between">
					<div class="form-group mb-none">
						<button type="submit" id="submit" name="signIn" class="btn btn-primary">Confirm</button>
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