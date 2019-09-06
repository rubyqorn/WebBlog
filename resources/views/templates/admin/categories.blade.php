@extends('templates.admin.app')

@section('title')

	Таблица с категориями

@endsection

@section('content')

	<!-- Main content -->
	<div class="container content mt-4 mb-4">

		<div class="col-lg-5 col-md-12 col-sm-12 d-flex" id="category-table">
			<a href="/" class="badge badge-pill badge-info ml-2">Новости</a>
			<a href="/" class="badge badge-pill badge-success ml-2">Статьи</a>
		</div>

		<div class="row justify-content-center">

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

						@forelse($news as $category)

							<tr>
								<td>
									<p class="text-light-green montserrat-font">
										<small>
											{{ $category->name }}
										</small>
									</p>
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

						@empty

							<h4 class="text-center">
								Нет записей
							</h4>

						@endforelse

					</tbody>
				</table>
			</div>

			
			<!-- Pagination for table -->
			<div class="col-lg-12 col-md-12 col-12 mt-4 mb-4">
				<ul class="pagination">
					{{ $news->links() }}
				</ul>
			</div>

		</div>


	</div>

@endsection