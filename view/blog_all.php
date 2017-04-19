<article class="hreview open special">
    <?php if (empty($blogs)): ?>
        <div class="dhd">
            <h2 class="item title">Hoopla! Keine Blogs gefunden.</h2>
        </div>
    <?php else: ?>
        <?php foreach ($blogs as $blog): ?>
            <div class="panel panel-default">
                <div class="panel-heading"><?= $blog->Titel;?> <?= $blog->Index;?></div>
                <div class="panel-body">
                    <p class="description">In der Datenbank existiert ein User mit dem Namen <?= $blog->firstName;?> <?= $blog->lastName;?>. Dieser hat die EMail-Adresse: <a href="mailto:<?= $blog->email;?>"><?= $blog->email;?></a></p>
                    <p>
                        <a title="Löschen" href="/user/delete?id=<?= $blog->id ?>">Löschen</a>
                    </p>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</article>