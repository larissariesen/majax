<?php if (Security::isAuthenticated()) : ?>

    You are logged in!<br>
    Hello <?= $_SESSION[Security::SESSION_USER]->firstName, " ", $_SESSION[Security::SESSION_USER]->lastName; ?><br><br>

<?php endif; ?>
<?php



?>

<?php foreach ($blogs as $blog): ?>
    <div class="panel panel-default">
        <div class="panel-heading" name="title"><?= $blog->title; ?></div>
        <div class="panel-body"><?= $blog->content; ?>
            <div class="User">
                <?= $blog->user->firstName ?>
            </div>
            <p class="description" name="content"></p>
        </div>
    </div>
<?php endforeach ?>