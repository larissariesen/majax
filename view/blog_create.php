<form class="form-horizontal" action="/blog/doCreate" method="post" enctype="multipart/form-data">
    <div class="component" data-html="true">
        <div class="form-group">
            <label class="col-md-2 control-label" for="title">Blog Title</label>
            <div class="col-md-4">
                <input id="title" name="title" type="text" placeholder="Title" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="content" >Content</label>
            <div class="col-md-4">
                <textarea id="content" name="content" placeholder="Content" class="form-control input-md"></textarea>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label" for="image_path">Image</label>
            <div class="col-md-4">
                <input id="image_path" name="image_path" type="file" class="form-control input-md">
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label" for="send">&nbsp;</label>
            <div class="col-md-4">
                <input id="send" name="send" type="submit" class="btn btn-primary" value="Submit">
            </div>
        </div>
    </div>
</form>