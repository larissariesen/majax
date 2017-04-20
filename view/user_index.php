<?php if (Security::isAuthenticated()) : ?>

    Hello <?= $_SESSION[Security::SESSION_USER]->firstName && $_SESSION[Security::SESSION_USER]->lastName; ?>

<?php else : ?>
    <form class="form-horizontal" action="/user" method="post">
        <div class="component" data-html="true">
            <div class="form-group">
                <label class="col-md-2 control-label" for="username">Username</label>
                <div class="col-md-4">
                    <input id="username" name="username" type="text" placeholder="E-mail" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="password">Password</label>
                <div class="col-md-4">
                    <input id="password" name="password" type="password" placeholder="Password"
                           class="form-control input-md">
                    <?= Error::get('user_login');  ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="login">&nbsp;</label>
                <div class="col-md-4">
                    <input id="login" name="login" type="submit" value="Submit" class="btn btn-primary">
                </div>
            </div>
        </div>
    </form>
<?php endif; ?>