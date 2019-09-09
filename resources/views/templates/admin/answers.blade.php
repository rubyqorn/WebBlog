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
				{!! $chart->container() !!}
			</div>

			@include('templates.admin.parts.success-message')

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

						@forelse($answers as $answer)

							<tr>
								<td>
									<p class="text-light-green">
										<small>
											{{ $answer->answer }}
										</small>
									</p>
								</td>
								<td>
									<div class="form-group">
										<button data-toggle="modal" data-target="#edit-{{ $answer->id }}" class="btn btn-outline-info text">Редактировать</button>
									</div>
								</td>
								<td>
									<div class="form-group">
										<button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-{{ $answer->id }}">Удалить</button>
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
					@foreach($answers as $answer)
					<div class="modal fade" id="delete-{{ $answer->id }}" role="dialog" tabindex="-1">
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
									<form action="{{ route('answers.destroy', $answer->id) }}" method="post">

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
					@foreach($answers as $answer)
						<div class="modal fade" role="dialog" tabindex="-1" id="edit-{{ $answer->id }}">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="text-black-50">Редактирование записи</h4>
										<button class="close" data-dismiss="modal">
											<span>&times;</span>
										</button>
									</div>
									<form action="{{ route('answers.update', $answer->id) }}" method="post" enctype="multipart/form-data">

										@csrf

										@method('PUT')

										<div class="modal-body">

											<div class="form-group">
												
												<label for="answer" class="control-label col-xs-2 font-weight-bold montserrat-font">Вопрос</label>

												<textarea name="response" class="form-control @error('response') is-invalid @enderror" cols="10" rows="5">{{ $answer->answer }}</textarea>

												@error('response')

													<div class="invalid-feedback" roe="alert">
														<span>{{ $message }}</span>
													</div>

												@enderror

											</div>


											<div class="form-group">
												
												<label for="article-id" class="control-label col-xs-2 font-weight-bold montserrat-font">Идентификатор вопроса</label>

												<input type="text" class="form-control" name="article-id" value="{{ $answer->discussion_id }}" disabled>

											</div>

											<div class="form-group">
												
												<label for="user-id" class="control-label col-xs-2 font-weight-bold montserrat-font">Идентификатор пользователя</label>

												<input type="text" class="form-control" name="user-id" value="{{ $answer->user_id }}" disabled>

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
					{{ $answers->links() }}
				</ul>
			</div>

		</div>
	</div>

	{!! $chart->script() !!}

@endsection