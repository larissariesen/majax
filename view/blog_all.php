<article class="hreview open special">
    <?php if (empty($blogs)): ?>
        <div class="dhd">
            <h2 class="item title">Oops! No Blogs were found.</h2>
        </div>
    <?php else: ?>
        <?php foreach ($blogs as $blog): ?>
            <div class="panel panel-default">
                <div class="panel-heading" name="title"><?= $blog->Titel;?> <?= $blog->Index;?></div>
                <div class="panel-body">
                    <div class="User">

                    </div>
                    <p class="description" name="content">Now this is a story all about how my life got turned up side down. </p>
                    <p>
                        <?php if ($_SESSION[Security::SESSION_USER]->firstName ==  $blog->lastName) :?>
                        <a title="Löschen" href="/user/delete?id=<?= $blog->id ?>">Delete Blog</a>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</article>