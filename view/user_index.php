<!-- Form for Login -->
    <form class="form-horizontal" action="/user" method="post">

        <div class="component" data-html="true">


            <!-- Usernameinpur -->
            <div class="form-group">
                <label class="col-md-2 control-label" for="username">Username</label>
                <div class="col-md-4">
                    <input id="username" name="username" type="text" placeholder="E-mail" class="form-control input-md" value="<?= (!empty($_POST['username'])) ? $_POST['username'] : "" ?>">  <!-- to keep username if there's an error -->
                </div>
            </div>

            <!-- Passwordinput-->
            <div class="form-group">
                <label class="col-md-2 control-label" for="password">Password</label>
                <div class="col-md-4">
                    <input id="password" name="password" type="password" placeholder="Password"
                           class="form-control input-md">
                    <!-- Errormessage -->
                    <?= Error::get('user_login');  ?>
                </div>
            </div>
            <!-- Submitbutton-->
            <div class="form-group">
                <label class="col-md-2 control-label" for="login">&nbsp;</label>
                <div class="col-md-4">
                    <input id="login" name="login" type="submit" value="Submit" class="btn btn-primary">
                    <?php if(Success::hasSuccess()) : ?>
                        <div id="messages">
                            <?= Success::get("create_success") ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </form><p></p>
