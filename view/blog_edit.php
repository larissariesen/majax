<!-- get blog_id/title/content to edit the right blog -->
<form class="form-horizontal" action="/blog/doEdit?id=<?= $blog->id ?>" method="post" enctype="multipart/form-data">
    <div class="component" data-html="true">
        <!-- Title -->
        <div class="form-group">
            <label class="col-md-2 control-label" for="title">Blog Title</label>
            <div class="col-md-4">
                <input id="title" name="title" type="text" placeholder="Title" class="form-control input-md" required value="<?= $blog->title ?>">
            </div>
        </div>
        <!-- Content-->
        <div class="form-group">
            <label class="col-md-2 control-label" for="content" >Content</label>
            <div class="col-md-4">
                <textarea id="content" name="content" placeholder="Content" class="form-control input-md"><?= $blog->content ?></textarea>
            </div>
        </div>
        <!-- Submit Button-->
        <div class="form-group">
            <label class="col-md-2 control-label" for="edit">&nbsp;</label>
            <div class="col-md-4">
                <input id="edit" name="edit" type="submit" class="btn btn-primary" value="Update">
            </div>
        </div>
    </div>
</form>