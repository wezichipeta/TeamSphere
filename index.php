<?php require_once('header.php'); ?>

<?php if (is_user_logged_in()): ?>
    <!-- Logged in -->
    <div class="row">
        <div class="col-md-8 offset-md-2">
        <div class="box box-widget">
            <div class="box-header with-border">
            <div class="user-block">
                <img class="img-circle" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User Image">
                <span class="username"><a href="#">John Breakgrow jr.</a></span>
                <span class="description">Shared publicly - 3:30 PM Today</span>
            </div>
            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read">
                <i class="fa fa-circle-o"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            </div>

            <div class="box-body" style="display: block;">
            <img class="img-responsive pad" src="resources/images/camping.jpg" alt="Photo">
            <p>I took this photo this morning. What do you guys think?</p>
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
            <span class="pull-right text-muted">27 likes - 2 comments</span>
            </div>
            <div class="box-footer box-comments" style="display: block;">
            <div class="box-comment">
                <img class="img-circle img-sm" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User Image">
                <div class="comment-text">
                <span class="username">
                Mario Gonzales
                <span class="text-muted pull-right">4:33 PM Today</span>
                </span>
                Wow, so beautiful!
                </div>
            </div>

            <div class="box-comment">
                <img class="img-circle img-sm" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="User Image">
                <div class="comment-text">
                <span class="username">
                Luna Stark
                <span class="text-muted pull-right">5:03 PM Today</span>
                </span>
                Where did you take this picture?
                </div>
            </div>
            </div>
            <div class="box-footer" style="display: block;">
            <form action="#" method="post">
                <img class="img-responsive img-circle img-sm" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Alt Text">
                <div class="img-push">
                <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                </div>
            </form>
            </div>
        </div>
        </div>
        </div>
    </div>
<?php else: ?>
    <!-- Not logged in, show sunrise -->
    <div class="row">
        <div class="col-md-10 offset-md-1 align-self-center mt-3">
            <img src="resources/images/sunrise.jpg" alt="sunrise" class="home_image" />
        </div>
    </div>
<?php endif; ?>

<?php require_once('footer.php'); ?>