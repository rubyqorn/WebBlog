@extends('templates.admin.app')

@section('title')
	Dashboard
@endsection

@section('content')

	<!-- Main content -->
	<div class="container-fluid">
		<div class="row">

			<div class="col-lg-12 col-xs-12 p-4 d-flex justify-content-between bg-grey">
				<div class="greeting">
					
					<a href="{{ Request::path() }}" class="text-muted">
						<small>
							{{ Breadcrumbs::render(Request::path()) }}
						</small>
					</a>
					
					<div class="d-flex">
						<i class="fas fa-chart-pie text-muted mt-1 mr-2"></i>
						<p class="h4 text-muted nunito-font">
							<strong>Analytics</strong> Dashboard
						</p>
					</div>
				</div>
				<div class="date">
					<p class="text-black-50 font-weight-bold montserrat-font">
						20 JAN 2020
					</p>
				</div>
			</div>

			<div class="col-lg-12 col-xs-12 col-md-12 mt-3">
				<div class="row">

				<div class="col">
					<div class="jumbotron p-2 text-center">
						<p class="text-muted">
							<i class="fas fa-user"></i>
						</p>
						<p class="" class='text-black-50'>
							Users
						</p>
						<p class="text-muted">
							378
						</p>
					</div>
				</div>
				<div class="col">
					<div class="jumbotron p-2 text-center">
						<p class="text-muted">
							<i class="fas fa-user"></i>
						</p>
						<p class="" class='text-black-50'>
							Answers
						</p>
						<p class="text-muted">
							10021
						</p>
					</div>
				</div>
				<div class="col">
					<div class="jumbotron p-2 text-center">
						<p class="text-muted">
							<i class="fas fa-user"></i>
						</p>
						<p class="" class='text-black-50'>
							Comments
						</p>
						<p class="text-muted">
							12320
						</p>
					</div>
				</div>

				</div>
			</div>

			<div class="col-lg-10 d-flex justify-content-between">
				<p class="text-muted h4 nunito-font">
					News chart
				</p>
				<p class="text-muted h4 nunito-font text-center">
					Users chart
				</p>
			</div>
			<!-- Charts -->
			<div class="col-lg-5 h-50 col-md-12 col-12 mt-4 shadow p-3 ml-2 mr-1">
				{!! $newsChart->container() !!}
			</div>

			<div class="col-lg-5 h-50 col-md-12 col-12 mt-4 shadow p-3 ml-1">
				{!! $usersChart->container() !!}
			</div>

			<div class="col-lg-12 col-sm-12">
				<p class="text-muted h4 nunito-font mt-3">
					Articles chart
				</p>
			</div>

			<div class="col-lg-12 shadow  bg-light col-xs-12 col-md-12 mt-4 ml-2 mb-4 p-4">
				{!! $articlesChart->container() !!}
			</div>

			{!! $newsChart->script() !!}
			{!! $usersChart->script() !!}
			{!! $articlesChart->script() !!}

			

		</div>

@endsection