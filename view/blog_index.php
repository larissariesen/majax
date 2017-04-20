<article class="hreview open special">
    <?php if (empty($blogs)): ?>
        <div class="dhd">
            <h2 class="item title">Oops! No Blogs were found.</h2>
        </div>
    <?php else: ?>

        <div id="profile">
            <div id="style">
            <div>
               <img id="pandapanda" src="../images/logo.png">
            </div>
                <!--<h2>Name: <?= //UserController:: ?></h2>-->
            </div>
        </div>

        <?php foreach ($blogs as $blog): ?>
            <div class="panel panel-default">
                <div class="panel-heading" name="title"><?= $blog->title; ?>
                    - <?= (isset($blog->user)) ? $blog->user->email : ""; ?>
                    <a id="del" href="/blog/delete?id=<?= $blog->id ?>">
                        <img border="0" alt="delete" src="/images/del.png" width="20" height="20"
                             style="float: right; margin-left: 20px;">
                    </a>
                    <a href="/blog/edit?id=<?= $blog->id ?>">
                        <img border="0" alt="edit" src="/images/edit.png" width="20" height="20" style="float: right">
                    </a>
                </div>
                <div class="panel-body">
                    <?php if ($blog->image_path == NULL): ?>
                        <p></p>
                    <?php else: ?>
                        <img src="/uploads/<?= $blog->id . $blog->image_path ?>" alt="image"/>
                        <div class="User">
                        </div>
                    <?php endif ?>
                    <?= $blog->content; ?>

                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</article>