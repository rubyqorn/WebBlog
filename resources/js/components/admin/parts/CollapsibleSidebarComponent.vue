<template>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-lg-3">
                <ul class="sidebar list-group">
                    <a href="/home" class="robot-font border-bottom pb-2 text-white font-weight-bold text-center">
                        <i class="fa fa-bolt mr-1 text-warning"></i> WebBlog Panel
                    </a>
                    <li class="nav-link border-bottom mt-4 pb-3">
                        <a href="/" class="robot-font text-grey">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-link border-bottom pb-3 pt-3">
                        <a href="#" role="button" class="robot-font text-grey" data-toggle="collapse" data-target="#articles-content">
                            <i class="far fa-newspaper"></i> News
                        </a>
                        <div class="collapse" id="articles-content">
                            <div class="pl-4 mt-2">
                                <a href="/" class="robot-font text-grey">
                                    <i class="fas fa-table"></i> News table 
                                </a>
                            </div>
                            <div class="pl-4 mt-2">
                                <a href="/" class="robot-font text-grey">
                                    <i class="far fa-comments"></i> Comments 
                                </a>
                            </div>
                        </div>
                    </li> 
                    <li class="nav-link border-bottom pb-3 pt-3">
                        <a href="#" role="button" class="robot-font text-grey" data-toggle="collapse" data-target="#discussions-content">
                            <i class="far fa-newspaper"></i> Articles
                        </a>
                        <div class="collapse" id="discussions-content">
                            <div class="pl-4 mt-2">
                                <a href="/" class="robot-font text-grey">
                                    <i class="fas fa-table"></i> Articles table 
                                </a>
                            </div>
                            <div class="pl-4 mt-2">
                                <a href="/" class="robot-font text-grey">
                                    <i class="far fa-comments"></i> Comments 
                                </a>
                            </div>
                        </div>
                    </li> 
                    <li class="nav-link border-bottom pb-3 pt-3">
                        <a href="#" role="button" class="robot-font text-grey" data-toggle="collapse" data-target="#news-content">
                            <i class="far fa-newspaper"></i> Discussions
                        </a>
                        <div class="collapse" id="news-content">
                            <div class="pl-4 mt-2">
                                <a href="/" class="robot-font text-grey">
                                    <i class="fas fa-table"></i> Discussions table 
                                </a>
                            </div>
                            <div class="pl-4 mt-2">
                                <a href="/" class="robot-font text-grey">
                                    <i class="far fa-comments"></i> Answers 
                                </a>
                            </div>
                        </div>
                    </li> 
                </ul>
            </div>

            <div class="col-lg-9 bg-primary p-4" id="header">
                <button class="btn m-0 p-0 text-grey" id="navbar-slider">
                    <i class="fas fa-align-left"></i>
                </button>
                <div class="col-lg-12 mt-3 d-flex">
                    <i class="fa fa-box text-white mt-3 mr-3"></i>
                    <p class="text-white font-weight-bold h1">Dashboard</p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {

    }
</script>