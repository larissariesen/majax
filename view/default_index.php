<?php if (Security::isAuthenticated()) : ?>

    You are logged in!<br>
    Hello <?= $_SESSION[Security::SESSION_USER]->firstName, " ", $_SESSION[Security::SESSION_USER]->lastName; ?><br><br>

<?php endif; ?>
<?php

?>
<article class="hreview open special">
    <?php if (empty($blogs)): ?>
    <div class="dhd">
        <h2 class="item title">Oops! No Blogs were found.</h2>
    </div>
<?php else: ?>
    <?php foreach ($blogs as $blog): ?>
        <div class="panel panel-default">
            <div class="panel-heading" name="title"><?= $blog->title;?></div>
            <div class="panel-body">
                <image class="Image" width="auto">
                    <?= $blog->user->firstName ?>
                </image>
                <?= $blog->content;?>
                <div class="User">
                    <?= $blog->user->email ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>
</article>