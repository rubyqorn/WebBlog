@extends('templates.admin.app')

@section('title')

	Таблица с ответами

@endsection

@section('content')

	<!-- Main content -->
	<div class="content container mt-4">
		<div class="row justify-content-center">

			<!-- Stats about news -->
			<div class="col-lg-8 col-md-12 col-12 mt-4 chart">
				<!-- Container which have chart -->	
			</div>

			<div class="col-lg-12 col-md-12 col-12 mt-4 p-4 shadow">
				<table class="table table-hover dark-theme-item">
							
					<thead>
						<tr class="text-uppercase">
							<th><small>Вопрос</small></th>
							<th><small>Редактировать</small></th>
							<th><small>Удалить</small></th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>
								<a href="/" class="text-light-green">
									<small>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, fugiat.
									</small>
								</a>
							</td>
							<td>
								<div class="form-group">
									<button data-toggle="modal" data-target="#edit" class="btn btn-outline-info text">Редактировать</button>
								</div>
							</td>
							<td>
								<div class="form-group">
									<button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete">Удалить</button>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<a href="/" class="text-light-green">
									<small>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, fugiat.
									</small>
								</a>
							</td>
							<td>
								<div class="form-group">
									<button data-toggle="modal" data-target="#edit" class="btn btn-outline-info">Редактировать</button>
								</div>
							</td>
							<td>
								<div class="form-group">
									<button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete">Удалить</button>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<a href="/" class="text-light-green">
									<small>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, fugiat.
									</small>
								</a>
							</td>
							<td>
								<div class="form-group">
									<button data-toggle="modal" data-target="#edit" class="btn btn-outline-info">Редактировать</button>
								</div>
							</td>
							<td>
								<div class="form-group">
									<button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete">Удалить</button>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<a href="/" class="text-light-green">
									<small>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, fugiat.
									</small>
								</a>
							</td>
							<td>
								<div class="form-group">
									<button data-toggle="modal" data-target="#edit" class="btn btn-outline-info">Редактировать</button>
								</div>
							</td>
							<td>
								<div class="form-group">
									<button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete">Удалить</button>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<a href="/" class="text-light-green">
									<small>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, fugiat.
									</small>
								</a>
							</td>
							<td>
								<div class="form-group">
									<button data-toggle="modal" data-target="#edit" class="btn btn-outline-info">Редактировать</button>
								</div>
							</td>
							<td>
								<div class="form-group">
									<button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete">Удалить</button>
								</div>
							</td>
						</tr>			
					</tbody>


					<!-- Modal windows -->
					<!-- Delete -->
					<div class="modal fade" id="delete" role="dialog" tabindex="-1">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="text-black-50">
										Процесс удаления
									</h4>
									<button class="close" data-dismiss="modal">
										<span>&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<h5 class="text-center text-danger">
										Вы действительно хотите удалить эту запись?
									</h5>
								</div>
								<div class="modal-footer">
									<form action="/" method="post">
										<button type="submit" class="btn btn-outline-success montserrat-font">
											Да
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- Edit -->
					<div class="modal fade" role="dialog" tabindex="-1" id="edit">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="text-black-50">Редактирование записи</h4>
									<button class="close" data-dismiss="modal">
										<span>&times;</span>
									</button>
								</div>
								<form action="/" method="post" enctype="multipat/form-data">
									<div class="modal-body">

										<div class="form-group">
											
											<label for="title" class="control-label col-xs-2 font-weight-bold montserrat-font">Вопрос</label>

											<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="">

											<div class="invalid-feedback" roe="alert">
												<span></span>
											</div>

										</div>


										<div class="form-group">
											
											<label for="article-id" class="control-label col-xs-2 font-weight-bold montserrat-font">Идентификатор вопроса</label>

											<input type="text" class="form-control" name="article-id" value="1" disabled>

										</div>

										<div class="form-group">
											
											<label for="user-id" class="control-label col-xs-2 font-weight-bold montserrat-font">Идентификатор пользователя</label>

											<input type="text" class="form-control" name="user-id" value="1" disabled>

										</div>
									
									
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-outline-info text-uppercase montserrat-font">
											<small>
												Редактировать
											</small>
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>

				</table>

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
	</div>

@endsection