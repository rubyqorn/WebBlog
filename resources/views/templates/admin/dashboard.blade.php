@extends('templates.admin.app')

@section('title')
	Dashboard
@endsection

@section('content')

	<div class="container content mt-4 mb-4">
		<div class="row">

			<!-- Information about actions users -->
			<div class="col-lg-3 bg-primary text-white text-center ml-4 mt-4 p-2 rounded">
				<i class="fas fa-user"></i>
				<p class="nunito-font">Users</p>
				<p class="nunito-font">10k</p>
			</div>

			<div class="col-lg-3 bg-success text-white text-center ml-4 mt-4 p-2 rounded">
				<i class="fas fa-tags"></i>
				<p class="nunito-font">Answers</p>
				<p class="nunito-font">5k</p>
			</div>

			<div class="col-lg-3 bg-info text-white text-center ml-4 mt-4 p-2 rounded">
				<i class="fas fa-envelope"></i>
				<p class="nunito-font">Comments</p>
				<p class="nunito-font">9k</p>
			</div>
	
			<!-- Title for news statistic -->
			<div class="col-lg-12 mt-4" id="title">
				<h4 class="montserrat-font">Статистика по новостям</h4>
				<hr class="w-50 float-left">
			</div>

			<!-- Information about news -->
			<div class="col-lg-8 col-md-12 col-12 mt-4 mb-4 d-flex">
				
				<div class="col-lg-8 col-md-12 col-12 mt-4 chart">
					<!-- Container which have chart -->
				</div>

				<!-- Card with two latest news -->
				<div class="col-lg-6 mt-4 ">
					<div class="card dark-theme-item">
						<div class="card-header">
							<h4 class="card-title">Последние новости</h4>
						</div>
						<div class="card-body">

							<div class="col-lg-12">
								<a href="/" class="text-info">
									<small>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, at.
									</small>
								</a>
								<p class="text-light-green float-right mt-3">
									<small>
										AUG 12, 2019
									</small>
								</p>
								<hr>
							</div>

							<div class="col-lg-12">
								<a href="/" class="text-info">
									<small>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, at.
									</small>
								</a>
								<p class="text-light-green float-right mt-3">
									<small>
										AUG 12, 2019
									</small>
								</p>
								<hr>
							</div>

						</div>
					</div>
				</div>

			</div>


			<!-- Latest comments -->
			<div class="col-lg-6 col-md-12 col-12 mt-4" id="latest-answers-section">
				<div class="card dark-theme-item">
					<div class="card-header">
						<h4 class="card-title">Последние комментарии</h4>
					</div>
					<div class="card-body">
						<div class="col-lg-12 col-md-12 col-12 mt-4" id="latest-comments-section">
							<div class="list-group">
								<div class="list-group-item  dark-theme-item flex-column">
									<div class="d-flex w-100 justify-content-between">
										<img src="{{ asset('assets/img/default.png') }}" alt="">
										<p class="pl-3 pr-2">
											<small>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
											</small>
										</p>
										<small class="text-light-green">
											MAY 20, 2019
										</small>
										<small class="pl-3 raleway-font">
											<strong>Author:</strong> Anton Hideger
										</small>
									</div>
								</div>
								<div class="list-group-item dark-theme-item flex-column">
									<div class="d-flex w-100 justify-content-between">
										<img src="{{ asset('assets/img/default.png') }}" alt="">
										<p class="pl-3 pr-2">
											<small>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
											</small>
										</p>
										<small class="text-light-green">
											MAY 20, 2019
										</small>
										<small class="pl-3 raleway-font">
											<strong>Author:</strong> Anton Hideger
										</small>
									</div>
								</div>
								<div class="list-group-item dark-theme-item flex-column">
									<div class="d-flex w-100 justify-content-between">
										<img src="{{ asset('assets/img/default.png') }}" alt="">
										<p class="pl-3 pr-2">
											<small>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
											</small>
										</p>
										<small class="text-light-green">
											MAY 20, 2019
										</small>
										<small class="pl-3 raleway-font">
											<strong>Author:</strong> Anton Hideger
										</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Latest answers -->
			<div class="col-lg-6 col-md-12 col-12 mt-4" id="latest-answers-section">
				<div class="card dark-theme-item">
					<div class="card-header">
						<h4 class="card-title">Последние ответы</h4>
					</div>
					<div class="card-body">
						<div class="col-lg-12 col-md-12 col-12 mt-4" id="latest-comments-section">
							<div class="list-group">
								<div class="list-group-item dark-theme-item flex-column">
									<div class="d-flex w-100 justify-content-between">
										<img src="{{ asset('assets/img/default.png') }}" alt="">
										<p class="pl-3 pr-2">
											<small>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
											</small>
										</p>
										<small class="text-light-green">
											MAY 20, 2019
										</small>
										<small class="pl-3 raleway-font">
											<strong>Author:</strong> Anton Hideger
										</small>
									</div>
								</div>
								<div class="list-group-item dark-theme-item flex-column">
									<div class="d-flex w-100 justify-content-between">
										<img src="{{ asset('assets/img/default.png') }}" alt="">
										<p class="pl-3 pr-2">
											<small>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
											</small>
										</p>
										<small class="text-light-green">
											MAY 20, 2019
										</small>
										<small class="pl-3 raleway-font">
											<strong>Author:</strong> Anton Hideger
										</small>
									</div>
								</div>
								<div class="list-group-item dark-theme-item flex-column">
									<div class="d-flex w-100 justify-content-between">
										<img src="{{ asset('assets/img/default.png') }}" alt="">
										<p class="pl-3 pr-2">
											<small>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, culpa.
											</small>
										</p>
										<small class="text-light-green">
											MAY 20, 2019
										</small>
										<small class="pl-3 raleway-font">
											<strong>Author:</strong> Anton Hideger
										</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

@endsection