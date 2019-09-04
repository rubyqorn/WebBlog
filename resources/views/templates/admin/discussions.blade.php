@extends('templates.admin.app')

@section('title')

	Таблица вопросов

@endsection

@section('content')

	<!-- Main content -->
	<div class="content container mt-4">
		<div class="row justify-content-center">

			<!-- Stats about news -->
			<div class="col-lg-8 col-md-12 col-12 mt-4">
				{!! $chart->container() !!}
			</div>

			<div class="col-lg-12 col-md-12 col-12 mt-4 p-4 shadow">
				<table class="table table-hover dark-theme-item">
							
					<thead class="text-uppercase montserrat-font">
						<tr>
							<th><small>Заголовок</small></th>
							<th><small>Редактировать</small></th>
							<th><small>Удалить</small></th>
						</tr>
					</thead>

					<tbody>

						@foreach($discussions as $discussion)

							<tr>
								<td>
									<a href="{{ route('discussion', $discussion->id) }}" class="text-light-green">
										<small>
											{{ $discussion->title }}
										</small>
									</a>
								</td>
								<td>
									<div class="form-group">
										<button data-toggle="modal" data-target="#edit-{{ $discussion->id }}" class="btn btn-outline-info">Редактировать</button>
									</div>
								</td>
								<td>
									<div class="form-group">
										<button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-{{ $discussion->id }}">Удалить</button>
									</div>
								</td>
							</tr>

						@endforeach
			
					</tbody>


					<!-- Modal windows -->
					<!-- Delete -->
					@foreach($discussions as $discussion)
						<div class="modal fade" id="delete-{{ $discussion->id }}" role="dialog" tabindex="-1">
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
										<form action="{{ route('discussions.destroy', $discussion->id) }}" method="post">
											<button type="submit" class="btn btn-outline-success montserrat-font">
												Да
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					@endforeach

					<!-- Edit -->
					@foreach($discussions as $discussion)
						<div class="modal fade" role="dialog" tabindex="-1" id="edit-{{ $discussion->id }}">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="text-black-50">Редактирование записи</h4>
										<button class="close" data-dismiss="modal">
											<span>&times;</span>
										</button>
									</div>
									<form action="{{ route('discussions.update', $discussion->id) }}" method="post" enctype="multipat/form-data">
										<div class="modal-body">

											<div class="form-group">
												
												<label for="title" class="control-label col-xs-2 font-weight-bold montserrat-font">Вопрос</label>

												<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $discussion->title }}">

												@error('title')
														
													<div class="invalid-feedback" role="alert">
														<span>{{ $message }}</span>
													</div>

												@enderror

											</div>

											<div class="form-group">
												
												<label for="description" class="control-label font-weight-bold montserrat-font col-xs-2">Подробное описание</label>

												<textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ $discussion->description }}</textarea>

												@error('description')

													<div class="invalid-feedback" role="alert">
														<span>{{ $message }}</span>
													</div>

												@enderror

											</div>

											<div class="form-group">
												
												<div class="custom-file">
													
													<input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror">

													<label for="image" class="custom-file-label">
														Выберите изображение
													</label>

												</div>

												<div class="text-white bg-dark p-3 mt-1 col-lg-12">
													{{ $discussion->image }}
												</div>

												@error('image')

													<div class="invalid-feedback" role="alert">
														<span>{{ $message }}</span>
													</div>

												@enderror

											</div>

											<div class="form-group">
												
												<label for="category" class="control-label col-xs-2 font-weight-bold montserrat-font">Категория</label>

												<select name="category" class="custom-select @error('category') is-invalid @enderror">
													
													@foreach($categories as $category)

														<option value="{{ $category->id }}">{{ $category->name }}</option>

													@endforeach
												
												</select>

												<div class="text-white bg-dark p-3 mt-1 col-lg-12">
													
													@foreach($discussion->categories as $category)

														{{ $category->name }}

													@endforeach
												
												</div>

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
					@endforeach

				</table>

			</div>

			<!-- Pagination for table -->
			<div class="col-lg-12 col-md-12 col-12 mt-4 mb-4">
				<ul class="pagination">
					{{ $discussions->links() }}
				</ul>
			</div>

		</div>
	</div>

	{!! $chart->script() !!}

@endsection