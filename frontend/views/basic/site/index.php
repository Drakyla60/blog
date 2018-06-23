<?php

/* @var $this yii\web\View */
/* @var $blogs common\models\BlogTags */

$this->title = 'Frontend';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Frontend</h1>
        <?php foreach ($blogs as $blog):?>
        <p class="lead"><?=$blog->name?></p>
        <?php endforeach;?>
        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <ul class="blog-posts">
        <li class="post-item">
            <article class="entry">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="entry-thumb image-hover2"> <a href="single_post.html">
                                <figure><img src="images/blog-img1.jpg" alt="Blog"></figure>
                            </a> </div>
                    </div>
                    <div class="col-sm-7">
                        <h3 class="entry-title"><a href="single_post.html">Aliquam Et Metus Pharetra, Bibendum Massa</a></h3>
                        <div class="entry-meta-data"> <span class="author"> <i class="fa fa-user"></i>&nbsp; by: <a href="#">Admin</a></span> <span class="cat"> <i class="fa fa-folder"></i>&nbsp; <a href="#">News, </a> <a href="#">Promotions</a> </span> <span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; 3 </span> <span class="date"><i class="fa fa-calendar"></i>&nbsp; 2015-08-05</span> </div>
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                        <div class="entry-excerpt">Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus. Praesent Ornare Tortor Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus.</div>
                        <div class="entry-more"> <a href="#" class="button">Read more&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
                    </div>
                </div>
            </article>
        </li>
        <li class="post-item wow fadeInUp">
            <article class="entry">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="entry-thumb image-hover2"> <a href="single_post.html">
                                <figure><img src="images/blog-img2.jpg" alt="Blog"></figure>
                            </a> </div>
                    </div>
                    <div class="col-sm-7">
                        <h3 class="entry-title"><a href="single_post.html">Aliquam Et Metus Pharetra, Bibendum Massa</a></h3>
                        <div class="entry-meta-data"> <span class="author"> <i class="fa fa-user"></i>&nbsp; by: <a href="#">Admin</a></span> <span class="cat"> <i class="fa fa-folder"></i>&nbsp; <a href="#">News, </a> <a href="#">Promotions</a> </span> <span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; 3 </span> <span class="date"><i class="fa fa-calendar"></i>&nbsp; 2015-08-05</span> </div>
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                        <div class="entry-excerpt">Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus. Praesent Ornare Tortor Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus.</div>
                        <div class="entry-more"> <a href="#" class="button">Read more&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
                    </div>
                </div>
            </article>
        </li>
        <li class="post-item wow fadeInUp">
            <article class="entry">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="entry-thumb image-hover2"> <a href="single_post.html">
                                <figure><img src="images/blog-img3.jpg" alt="Blog"></figure>
                            </a> </div>
                    </div>
                    <div class="col-sm-7">
                        <h3 class="entry-title"><a href="single_post.html">Aliquam Et Metus Pharetra, Bibendum Massa</a></h3>
                        <div class="entry-meta-data"> <span class="author"> <i class="fa fa-user"></i>&nbsp; by: <a href="#">Admin</a></span> <span class="cat"> <i class="fa fa-folder"></i>&nbsp; <a href="#">News, </a> <a href="#">Promotions</a> </span> <span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; 3 </span> <span class="date"><i class="fa fa-calendar"></i>&nbsp; 2015-08-05</span> </div>
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                        <div class="entry-excerpt">Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus. Praesent Ornare Tortor Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus.</div>
                        <div class="entry-more"> <a href="#" class="button">Read more&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
                    </div>
                </div>
            </article>
        </li>
        <li class="post-item wow fadeInUp">
            <article class="entry">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="entry-thumb image-hover2"> <a href="single_post.html">
                                <figure><img src="images/blog-img4.jpg" alt="Blog"></figure>
                            </a> </div>
                    </div>
                    <div class="col-sm-7">
                        <h3 class="entry-title"><a href="single_post.html">Aliquam Et Metus Pharetra, Bibendum Massa</a></h3>
                        <div class="entry-meta-data"> <span class="author"> <i class="fa fa-user"></i>&nbsp; by: <a href="#">Admin</a></span> <span class="cat"> <i class="fa fa-folder"></i>&nbsp; <a href="#">News, </a> <a href="#">Promotions</a> </span> <span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; 3 </span> <span class="date"><i class="fa fa-calendar"></i>&nbsp; 2015-08-05</span> </div>
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                        <div class="entry-excerpt">Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus. Praesent Ornare Tortor Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus.</div>
                        <div class="entry-more"> <a href="#" class="button">Read more&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
                    </div>
                </div>
            </article>
        </li>
        <li class="post-item wow fadeInUp">
            <article class="entry">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="entry-thumb image-hover2"> <a href="single_post.html">
                                <figure><img src="images/blog-img5.jpg" alt="Blog"></figure>
                            </a> </div>
                    </div>
                    <div class="col-sm-7">
                        <h3 class="entry-title"><a href="single_post.html">Aliquam Et Metus Pharetra, Bibendum Massa</a></h3>
                        <div class="entry-meta-data"> <span class="author"> <i class="fa fa-user"></i>&nbsp; by: <a href="#">Admin</a></span> <span class="cat"> <i class="fa fa-folder"></i>&nbsp; <a href="#">News, </a> <a href="#">Promotions</a> </span> <span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; 3 </span> <span class="date"><i class="fa fa-calendar"></i>&nbsp; 2015-08-05</span> </div>
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                        <div class="entry-excerpt">Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus. Praesent Ornare Tortor Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus.</div>
                        <div class="entry-more"> <a href="#" class="button">Read more&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
                    </div>
                </div>
            </article>
        </li>
        <li class="post-item wow fadeInUp">
            <article class="entry">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="entry-thumb image-hover2"> <a href="single_post.html">
                                <figure><img src="images/blog-img6.jpg" alt="Blog"></figure>
                            </a> </div>
                    </div>
                    <div class="col-sm-7">
                        <h3 class="entry-title"><a href="single_post.html">Aliquam Et Metus Pharetra, Bibendum Massa</a></h3>
                        <div class="entry-meta-data"> <span class="author"> <i class="fa fa-user"></i>&nbsp; by: <a href="#">Admin</a></span> <span class="cat"> <i class="fa fa-folder"></i>&nbsp; <a href="#">News, </a> <a href="#">Promotions</a> </span> <span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; 3 </span> <span class="date"><i class="fa fa-calendar"></i>&nbsp; 2015-08-05</span> </div>
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                        <div class="entry-excerpt">Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus. Praesent Ornare Tortor Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus.</div>
                        <div class="entry-more"> <a href="#" class="button">Read more&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
                    </div>
                </div>
            </article>
        </li>
        <li class="post-item wow fadeInUp">
            <article class="entry">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="entry-thumb image-hover2"> <a href="single_post.html">
                                <figure><img src="images/blog-img7.jpg" alt="Blog"></figure>
                            </a> </div>
                    </div>
                    <div class="col-sm-7">
                        <h3 class="entry-title"><a href="single_post.html">Aliquam Et Metus Pharetra, Bibendum Massa</a></h3>
                        <div class="entry-meta-data"> <span class="author"> <i class="fa fa-user"></i>&nbsp; by: <a href="#">Admin</a></span> <span class="cat"> <i class="fa fa-folder"></i>&nbsp; <a href="#">News, </a> <a href="#">Promotions</a> </span> <span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; 3 </span> <span class="date"><i class="fa fa-calendar"></i>&nbsp; 2015-08-05</span> </div>
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                        <div class="entry-excerpt">Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus. Praesent Ornare Tortor Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus.</div>
                        <div class="entry-more"> <a href="#" class="button">Read more&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
                    </div>
                </div>
            </article>
        </li>
    </ul>
</div>
