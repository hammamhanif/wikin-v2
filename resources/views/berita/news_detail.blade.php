@extends('tamplate.landingpage.main')

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Blog Details</h2>
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li>Blog Details</li>
                    </ol>
                </div>

            </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Blog Details Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row g-5">

                    <div class="col-lg-12">

                        <article class="blog-details">

                            <div class="post-img">
                                <img src="{{ asset('img/blog/blog-1.jpg') }}" alt="" class="img-fluid">
                            </div>

                            <h2 class="title">Dolorum optio tempore voluptas dignissimos cumque fuga qui quibusdam quia
                            </h2>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                            href="blog-details.html">John Doe</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                            href="blog-details.html"><time datetime="2020-01-01">Jan 1, 2022</time></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                            href="blog-details.html">12 Comments</a></li>
                                </ul>
                            </div><!-- End meta top -->

                            <div class="content">
                                <p>
                                    Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi
                                    praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                                    Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est
                                    cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis
                                    dolore.
                                </p>

                                <p>
                                    Sit repellat hic cupiditate hic ut nemo. Quis nihil sunt non reiciendis. Sequi in
                                    accusamus harum vel aspernatur. Excepturi numquam nihil cumque odio. Et voluptate
                                    cupiditate.
                                </p>

                                <p>
                                    Sed quo laboriosam qui architecto. Occaecati repellendus omnis dicta inventore tempore
                                    provident voluptas mollitia aliquid. Id repellendus quia. Asperiores nihil magni dicta
                                    est suscipit perspiciatis. Voluptate ex rerum assumenda dolores nihil quaerat.
                                    Dolor porro tempora et quibusdam voluptas. Beatae aut at ad qui tempore corrupti velit
                                    quisquam rerum. Omnis dolorum exercitationem harum qui qui blanditiis neque.
                                    Iusto autem itaque. Repudiandae hic quae aspernatur ea neque qui. Architecto voluptatem
                                    magni. Vel magnam quod et tempora deleniti error rerum nihil tempora.
                                </p>

                                <h3>Et quae iure vel ut odit alias.</h3>
                                <p>
                                    Officiis animi maxime nulla quo et harum eum quis a. Sit hic in qui quos fugit ut rerum
                                    atque. Optio provident dolores atque voluptatem rem excepturi molestiae qui. Voluptatem
                                    laborum omnis ullam quibusdam perspiciatis nulla nostrum. Voluptatum est libero eum
                                    nesciunt aliquid qui.
                                    Quia et suscipit non sequi. Maxime sed odit. Beatae nesciunt nesciunt accusamus quia aut
                                    ratione aspernatur dolor. Sint harum eveniet dicta exercitationem minima. Exercitationem
                                    omnis asperiores natus aperiam dolor consequatur id ex sed. Quibusdam rerum dolores sint
                                    consequatur quidem ea.
                                    Beatae minima sunt libero soluta sapiente in rem assumenda. Et qui odit voluptatem. Cum
                                    quibusdam voluptatem voluptatem accusamus mollitia aut atque aut.
                                </p>
                                <img src="assets/img/blog/blog-inside-post.jpg" class="img-fluid" alt="">

                                <h3>Ut repellat blanditiis est dolore sunt dolorum quae.</h3>
                                <p>
                                    Rerum ea est assumenda pariatur quasi et quam. Facilis nam porro amet nostrum. In
                                    assumenda quia quae a id praesentium. Quos deleniti libero sed occaecati aut porro
                                    autem. Consectetur sed excepturi sint non placeat quia repellat incidunt labore. Autem
                                    facilis hic dolorum dolores vel.
                                    Consectetur quasi id et optio praesentium aut asperiores eaque aut. Explicabo omnis
                                    quibusdam esse. Ex libero illum iusto totam et ut aut blanditiis. Veritatis numquam ut
                                    illum ut a quam vitae.
                                </p>
                                <p>
                                    Alias quia non aliquid. Eos et ea velit. Voluptatem maxime enim omnis ipsa voluptas
                                    incidunt. Nulla sit eaque mollitia nisi asperiores est veniam.
                                </p>

                            </div><!-- End post content -->


                        </article><!-- End blog post -->

                        <div class="comments">

                            <h4 class="comments-count">Diskusi Komentar</h4>

                            <div id="comment-1" class="comment">
                                <div class="d-flex">
                                    <div class="comment-img"><img src="{{ asset('img/blog/comments-1.jpg') }}"
                                            alt=""></div>
                                    <div>
                                        <h5><a href="">Georgia Reader</a></a>
                                        </h5>
                                        <time datetime="2020-01-01">01 Jan,2022</time>
                                        <p>
                                            Et rerum totam nisi. Molestiae vel quam dolorum vel voluptatem et et. Est ad aut
                                            sapiente quis molestiae est qui cum soluta.
                                            Vero aut rerum vel. Rerum quos laboriosam placeat ex qui. Sint qui facilis et.
                                        </p>
                                    </div>
                                </div>
                            </div><!-- End comment #1 -->


                            <div id="comment-3" class="comment">
                                <div class="d-flex">
                                    <div class="comment-img"><img src="{{ asset('img/blog/comments-5.jpg') }}"
                                            alt="">
                                    </div>
                                    <div>
                                        <h5><a href="">Nolan Davidson</a> <a href="#">
                                            </a>
                                        </h5>
                                        <time datetime="2020-01-01">01 Jan,2022</time>
                                        <p>
                                            Distinctio nesciunt rerum reprehenderit sed. Iste omnis eius repellendus quia
                                            nihil ut accusantium tempore. Nesciunt expedita id dolor exercitationem
                                            aspernatur aut quam ut. Voluptatem est accusamus iste at.
                                            Non aut et et esse qui sit modi neque. Exercitationem et eos aspernatur. Ea est
                                            consequuntur officia beatae ea aut eos soluta. Non qui dolorum voluptatibus et
                                            optio veniam. Quam officia sit nostrum dolorem.
                                        </p>
                                    </div>
                                </div>

                            </div><!-- End comment #3 -->

                            <div id="comment-4" class="comment">
                                <div class="d-flex">
                                    <div class="comment-img"><img src="{{ asset('img/blog/blog-author.jpg') }}"
                                            alt="">
                                    </div>
                                    <div>
                                        <h5><a href="">Kay Duggan</a> <a href="#" class="reply"></a></h5>
                                        <time datetime="2020-01-01">01 Jan,2022</time>
                                        <p>
                                            Dolorem atque aut. Omnis doloremque blanditiis quia eum porro quis ut velit
                                            tempore. Cumque sed quia ut maxime. Est ad aut cum. Ut exercitationem non in
                                            fugiat.
                                        </p>
                                    </div>
                                </div>

                            </div><!-- End comment #4 -->

                            <div class="reply-form">

                                <h4>Tambahkan Komentar</h4>
                                <p>Your email address will not be published. Required fields are marked * </p>
                                <form action="">
                                    <div class="row">
                                        <div class="col form-group">
                                            <input name="website" type="text" class="form-control" placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <textarea name="comment" class="form-control" placeholder="Komentar"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim</button>

                                </form>

                            </div>

                        </div><!-- End blog comments -->

                    </div>


                </div>

            </div>
        </section><!-- End Blog Details Section -->

    </main><!-- End #main -->
@endsection
