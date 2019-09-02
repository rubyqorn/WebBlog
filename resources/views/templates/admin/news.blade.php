@extends('templates.admin.app')

@section('title')

	Таблица новостей

@endsection

@section('content')

	<!-- Main content -->
	<div class="content container mt-4">
		<div class="row justify-content-center">

			<!-- Stats about news -->
			<div class="col-lg-8 col-md-12 col-12 mt-4 dark-theme-item">
				{!! $chart->container() !!}
			</div>

			<div class="col-lg-12 col-md-12 col-12 mt-4 p-4 shadow">
				<table class="table table-hover dark-theme-item">
							
					<thead class="text-uppercase">
						<tr>
							<th><small>Заголовок</small></th>
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
									<button class="btn btn-outline-info" data-toggle="modal" data-target="#edit">Редактировать</button>
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
									<button class="btn btn-outline-info" data-toggle="modal" data-target="#edit">Редактировать</button>
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
									<button class="btn btn-outline-info" data-toggle="modal" data-target="#edit">Редактировать</button>
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
									<button class="btn btn-outline-info" data-toggle="modal" data-target="#edit">Редактировать</button>
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
									<button class="btn btn-outline-info" data-toggle="modal" data-target="#edit">Редактировать</button>
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
					<div class="modal fade" id="edit" role="dialog" tabindex="-1">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="text-black-50">Редактирование записи</h4>
									<button class="close" data-dismiss="modal">
										<span>&times;</span>
									</button>
								</div>
								<form action="/" method="post" enctype="multipart/form-data">
									<div class="modal-body">

										<div class="form-group">

											<label for="title" class="control-label col-xs-2 font-weight-bold montserrat-font">Заголовок</label>

											<input type="text" class="form-control @error('title') is-invalid @enderror" value="" name="title">

											<div class="invalid-feedback" role="alert">
												<span></span>
											</div>

										</div>

										<div class="form-group">
											
											<label for="preview-text" class="control-label montserrat-font col-xs-2 font-weight-bold">Пролог</label>

											<textarea name="preview-text" class="form-control @error('preview-text') is-invalid @enderror" cols="10" rows="5"></textarea>

											<div class="invalid-feedback" role="alert">
												<span></span>
											</div>

										</div>

										<div class="form-group">
											
											<label for="description" class="control-label montserrat-font col-xs-2 font-weight-bold">Подробное описание</label>

											<textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10"></textarea>

											<div class="invalid-feedback" role="alert">
												<span></span>
											</div>

										</div>

										<div class="form-group">
											
											<div class="custom-file">
												<input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" value="">
												
												<label for="image" class="custom-file-label">Выберите изображение</label>
											</div>

											<div class="invalid-feedback" role="alert">
												<span></span>
											</div>

										</div>

										<div class="form-group">
											
											<label for="category" class="control-label montserrat-font font-weight-bold col-xs-2">Категория</label>

											<select name="category" class="custom-select @error('category') is-invalid @enderror">
												<option value="1">Lorem.</option>
												<option value="2">Lorem ipsum.</option>
												<option value="3">Lorem ipsum dolor.</option>
												<option value="4">Lorem ipsum dolor sit.</option>
												<option value="5">Lorem ipsum dolor sit amet.</option>
											</select>

											<div class="invalid-feedback" role="alert">
												<span></span>
											</div>

										</div>

									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-outline-info text-uppercase montserrat-font">
											<small>Редактировать</small>
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