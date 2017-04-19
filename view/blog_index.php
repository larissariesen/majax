<article class="hreview open special">
    <?php if (empty($blogs)): ?>
        <div class="dhd">
            <h2 class="item title">Oops! No Blogs were found.</h2>
        </div>
    <?php else: ?>
        <?php foreach ($blogs as $blog): ?>
            <div class="panel panel-default">
                <div class="panel-heading" name="title"><?= $blog->title;?></div>
                <div class="panel-body"><?= $blog->content;?>
                    <div class="User">
                        <?= $blog->user->firstName ?>
                    </div>
                    <p class="description" name="content"></p>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</article>