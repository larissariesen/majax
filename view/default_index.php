<?php if (Security::isAuthenticated()) : ?>

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
                <div class="panel-heading" name="title"><?= $blog->title;
                    echo ' - ';
                    echo $blog->user->email; ?>
                    <img onclick="" border="0" alt="delete" src="/images/del.png" width="20" height="20" style="float: right; margin-left: 10px;">
                    <a href="blog_edit.php">
                        <img border="0" alt="edit" src="/images/edit.png" width="20" height="20" style="float: right">
                    </a>
                </div>
                <div class="panel-body">
                    <?php if ($blog->image_path == NULL): ?>
                        <p></p>
                    <?php else: ?>
                        <img src="/uploads/<?php echo $blog->id;
                        echo $blog->image_path ?>" alt="image"/>
                        <div class="User">
                        </div>
                    <?php endif ?>
                    <?= $blog->content; ?>

                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</article>