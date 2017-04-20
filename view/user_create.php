<form class="form-horizontal" action="/user/create" method="post">
	<div class="component" data-html="true">
		<div class="form-group">
		  <label class="col-md-2 control-label" for="firstName">First Name</label>
		  <div class="col-md-4">
		  	<input id="firstName" name="firstName" type="text" placeholder="First Name" class="form-control input-md">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="lastName">Last Name</label>
		  <div class="col-md-4">
		  	<input id="lastName" name="lastName" type="text" placeholder="Last Name" class="form-control input-md">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="email">E-Mail*</label>
		  <div class="col-md-4">
		  	<input id="email" name="email" type="text" placeholder="E-Mail" required class="form-control input-md">
              <?= Error::get('user_create_email') ?>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="password">Password*</label>
		  <div class="col-md-4">
		  	<input id="password" name="password" type="password" placeholder="Password" required class="form-control input-md">
              <?= Error::get('user_create_password') ?>
		  </div>
		</div>
		<div class="form-group">
	      <label class="col-md-2 control-label" for="send">&nbsp;</label>
		  <div class="col-md-4">
		    <input id="send" name="send" type="submit" value="Submit" class="btn btn-primary">
		  </div>
		</div>
	</div>
</form>
