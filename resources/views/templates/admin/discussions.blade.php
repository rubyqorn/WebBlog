@extends('templates.admin.app')

@section('title')

	Таблица вопросов

@endsection

@section('content')

	<!-- Main content -->
	<div class="content container">
		<div class="row justify-content-center">

			<div class="col-lg-12 col-xs-12 p-4 d-flex justify-content-between bg-grey">
				<div class="greeting">
					
					<a href="{{ Request::path() }}" class="text-muted">
						<small>
							{{ Breadcrumbs::render(Request::path()) }}
						</small>
					</a>
					
					<div class="d-flex">
						<i class="fas fa-table text-muted mt-1 mr-2"></i>
						<p class="h4 text-muted nunito-font">
							<strong>Discussions</strong> Table
						</p>
					</div>
				</div>
				<div class="date">
					<p class="text-black-50 font-weight-bold montserrat-font">
						{{ $currentDate }}
					</p>
				</div>
			</div>

			<!-- Stats about news -->
			<div class="col-lg-8 col-md-12 col-12 mt-4 bg-white p-3 shadow">
				{!! $chart->container() !!}
			</div>

			@include('templates.parts.alert')

			<div class="col-lg-12 col-sm-12 col-md-12 d-flex justify-content-between">
				<!-- Add new record button -->
				<div class="col-lg-3 mt-4">
					<button class="btn btn-outline-primary text-uppercase btn-sm float-right mt-1" data-toggle="modal" data-target="#create">
						Создать новую запись
					</button>
				</div>

				<!-- Search form -->
				<div class="col-lg-9 col-md-7 col-12 mt-4 mb-4 d-flex text-black-50" id="search-form">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<form action="{{ route('admin.discussions.search') }}">
							<div class="form-group d-flex">
								<input type="search" class="form-control" name="search" placeholder="Search">
								<button type="submit" class="btn btn-outline-success text-uppercase">
									<small>
										Search
									</small>
								</button>
							</div>
						</form>
					</div>
				</div>
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
						<form action="{{ route('discussions.store') }}" method="post" enctype="multipart/form-data">

							@csrf

							<div class="modal-body">

								<div class="form-group">

									<label for="discussion" class="control-label col-xs-2 font-weight-bold text-black-50 montserrat-font">Вопрос</label>

									<textarea name="title" class="form-control @error('title') is-invalid @enderror" cols="30" rows="3"></textarea>

									@error('title')

										<div class="invalid-feedback" role="alert">
											<span>{{ $message }}</span>
										</div>

									@enderror

								</div>

								<div class="form-group">
									
									<label for="description" class="control-label col-xs-2 font-weight-bold text-black-50 montserrat-font">Подробное описание</label>

									<textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">
										{{ old('description') }}
									</textarea>

									<script>
										CKEDITOR.replace('description')
									</script>

									@error('descripition')

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
									
									<lable class="control-label col-xs-2 font-weight-bold text-black-50">Категория</lable>

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
				<table class="table table-hover table-dark">
							
					<thead class="text-uppercase montserrat-font">
						<tr>
							<th>#</th>
							<th><small>Заголовок</small></th>
							<th><small>Редактировать</small></th>
							<th><small>Удалить</small></th>
						</tr>
					</thead>

					<tbody>

						@foreach($discussions as $discussion)

							<tr>
								<td>
									<p class="text-muted">
										{{ $discussion->id }}
									</p>
								</td>
								<td>
									<a href="{{ route('discussion', $discussion->id) }}" class="text-muted h5">
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
									<form action="{{ route('discussions.update', $discussion->id) }}" method="post" enctype="multipart/form-data">

										@csrf

										@method('PATCH')

										<div class="modal-body">

											<div class="form-group">
												
												<label for="title" class="control-label col-xs-2 font-weight-bold montserrat-font">Вопрос</label>

												<textarea name="title" class="form-control @error('title') is-invalid @enderror" cols="30" rows="3">
													{{ $discussion->title }}
												</textarea>

												@error('title')
														
													<div class="invalid-feedback" role="alert">
														<span>{{ $message }}</span>
													</div>

												@enderror

											</div>

											<div class="form-group">
												
												<label for="description" class="control-label font-weight-bold montserrat-font col-xs-2">Подробное описание</label>

												<textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">
													{{ $discussion->description }}
												</textarea>

												<script>
													CKEDITOR.replace('description')
												</script>

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

													<div class="text-white border mt-1 col-lg-3">
														<img src="{{ asset('/assets/img/' . $discussion->image) }}" alt="">
													</div>

													@error('image')

														<div class="invalid-feedback" role="alert">
															<span>{{ $message }}</span>
														</div>

													@enderror
												
												</div>

											</div>

											<div class="form-group">
												
												<label for="category" class="control-label col-xs-2 font-weight-bold montserrat-font">Категория</label>

												<select name="category" class="custom-select @error('category') is-invalid @enderror">
													
													@foreach($categories as $category)

														<option value="{{ $category->category_id }}">{{ $category->name }}</option>

													@endforeach
												
												</select>

												<div class="text-white bg-dark p-1 mt-1 col-lg-3">

													{{ $discussion->category->name }}
												
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
				{{ $discussions->links() }}
			</div>

		</div>
	</div>

	{!! $chart->script() !!}

@endsection