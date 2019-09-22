@extends('templates.admin.app')

@section('title')

	Таблица новостей

@endsection

@section('content')

	<!-- Main content -->
	<div class="content container mt-4" id="news-table">
		<div class="row justify-content-center">

			<!-- Stats about news -->
			<div class="col-lg-8 col-md-12 col-12 mt-4 dark-theme-item">
				{!! $chart->container() !!}
			</div>

			@include('templates.admin.parts.success-message')

			<!-- Add new record button -->
			<div class="col-lg-12 mt-4">
				<button class="btn btn-outline-primary text-uppercase btn-sm float-right" data-toggle="modal" data-target="#create">
					Создать новую запись
				</button>
			</div>

			<!-- Add new records modal window -->
			<div class="modal fade" id="create" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title text-black-50">
								Создать новую запись
							</h4>
							<button class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">

							@csrf

							<div class="modal-body">

								<div class="form-group">

									<label for="title" class="control-label col-xs-2 font-weight-bold text-black-50 montserrat-font">Заголовок</label>

									<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">

									@error('title')

										<div class="invalid-feedback" role="alert">
											<span>{{ $message }}</span>
										</div>

									@enderror

								</div>

								<div class="form-group">

									<label for="preview_text" class="control-label col-xs-2 font-weight-bold montserrat-font text-black-50">Пролог</label>

									<textarea name="preview_text" class="form-control @error('preview_text') is-invalid @enderror" cols="10" rows="5">
										{{ old('preview_text') }}
									</textarea>

									@error('preview_text')

										<div class="invalid-feedback" role="alert">
											<span>{{ $message }}</span>
										</div>

									@enderror

								</div>

								<div class="form-group">
									
									<label for="description" class="control-label col-xs-2 font-weight-bold text-black-50 montserrat-font">Подробное описание</label>

									<textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">
										{{ old('description') }}
									</textarea>

									@error('description')

										<div class="invalid-feedback" role="alert">
											<span>{{ $message }}</span>
										</div>

									@enderror

								</div>

								<div class="form-group">
									
									<div class="custom-file">

										<input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" value="{{ old('image') }}">

										<label for="image" class="custom-file-label">Выберите изображение</label>

										@error('image')

											<div class="invalid-feedback" role="alert">
												<span>{{ $message }}</span>
											</div>

										@enderror
									
									</div>

								</div>

								<div class="form-group">
									
									<label class="control-label col-xs-2 font-weight-bold text-black-50">Категория</lable>

									<select name="category" class="custom-select">
										
										@foreach($categories as $category)

											<option value="{{ $category->category_id }}">{{ $category->name }}</option>

										@endforeach

									</select>

								</div>

							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-outline-info btn-sm text-uppercase">
									Добавить
								</button>
							</div>
						</form>
					</div>
				</div>
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
						@forelse($news as $item)
						<tr>
							<td>
								<a href="{{ route('singleNews', $item->id) }}" class="text-light-green">
									<small>
										{{ $item->title }}
									</small>
								</a>
							</td>
							<td>
								<div class="form-group">
									<button class="btn btn-outline-info" data-toggle="modal" data-target="#edit-{{ $item->id }}">Редактировать</button>
								</div>
							</td>
							<td>
								<div class="form-group">
									<button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-{{ $item->id }}">Удалить</button>
								</div>
							</td>
						</tr>

						@empty

							<h4 class="text-center">
								Таблица пуста
							</h4>

						@endforelse
			
					</tbody>


					<!-- Modal windows -->
					<!-- Delete -->
					@foreach($news as $item)

						<div class="modal fade" id="delete-{{ $item->id }}" role="dialog" tabindex="-1">
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
										<form action="{{ route('news.destroy', $item->id) }}" method="post">

											@csrf

											@method('DELETE')

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
					@foreach($news as $item)

						<div class="modal fade" id="edit-{{ $item->id }}" role="dialog" tabindex="-1">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="text-black-50">Редактирование записи</h4>
										<button class="close" data-dismiss="modal">
											<span>&times;</span>
										</button>
									</div>
									<form action="{{ route('news.update', $item->id) }}" method="post" enctype="multipart/form-data">

										@csrf

										@method('PATCH')

										<div class="modal-body">

											<div class="form-group">

												<label for="title" class="control-label col-xs-2 font-weight-bold montserrat-font">Заголовок</label>

												<input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $item->title }}" name="title">

												@error('title')	

													<div class="invalid-feedback" role="alert">
														<span>{{ $message }}</span>
													</div>

												@enderror

											</div>

											<div class="form-group">
												
												<label for="preview-text" class="control-label montserrat-font col-xs-2 font-weight-bold">Пролог</label>

												<textarea name="preview_text" class="form-control @error('preview-text') is-invalid @enderror" cols="10" rows="5">{{ $item->preview_text }}</textarea>

												@error('preview-text')

													<div class="invalid-feedback" role="alert">
														<span>{{ $message }}</span>
													</div>

												@enderror

											</div>

											<div class="form-group">
												
												<label for="description" class="control-label montserrat-font col-xs-2 font-weight-bold">Подробное описание</label>

												<textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ $item->description }}</textarea>

												@error('description')

													<div class="invalid-feedback" role="alert">
														<span>{{ $message }}</span>
													</div>

												@enderror

											</div>

											<div class="form-group">

												<div class="custom-file">
													<input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image">
													
													<label for="image" class="custom-file-label">Выберите изображение</label>
												</div>

												<div class="col-lg-12 bg-dark mt-1 p-4 text-white">
													{{ $item->image }}
												</div>

												@error('image')
	
													<div class="invalid-feedback" role="alert">
														<span>{{ $message }}</span>
													</div>

												@enderror

											</div>

											<div class="form-group">
												
												<label for="category" class="control-label montserrat-font font-weight-bold col-xs-2">Категория</label>

												
											
												<select name="category" class="custom-select @error('category') is-invalid @enderror">

													@foreach($categories as $category)

														<option value="{{ $category->category_id }}">{{ $category->name }}</option>

													@endforeach

												</select>

												

												<div class="mt-1 p-3 miriam-font text-white bg-dark">
													@foreach($item->categories as $category)

														<p>
															{{ $category->name }}
														</p>

													@endforeach
												</div>

												@error('category')
												
													<div class="invalid-feedback" role="alert">
														<span>{{ $message }}</span>
													</div>

												@enderror

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

					@endforeach

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

	{!! $chart->script() !!}

@endsection