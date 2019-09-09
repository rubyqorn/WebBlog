@extends('templates.admin.app')

@section('title')

	Таблица с комментариями
	
@endsection

@section('content')

	<!-- Main content -->
	<div class="content container mt-4">
		<div class="row justify-content-center">

			<!-- Stats about news -->
			<div class="col-lg-8 col-md-12 col-12 mt-4 chart">
				{!! $chart->container() !!}
			</div>

			@include('templates.admin.parts.success-message')

			<div class="col-lg-12 col-md-12 col-12 mt-4 p-4 shadow">
				<table class="table table-hover dark-theme-item">
							
					<thead class="text-uppercase">
						<tr>
							<th><small>Комментарии</small></th>
							<th><small>Редактировать</small></th>
							<th><small>Удалить</small></th>
						</tr>
					</thead>

					<tbody>
						
						@forelse($comments as $comment)

							<tr>
								<td>
									<p class="text-light-green">
										<small>
											{{ $comment->comment }}
										</small>
									</p>
								</td>
								<td>
									<div class="form-group">
										<button data-toggle="modal" data-target="#edit-{{ $comment->id }}" class="btn btn-outline-info">Редактировать</button>
									</div>
								</td>
								<td>
									<div class="form-group">
										<button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-{{ $comment->id }}">Удалить</button>
									</div>
								</td>
							</tr>

						@empty

							<h4 class="text-center">
								Нет записей
							</h4>

						@endforelse

					</tbody>


					<!-- Modal windows -->
					<!-- Delete -->
					@foreach($comments as $comment)
						<div class="modal fade" id="delete-{{ $comment->id }}" role="dialog" tabindex="-1">
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
										 <form action="{{ route('comments.destroy', $comment->id) }}" method="post"> 

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
					@foreach($comments as $comment)
						<div class="modal fade" role="dialog" tabindex="-1" id="edit-{{ $comment->id }}">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="text-black-50">Редактирование записи</h4>
										<button class="close" data-dismiss="modal">
											<span>&times;</span>
										</button>
									</div>
									<form action="{{ route('comments.update', $comment->id) }}" method="post" enctype="multipart/form-data">
										
										@csrf

										@method('PUT')

										<div class="modal-body">

											<div class="form-group">
												
												<label for="response" class="control-label col-xs-2 font-weight-bold montserrat-font">Комментарий</label>

												<textarea name="response" class="form-control @error('title') is-invalid @enderror" rows="10" cols="5">{{ $comment->comment }}</textarea>

												@error('comment')

													<div class="invalid-feedback" role="alert">
														<span>{{ $message }}</span>
													</div>

												@enderror

											</div>


											<div class="form-group">
												
												<label for="article-id" class="control-label col-xs-2 font-weight-bold montserrat-font">Идентификатор статьи</label>

												<input type="text" class="form-control" name="article-id" value="{{ $comment->article_id }}" disabled>

											</div>

											<div class="form-group">
												
												<label for="user-id" class="control-label col-xs-2 font-weight-bold montserrat-font">Идентификатор пользователя</label>

												<input type="text" class="form-control" name="user-id" value="{{ $comment->user_id }}" disabled>

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
					{{ $comments->links() }}
				</ul>
			</div>

		</div>
	</div>

	{!! $chart->script() !!}


@endsection
