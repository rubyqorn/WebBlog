<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> @yield('title') </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Montserrat|Nunito|Raleway&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}">
</head>
<body class="bg-dark-theme">


	<nav class="navbar sticky-top navbar-dark dark-theme-item w-100">
		<a href="/" class="navbar-brand">WebBlog Dashboard</a>
		<button class="navbar-toggler" data-toggle="collapse" data-target="#navbar">
			<span class="navbar-toggler-icon"></span>
		</button>
	</nav>


	<div class="sidebar h-100 collapse navbar-collapse" id="navbar">
		<ul class="navbar-content text-right">
			<li class="navbar-content-item mt-4">
				<i class="fas fa-home mr-2 text-white float-left"></i>
				<a href="/" class="navbar-link h5 text-uppercase raleway-font pt-4">Home</a>
				<hr>
			</li>
			<li class="navbar-content-item mt-4">
				<i class="fas fa-newspaper mr-2 text-white float-left"></i>
				<a href="/news.php" class="navbar-link h5 text-uppercase raleway-font pt-4">News</a>
				<hr>
			</li>
			<li class="navbar-content-item mt-4">
				<i class="far fa-newspaper mr-2 text-white float-left"></i>
				<a href="/articles.php" class="navbar-link h5 text-uppercase raleway-font pt-4">Articles</a>
				<hr>
			</li>
			<li class="navbar-content-item mt-4">
				<i class="fas fa-question-circle mr-2 text-white float-left"></i>
				<a href="/discussions.php" class="navbar-link h5 text-uppercase raleway-font pt-4">Discussions</a>
				<hr>
			</li>
			<li class="navbar-content-item mt-4">
				<i class="fas fa-comments mr-2 text-white float-left"></i>
				<a href="/comments.php" class="navbar-link h5 text-uppercase raleway-font pt-4">Comments</a>
				<hr>
			</li>
			<li class="navbar-content-item mt-4">
				<i class="far fa-comment-dots mr-2 text-white float-left"></i>
				<a href="/answers.php" class="navbar-link h5 text-uppercase raleway-font pt-4">Answers</a>
				<hr>
			</li>
			<li class="navbar-content-item mt-4">
				<i class="fas fa-archive mr-2 text-white float-left"></i>
				<a href="/categories.php" class="navbar-link h5 text-uppercase raleway-font pt-4">Categories</a>
				<hr>
			</li>
		</ul>
	</div>