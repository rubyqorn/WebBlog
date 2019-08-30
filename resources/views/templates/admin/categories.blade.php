@extends('templates.admin.app')

@section('title')

	Таблица с категориями

@endsection

@section('content')

		<!-- Main content -->
	<div class="container content mt-4 mb-4">

		<div class="col-lg-5 col-md-12 col-sm-12 d-flex">
			<a href="/" class="badge badge-pill badge-info ml-2">Новости</a>
			<a href="/" class="badge badge-pill badge-success ml-2">Статьи</a>
		</div>

		<div class="row justify-content-center">
			
			<div class="col-lg-12 col-md-12 col-12 chart dark-theme-item">
				<!-- Chart -->
			</div>

			<!-- Table with records -->
			<div class="col-lg-12 col-md-12 col-12 shadow mt-4 p-4">
				<table class="table table-striped dark-theme-item">
					<thead>
						<tr class="text-uppercase">
							<th><small>Категория</small></th>
							<th><small>Редактировать</small></th>
							<th><small>Удалить</small></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<a href="/" class="text-light-green montserrat-font">
									<small>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos, quas!
									</small>
								</a>
							</td>
							<td>
								<button class="btn btn-outline-info" data-toggle="modal" data-target="edit">
									Редактировать
								</button>
							</td>
							<td>
								<button class="btn btn-outline-danger" data-toggle="modal" data-target="delete">
									Удалить
								</button>
							</td>
						</tr>
						<tr>
							<td>
								<a href="/" class="text-light-green montserrat-font">
									<small>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus, magni!
									</small>
								</a>
							</td>
							<td>
								<button class="btn btn-outline-info" data-toggle="modal" data-target="edit">
									Редактировать
								</button>
							</td>
							<td>
								<button class="btn btn-outline-danger" data-toggle="modal" data-target="delete">
									Удалить
								</button>
							</td>
						</tr>
						<tr>
							<td>
								<a href="/" class="text-light-green montserrat-font">
									<small>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, quidem.
									</small>
								</a>
							</td>
							<td>
								<button class="btn btn-outline-info" data-toggle="modal" data-target="edit">
									Редактировать
								</button>
							</td>
							<td>
								<button class="btn btn-outline-danger" data-toggle="modal" data-target="delete">
									Удалить
								</button>
							</td>
						</tr>
						<tr>
							<td>
								<a href="/" class="text-light-green montserrat-font">
									<small>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, aspernatur?
									</small>
								</a>
							</td>
							<td>
								<button class="btn btn-outline-info" data-toggle="modal" data-target="edit">
									Редактировать
								</button>
							</td>
							<td>
								<button class="btn btn-outline-danger" data-toggle="modal" data-target="delete">
									Удалить
								</button>
							</td>
						</tr>
						<tr>
							<td>
								<a href="/" class="text-light-green montserrat-font">
									<small>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, soluta.
									</small>
								</a>
							</td>
							<td>
								<button class="btn btn-outline-info" data-toggle="modal" data-target="edit">
									Редактировать
								</button>
							</td>
							<td>
								<button class="btn btn-outline-danger" data-toggle="modal" data-target="delete">
									Удалить
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Pagination for table -->
		<div class="col-lg-12 col-md-12 col-12 mt-4 mb-4">
			<ul class="pagination">
				<li class="page-item active"><a href="/" class="page-link">1</a></li>
				<li class="page-item"><a href="/" class="page-link">2</a></li>
				<li class="page-item"><a href="/" class="page-link">3</a></li>
				<li class="page-item"><a href="/" class="page-link">4</a></li>
			</ul>
		</div>

	</div>

@endsection