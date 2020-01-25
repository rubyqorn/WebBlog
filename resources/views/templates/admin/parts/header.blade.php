<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> @yield('title') </title>
	<!-- Bootstrap styles -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Font awesome icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
	<!-- Google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Montserrat|Nunito|Raleway&display=swap" rel="stylesheet"> 
	<!-- Custom CSS -->
	<link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}">
	<!-- CKEditor 4 -->
	<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
</head>
<body class="bg-light">

	<div class="wrapper">
        
        <div id="sidebar">
            <div class="sidebar-header">
                <p class="h3 text-black-50">
                    WebBlog Dashboard
                </p>
            </div>

            <ul class="list-unstyled components">
                <p class="h5 text-black-50">
                    Pages
                </p>

                <li class="sidebar-item active">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">Dashboard</a>
                </li>

                <li class="sidebar-item">
                    <a href="/admin/answers" class="sidebar-link">Answers</a>
                </li>

                <li class="sidebar-item">
                    <a href="/admin/articles" class="sidebar-link">Articles</a>
                </li>

                <li class="sidebar-item">
                    <a href="/admin/discussions" class="sidebar-link">Discussions</a>
                </li>

                <li class="sidebar-item">
                    <a href="/admin/news" class="sidebar-link">News</a>
                </li>

                <li class="sidebar-item">
                    <a href="/admin/comments" class="sidebar-link">Comments</a>
                </li>

                <li class="sidebar-item">
                    <a href="/admin/categories" class="sidebar-link">Categories</a>
                </li>
            </ul>

        </div>

        <!-- Content -->
        <div class="col-lg-9 col-sm-12 col-md-12 p-0" id="content">

            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light border-bottom">
                <button id="sidebarCollapse" class="btn m-0 btn-light">
                    <i class="fas fa-align-left text-info"></i>
                </button>
                <ul class="navbar-nav ml-auto" id="navbar">
                    <li class="nav-item">
                       
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">

                            @csrf

                            <div class="form-group">
                                <button type="submit" class="btn text-muted mt-3">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                </ul>
            </nav>