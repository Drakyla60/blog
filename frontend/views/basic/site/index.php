<?php

/* @var $this yii\web\View */

$this->title = 'Frontend';
?>

<div class="col-md-9">
    <ul class="blog-posts">
            <h3 class="entry-title">JKJ</h3>
        <li class="post-item">
            <article class="entry">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="entry-thumb image-hover2 responsive"> <a href="single_post.html">
                                <figure><img src="blog/images/post/10.jpg" alt="Blog"></figure>
                            </a> </div>
                    </div>
                    <div class="col-sm-7">
                        <h3 class="entry-title"><a href="single_post.html">Aliquam Et Metus Pharetra, Bibendum Massa</a></h3>
                        <div class="entry-meta-data">
                            <span class="author"><i class="fa fa-user"></i>&nbsp; by: <a href="#">Admin</a></span>
                            <span class="cat"> <i class="fa fa-folder"></i>&nbsp;
                            </span>
                            <span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; 3 </span>
                            <span class="date"><i class="fa fa-calendar"></i>&nbsp; 2015-08-05</span>
                        </div>
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                        <div class="entry-excerpt">Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus. Praesent Ornare Tortor Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus.</div>
                        <div class="entry-more"> <a href="#" class="button">Read more&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
                    </div>
                </div>
            </article>
        </li>
    </ul>
</div>
<div class="col-lg-3">
    <ul class="blog-posts">
        <h3 class="entry-title">JKJ</h3>
        <ul class="post-item table table-bordered">
            <li class="post-header-absolute">Перший</li>
            <li class="post-header-absolute">Другий</li>
            <li class="post-header-absolute">Перший</li>
            <li class="post-header-absolute">Другий</li>
            <li class="post-header-absolute">Перший</li>
            <li class="post-header-absolute">Другий</li>
        </ul>
    </ul>
</div>
<div class="row">
    <div class="col-lg-9">
        <div class="container">
                <pre>
            <code>
                public function actionLogin()
                {
                    if (!Yii::$app->user->isGuest) {
                        return $this->goHome();
                    }

                    $model = new LoginForm();

                    if ($model->load(Yii::$app->request->post()) && $model->login()) {
                        return $this->goBack();
                    }

                    $model->password = '';

                    return $this->render('login', [
                        'model' => $model,
                    ]);

                }
            </code>
                </pre>
        </div>
    </div>
</div>

