@extends('templates.app')

@section('title')
	Статья
@endsection

@section('content')

<section class="mt-3 mb-4" id="article">
    <div class="container">
        <div class="row">
            <!-- Article content -->
            <div class="col-lg-8 col-md-8 col-12 p-0 col-6 shadow bg-light">
                <img src="img/logo.png" alt="" class="img-fluid">

                <div class="p-4 mt-3">
                    <h2 class="text-center text-black-50 miriam-font-family h1">This is a title about post</h2>
                    <div class="d-flex justify-content-center">
                        <p class="text-black-50 miriam-font-family text-uppercase"><small> JUL 10, 2019 /</small></p>
                        <i class="fas fa-tags fa-sm text-black-50 ml-2 mr-1 mt-1"></i>
                        <p class="text-light-green miriam-font-family text-uppercase"><small>something</small></p>
                    </div>
                </div>

                <div class="content mt-4 p-4">
                    <p class="text-dark montserrat-font-family">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero placeat aliquid, similique 
                        voluptates unde accusamus, eum ea voluptatem facilis in, repudiandae atque beatae fuga
                        doloremque obcaecati assumenda? Tempora labore accusamus?
                    </p>
                    <p class="text-dark montserrat-font-family">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero placeat aliquid, similique 
                        voluptates unde accusamus, eum ea voluptatem facilis in, repudiandae atque beatae fuga
                        doloremque obcaecati assumenda? Tempora labore accusamus?
                    </p>
                    <p class="text-dark montserrat-font-family">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero placeat aliquid, similique 
                        voluptates unde accusamus, eum ea voluptatem facilis in, repudiandae atque beatae fuga
                        doloremque obcaecati assumenda? Tempora labore accusamus?
                    </p>
                    <div class="text-center pt-4 pb-4">
                        <img src="img/logo.png" alt="sample" class="w-50">
                    </div>
                    <p class="text-dark montserrat-font-family">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero placeat aliquid, similique 
                        voluptates unde accusamus, eum ea voluptatem facilis in, repudiandae atque beatae fuga
                        doloremque obcaecati assumenda? Tempora labore accusamus?
                    </p>
                    <p class="text-dark montserrat-font-family">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero placeat aliquid, similique 
                        voluptates unde accusamus, eum ea voluptatem facilis in, repudiandae atque beatae fuga
                        doloremque obcaecati assumenda? Tempora labore accusamus?
                    </p>
                    <p class="text-dark montserrat-font-family">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero placeat aliquid, similique 
                        voluptates unde accusamus, eum ea voluptatem facilis in, repudiandae atque beatae fuga
                        doloremque obcaecati assumenda? Tempora labore accusamus?
                    </p>

                    <hr class="text-black-50 mt-4">    

                    <div class="comments-section p-4">
                        <form action="/" class="form-group" method="post">
                            <div class="form-group">
                                <textarea name="comment" cols="30" rows="10" class="form-control text-black-50 nunito-font-family" placeholder="Ваш комментарий"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary montserrat-font-family">Отправить</button>
                            </div>
                        </form>

                        <!-- Comments -->
                        <div class="comments mt-4">
                            
                            <div class="d-flex comment mt-3">
                                <div class="user-info col-lg-4">
                                    <img src="img/logo.png" alt="" class="w-50">
                                    <p class="text-black-50 mt-2">Anton Hideger</p>
                                </div>
                                <div class="comment">
                                    <p class="text-black-50">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste ullam, sed ab voluptatem rerum saepe minus itaque sit aliquid nostrum autem provident magni. Rerum itaque voluptas excepturi esse repudiandae, expedita, ab quod dolorem et dignissimos reiciendis eius deserunt iure tenetur.
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex comment mt-3">
                                <div class="user-info col-lg-4">
                                    <img src="img/logo.png" alt="" class="w-50">
                                    <p class="text-black-50 mt-2">Anton Hideger</p>
                                </div>
                                <div class="comment">
                                    <p class="text-black-50">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste ullam, sed ab voluptatem rerum saepe minus itaque sit aliquid nostrum autem provident magni. Rerum itaque voluptas excepturi esse repudiandae, expedita, ab quod dolorem et dignissimos reiciendis eius deserunt iure tenetur.
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex comment mt-3">
                                <div class="user-info col-lg-4">
                                    <img src="img/logo.png" alt="" class="w-50">
                                    <p class="text-black-50 mt-2">Anton Hideger</p>
                                </div>
                                <div class="comment">
                                    <p class="text-black-50">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste ullam, sed ab voluptatem rerum saepe minus itaque sit aliquid nostrum autem provident magni. Rerum itaque voluptas excepturi esse repudiandae, expedita, ab quod dolorem et dignissimos reiciendis eius deserunt iure tenetur.
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex comment mt-3">
                                <div class="user-info col-lg-4">
                                    <img src="img/logo.png" alt="" class="w-50">
                                    <p class="text-black-50 mt-2">Anton Hideger</p>
                                </div>
                                <div class="comment">
                                    <p class="text-black-50">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste ullam, sed ab voluptatem rerum saepe minus itaque sit aliquid nostrum autem provident magni. Rerum itaque voluptas excepturi esse repudiandae, expedita, ab quod dolorem et dignissimos reiciendis eius deserunt iure tenetur.
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex comment mt-3">
                                <div class="user-info col-lg-4">
                                    <img src="img/logo.png" alt="" class="w-50">
                                    <p class="text-black-50 mt-2">Anton Hideger</p>
                                </div>
                                <div class="comment">
                                    <p class="text-black-50">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste ullam, sed ab voluptatem rerum saepe minus itaque sit aliquid nostrum autem provident magni. Rerum itaque voluptas excepturi esse repudiandae, expedita, ab quod dolorem et dignissimos reiciendis eius deserunt iure tenetur.
                                    </p>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row justify-content-center mt-3">
                            <ul class="pagination">
                                <li class="page-item active"><a href="/" class="page-link">1</a></li>
                                <li class="page-item"><a href="/" class="page-link">2</a></li>
                                <li class="page-item"><a href="/" class="page-link">3</a></li>
                                <li class="page-item"><a href="/" class="page-link">4</a></li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
            
            <!-- Sidebars -->
            <!-- Intresting articles -->
            <div class="col-lg-4 col-md-4 col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-black-50">
                            Последние статьи
                        </h4>
                    </div>
                    <div class="card-body">
                        <a href="/" class="nav-link text-light-green">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione, voluptatibus!
                        </a>
                        <hr>
                        <a href="/" class="nav-link text-light-green">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione, voluptatibus!
                        </a>
                        <hr>
                        <a href="/" class="nav-link text-light-green">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione, voluptatibus!
                        </a>
                        <hr>
                        <a href="/" class="nav-link text-light-green">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione, voluptatibus!
                        </a>
                        <hr>
                        <a href="/" class="nav-link text-light-green">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione, voluptatibus!
                        </a>
                        <hr>
                    </div> 
                </div>

                <!-- Categories -->
                <div class="col-lg-12 col-md-12 col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-black-50">
                                Категории статей
                            </h4>
                        </div>
                        <div class="card-body">
                            <a href="/" class="nav-link text-light-green nunito-font-family">PHP</a>
                            <hr>
                            <a href="/" class="nav-link text-light-green nunito-font-family">Git</a>
                            <hr>
                            <a href="/" class="nav-link text-light-green nunito-font-family">JavaScript</a>
                            <hr>
                            <a href="/" class="nav-link text-light-green nunito-font-family">Bootstrap 4</a>
                            <hr>
                            <a href="/" class="nav-link text-light-green nunito-font-family">Laravel</a>
                            <hr>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection