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
</head>
<body class="bg-dark-theme">


	<nav class="navbar sticky-top navbar-dark dark-theme-item w-100">
		<a href="{{ route('dashboard') }}" class="navbar-brand">WebBlog Dashboard</a>
		<button class="navbar-toggler" data-toggle="collapse" data-target="#navbar">
			<span class="navbar-toggler-icon"></span>
		</button>
	</nav>

		<div class="col-lg-12 mt-2 pl-3">
			<!-- Logout button -->
			<form action="{{ route('logout') }}" method="post" class="float-right">
					
				@csrf

				<div class="form-group">
					<button type="submit" class="btn">
						<i class="fas fa-power-off text-white fa-lg"></i>
					</button>
				</div>

			</form>
		</div>


	<div class="sidebar h-100 collapse navbar-collapse" id="navbar">
		<ul class="navbar-content text-right">
			<li class="navbar-content-item mt-4">
				<i class="fas fa-home mr-2 text-white float-left"></i>
				<a href="{{ route('dashboard') }}" class="navbar-link h5 text-uppercase raleway-font pt-4">Dashboard</a>
				<hr>
			</li>
			<li class="navbar-content-item mt-4">
				<i class="fas fa-newspaper mr-2 text-white float-left"></i>
				<a href="{{ route('news.index') }}" class="navbar-link h5 text-uppercase raleway-font pt-4">News</a>
				<hr>
			</li>
			<li class="navbar-content-item mt-4">
				<i class="far fa-newspaper mr-2 text-white float-left"></i>
				<a href="{{ route('articles.index') }}" class="navbar-link h5 text-uppercase raleway-font pt-4">Articles</a>
				<hr>
			</li>
			<li class="navbar-content-item mt-4">
				<i class="fas fa-question-circle mr-2 text-white float-left"></i>
				<a href="{{ route('discussions.index') }}" class="navbar-link h5 text-uppercase raleway-font pt-4">Discussions</a>
				<hr>
			</li>
			<li class="navbar-content-item mt-4">
				<i class="fas fa-comments mr-2 text-white float-left"></i>
				<a href="{{ route('admin.comments') }}" class="navbar-link h5 text-uppercase raleway-font pt-4">Comments</a>
				<hr>
			</li>
			<li class="navbar-content-item mt-4">
				<i class="far fa-comment-dots mr-2 text-white float-left"></i>
				<a href="{{ route('admin.answers') }}" class="navbar-link h5 text-uppercase raleway-font pt-4">Answers</a>
				<hr>
			</li>
			<li class="navbar-content-item mt-4">
				<i class="fas fa-archive mr-2 text-white float-left"></i>
				<a href="{{ route('admin.categories') }}" class="navbar-link h5 text-uppercase raleway-font pt-4">Categories</a>
				<hr>
			</li>
		</ul>
	</div>