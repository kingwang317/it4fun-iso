<!-- Login -->
<div id="login" class="main_width none">
<div class="close"></div>
<div class="log_mv">
<form method="POST" action="<?php echo site_url() ?>fuel/login">
	<input name="user_name" type="text" placeholder="Username" class="inp"/>
	<input name="password" type="text" placeholder="Password" class="inp pass"/>
	<input name="check" type="checkbox" value="" class="check" id="c1"/>
	<label for="c1"><span class="ck_s"></span></label>
	<input type="submit" name="submit" value="" id="send" >
</form>
</div>
</div>
<!-- Top -->
<div id="top" class="main_width">
<img src="<?php echo site_url() ?>assets/templates/images/logo_new.png" class="logo left"/> 
<?php $valid_user = $this->fuel->auth->valid_user(); 

if(isset($valid_user) && $valid_user['id'] != 0){

	//print_r($valid_user);
?>
<a href="<?php echo site_url() ?>fuel/dashboard" class="login_name right">Hi <?php echo $valid_user['user_name'] ?></a>
<?php  
}else{
?>
<a href="#" class="login right">登入</a>
<?php  
}
?>
</div>
