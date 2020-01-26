@extends('templates.admin.app')

@section('title')

	Таблица статей

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
							<strong>Articles</strong> Table
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

			<div class="col-lg-12 col-sm-12 col-md-12 d-flex justify-content-between">
				<!-- Add new record button -->
				<div class="col-lg-3 mt-4">
					<button class="btn btn-outline-primary text-uppercase btn-sm float-right mt-1" data-toggle="modal" data-target="#create">
						Создать новую запись
					</button>
				</div>

				<div class="col-lg-9 col-md-7 col-12 mt-4 mb-4 d-flex text-black-50" id="search-form">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<form action="{{ route('admin.articles.search') }}">
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
						<form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">

							@csrf

							<div class="modal-body">

								<div class="form-group">

									<label for="title" class="control-label col-xs-2 font-weight-bold text-black-50 montserrat-font">Заголовок</label>

									<textarea name="title" class="form-control @error('title') is-invalid @enderror" cols="30" rows="3">
										{{ old('title') }}
									</textarea>

									@error('title')

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

										<input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror">

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

			@include('templates.parts.alert')

			<div class="col-lg-12 col-md-12 col-12 mt-4 p-4 shadow">
				<table class="table table-hover table-dark">
							
					<thead>
						<tr class="text-uppercase">
							<th>#</th>
							<th><small>Заголовок</small></th>
							<th><small>Редактировать</small></th>
							<th><small>Удалить</small></th>
						</tr>
					</thead>

					<tbody>

						@forelse($articles as $article)

							<tr>
								<td>
									<p class="text-muted">
										{{ $article->id }}
									</p>
								</td>
								<td>
									<a href="{{ route('article', $article->id) }}" class="text-muted h5">
										<small>
											{{ $article->title }}
										</small>
									</a>
								</td>
								<td>
									<div class="form-group">
										<button data-toggle="modal" data-target="#edit-{{ $article->id }}" class="btn btn-outline-info">Редактировать</button>
									</div>
								</td>
								<td>
									<div class="form-group">
										<button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-{{ $article->id }}">Удалить</button>
									</div>
								</td>
							</tr>

						@empty

							<h4 class="text-center">
								Нет статей
							</h4>

						@endforelse
		
					</tbody>


					<!-- Modal windows -->
					<!-- Delete -->
					@foreach($articles as $article)

						<div class="modal fade" id="delete-{{ $article->id }}" role="dialog" tabindex="-1">
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


										<form action="{{ route('articles.destroy', $article->id) }}" method="post">

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
					@foreach($articles as $article)

					<div class="modal fade" role="dialog" tabindex="-1" id="edit-{{ $article->id }}">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title text-black-50">
										Редактирование записи
									</h4>
									<button class="close" data-dismiss="modal">
										<span>&times;</span>
									</button>
								</div>
								<form action="{{ route('articles.update', $article->id) }}" method="post" enctype="multipart/form-data">

									@csrf

									@method('PATCH')

									<div class="modal-body">

										<div class="form-group">

											<label for="title" class="control-label col-xs-2 font-weight-bold montserrat-font">Заголовок</label>
										
											<textarea name="title" class="form-control @error('title') is-invalid @enderror" cols="30" rows="3">
												{{ $article->title }}
											</textarea>


											@error('title')

												<div class="invalid-feedback" role="alert">
													<span>{{ $message }}</span>
												</div>

											@enderror

										</div>

										<div class="form-group">
											
											<label for="description" class="control-label font-weight-bold col-xs-2 montserrat-font">Подробное описание</label>

											<textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ $article->description }}</textarea>

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
												<input type="file" class="custom-file-input @error('image') is-invalid @enderror" value="" name="image">

												<label for="image" class="custom-file-label">Выберите изображение</label>

												<div class="col-lg-4 mt-1 mb-3 p-3 text-white border">
													<!-- <img src="{{ $article->image }}" alt="" class="w-100"> -->
												</div>

												@error('description')

													<div class="invalid-feedback" role="alert">
														<span>{{ $message }}</span>
													</div>

												@enderror

											</div>

										</div>

										<div class="form-group pt-3">
											
											<label for="category" class="control-label col-xs-2 font-weight-bold montserrat-font">Категория</label>

											<select name="category" class="custom-select @error('category') is-invalid @enderror">

												@foreach($categories as $category)

													<option value="{{ $category->category_id }}">{{ $category->name }}</option>

												@endforeach

											</select>

											<div class="col-lg-4 mt-1 text-white bg-dark p-3">
												@foreach($categories as $category)

													{{ $category->name }}

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
										<button type="submit" class="btn btn-outline-info montserrat-font text-uppercase">
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
				{{ $articles->links() }}
			</div>

		</div>
	</div>

	{!! $chart->script() !!}

@endsection