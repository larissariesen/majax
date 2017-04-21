<!-- First- & Lastname current user-->
<?php if (Security::isAuthenticated()) : ?>
    <h3>Hello <?= $_SESSION[Security::SESSION_USER]->firstName, " ", $_SESSION[Security::SESSION_USER]->lastName; ?></h3>
<?php endif; ?>

<article class="hreview open special">
    <!-- if there aren't any blogs-->
    <?php if (empty($blogs)): ?>
        <div class="dhd">
            <h2 class="item title">Oops! No Blogs were found.</h2>
        </div>
    <?php else: ?>
        <!-- show all blogs-->
        <?php foreach ($blogs as $blog): ?>
            <div class="panel panel-default">
                <div class="panel-heading" name="title"><?= $blog->title; ?> - <?= (!empty($blog->user)) ? $blog->user->email : "USER DELETED"; ?>
                    <img src="images/panda.png" style="float: right; height: 22px">
                </div>
                <div class="panel-body">
                    <!-- Handling Image -->
                    <?php if ($blog->image_path == NULL): ?>
                        <p></p>
                    <?php else: ?>
                        <img src="/uploads/<?php echo $blog->id;
                        echo $blog->image_path ?>" alt="image"/>
                    <?php endif ?>
                </br></br>
                    <?= $blog->content; ?>

                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</article>