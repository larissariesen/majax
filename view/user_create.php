<!-- Form for register-->
<form class="form-horizontal" action="/user/create" method="post">
	<div class="component" data-html="true">

        <!-- Firstname-->
		<div class="form-group">
		  <label class="col-md-2 control-label" for="firstName">First Name</label>
		  <div class="col-md-4">
		  	<input id="firstName" name="firstName" type="text" placeholder="First Name" class="form-control input-md" value="<?= (!empty($_POST['firstName'])) ? $_POST['firstName'] : "" ?>"> <!-- to keep the Firstname if there's an error -->
		  </div>
		</div>

        <!-- Lastname-->
		<div class="form-group">
		  <label class="col-md-2 control-label" for="lastName">Last Name</label>
		  <div class="col-md-4">
		  	<input id="lastName" name="lastName" type="text" placeholder="Last Name" class="form-control input-md" value="<?= (!empty($_POST['lastName'])) ? $_POST['lastName'] : "" ?>"> <!-- to keep Lastname if there's an error -->
		  </div>
		</div>

        <!-- Email/Username-->
		<div class="form-group">
		  <label class="col-md-2 control-label" for="email">E-Mail*</label>
		  <div class="col-md-4">
		  	<input id="email" name="email" type="text" placeholder="E-Mail" required class="form-control input-md" value="<?= (!empty($_POST['email'])) ? $_POST['email'] : "" ?>"> <!-- to keep email/username if there's an error -->
              <?= Error::get('user_create_email') ?>
		  </div>
		</div>

        <!-- Password-->
		<div class="form-group">
		  <label class="col-md-2 control-label" for="password">Password*</label>
		  <div class="col-md-4">
		  	<input id="password" name="password" type="password" placeholder="Password" required class="form-control input-md">
              <?= Error::get('user_create_password') ?>
		  </div>
        </div>
        <!-- Submitbutton-->
        <div class="form-group">
	      <label class="col-md-2 control-label" for="send">&nbsp;</label>
		  <div class="col-md-4">
		    <input id="send" name="send" type="submit" value="Submit" class="btn btn-primary">
		  </div>
		</div>
	</div>
</form>