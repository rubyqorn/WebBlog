@extends('templates.admin.app')

@section('title', 'Поиск записей')

@section('content')


    @if(Request::is('admin/articles/search'))
        <div class="container content">

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
							<strong>Articles</strong> Searching
						</p>
					</div>
				</div>
				<div class="date">
					<p class="text-black-50 font-weight-bold montserrat-font">
						{{ $currentDate }}
					</p>
				</div>
			</div>

            <div class="col-lg-12 col-md-12 col-12 mt-4">
                <h5 class="raleway-font">
                    <a href="{{ route('articles.index') }}" class="text-decoration-none text-secondary">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </h5>
            </div>

            <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4 p-4">
                <h4 class="montsserat-font">
                    Результаты поиска:
                </h4>
                <hr class="w-50 float-left">
            </div>

            <div class="mt-4 mb-4">
                <div class="col-lg-12 col-md-12 col-12 p-4 shadow">
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

                                <!-- Modals -->
                                <!-- Delete -->
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

                            <!-- Edit -->
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
                                                
                                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $article->title }}">

                                                    @error('title')

                                                        <div class="invalid-feedback" role="alert">
                                                            <span>{{ $message }}</span>
                                                        </div>

                                                    @enderror

                                                </div>

                                                <div class="form-group">
                                                    
                                                    <label for="description" class="control-label font-weight-bold col-xs-2 montserrat-font">Подробное описание</label>

                                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ $article->description }}</textarea>

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

                                                        <div class="col-lg-12 bg-dark mt-1 mb-3 p-3 text-white">
                                                            {{ $article->image }}
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

                                                    <div class="col-lg-12 mt-1 text-white bg-dark p-3">
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

                            @empty
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <h3 class="text-center text-uppercase text-black-50">
                                        <small>
                                            Ничего не найдено
                                        </small>
                                    </h3>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-12" id="pagination">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>


    @elseif(Request::is('admin/news/search'))

    <div class="container content">
        <div class="col-lg-12 col-xs-12 p-4 d-flex justify-content-between bg-grey">
            <div class="greeting">
                
                <a href="{{ Request::path() }}" class="text-muted">
                    <small>
                        {{ Breadcrumbs::render(Request::path()) }}
                    </small>
                </a>
                
                <div class="d-flex">
                    <i class="fas fa-search text-muted mt-1 mr-2"></i>
                    <p class="h4 text-muted nunito-font">
                        <strong>News</strong> Searching
                    </p>
                </div>
            </div>
            <div class="date">
                <p class="text-black-50 font-weight-bold montserrat-font">
                    {{ $currentDate }}
                </p>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-12 mt-4">
            <h5 class="raleway-font">
                <a href="{{ route('news.index') }}" class="text-decoration-none text-secondary">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </h5>
        </div>

        <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4 p-4">
            <h4 class="montsserat-font">
                Результаты поиска:
            </h4>
            <hr class="w-50 float-left">
        </div>

        <div class="mt-4 mb-4">
            <div class="col-lg-12 col-md-12 col-12 p-4 shadow">
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
                        @forelse($news as $item)
                            <tr>
                                <td>
                                    <p class="text-muted">
                                        {{ $item->id }}
                                    </p>
                                </td>
                                <td>
                                    <a href="{{ route('news', $item->id) }}" class="text-muted h5">
                                        <small>
                                            {{ $item->title }}
                                        </small>
                                    </a>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <button data-toggle="modal" data-target="#edit-{{ $item->id }}" class="btn btn-outline-info">Редактировать</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-{{ $item->id }}">Удалить</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modals -->
                            <!-- Delete -->
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

                        <!-- Edit -->
                        <div class="modal fade" role="dialog" tabindex="-1" id="edit-{{ $item->id }}">
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
                                    <form action="{{ route('news.update', $item->id) }}" method="post" enctype="multipart/form-data">

                                        @csrf

                                        @method('PATCH')

                                        <div class="modal-body">

                                            <div class="form-group">

                                                <label for="title" class="control-label col-xs-2 font-weight-bold montserrat-font">Заголовок</label>
                                            
                                                <textarea name="title" class="form-control @error('title') is-invalid @enderror" id="title" cols="30" rows="3">
                                                    {{ $item->title }}
                                                </textarea>

                                                @error('title')

                                                    <div class="invalid-feedback" role="alert">
                                                        <span>{{ $message }}</span>
                                                    </div>

                                                @enderror

                                            </div>

                                            <div class="form-group">
                                                <label for="preview_text" class="control-label col-xs-2 font-weight-bold montserrat-font">
                                                    Пролог
                                                </label>
                                                <textarea name="preview_text" id="preview_text" class="form-control @error('preview_text') is-invalid @enderror" cols="30" rows="5">
                                                    {{ $item->preview_text }}
                                                </textarea>

                                                <script>
                                                    CKEDITOR.replace('preview_text')
                                                </script>

                                                @error('preview_text')
                                                    <div class="is-invalid" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                
                                                <label for="description" class="control-label font-weight-bold col-xs-2 montserrat-font">Подробное описание</label>

                                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ $item->description }}</textarea>

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

                                                    <div class="col-lg-3 mt-1 mb-3 p-3 text-white">
                                                        <img src="{{ asset('/assets/img/' . $item->image) }}" alt="">
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

                                                <div class="col-lg-3 mt-1 text-white bg-dark p-1">
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

                        @empty
                            <div class="col-lg-12 col-sm-12 col-12">
                                <h3 class="text-center text-uppercase text-black-50">
                                    <small>
                                        Ничего не найдено
                                    </small>
                                </h3>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-12" id="pagination">
                    {{ $news->links() }}
                </div>
            </div>
        </div>
    </div>

    @elseif(Request::is('admin/discussions/search'))

        <div class="container content">
            <div class="col-lg-12 col-xs-12 p-4 d-flex justify-content-between bg-grey">
                <div class="greeting">
                    
                    <a href="{{ Request::path() }}" class="text-muted">
                        <small>
                            {{ Breadcrumbs::render(Request::path()) }}
                        </small>
                    </a>
                    
                    <div class="d-flex">
                        <i class="fas fa-search text-muted mt-1 mr-2"></i>
                        <p class="h4 text-muted nunito-font">
                            <strong>Discussions</strong> Searching
                        </p>
                    </div>
                </div>
                <div class="date">
                    <p class="text-black-50 font-weight-bold montserrat-font">
                        {{ $currentDate }}
                    </p>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-12 mt-4">
                <h5 class="raleway-font">
                    <a href="{{ route('discussions.index') }}" class="text-decoration-none text-secondary">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </h5>
            </div>

            <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4 p-4">
                <h4 class="montsserat-font">
                    Результаты поиска:
                </h4>
                <hr class="w-50 float-left">
            </div>

            <div class="mt-4 mb-4">
                <div class="col-lg-12 col-md-12 col-12 p-4 shadow">
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
                            @forelse($discussions as $discussion)
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

                                <!-- Modals -->
                                <!-- Delete -->
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

                            <!-- Edit -->
                            <div class="modal fade" role="dialog" tabindex="-1" id="edit-{{ $discussion->id }}">
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
                                        <form action="{{ route('discussions.update', $discussion->id) }}" method="post" enctype="multipart/form-data">

                                            @csrf

                                            @method('PATCH')

                                            <div class="modal-body">

                                                <div class="form-group">

                                                    <label for="title" class="control-label col-xs-2 font-weight-bold montserrat-font">Заголовок</label>
                                                
                                                    <textarea name="title" id="title" class="form-control @error('title') is-invalid @enderror" cols="30" rows="5">
                                                        {{ $discussion->title }}
                                                    </textarea>

                                                    @error('title')

                                                        <div class="invalid-feedback" role="alert">
                                                            <span>{{ $message }}</span>
                                                        </div>

                                                    @enderror

                                                </div>

                                                <div class="form-group">
                                                    
                                                    <label for="description" class="control-label font-weight-bold col-xs-2 montserrat-font">Подробное описание</label>

                                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ $discussion->description }}</textarea>

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

                                                        <div class="col-lg-3 border mt-1 mb-3 p-3 text-white">
                                                            <img src="{{ asset('assets/img/' . $discussion->image) }}" alt="">
                                                        </div>

                                                        @error('image')

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

                                                    <div class="col-lg-3 mt-1 text-white bg-dark p-1">
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

                            @empty
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <h3 class="text-center text-uppercase text-black-50">
                                        <small>
                                            Ничего не найдено
                                        </small>
                                    </h3>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-12" id="pagination">
                        {{ $discussions->links() }}
                    </div>
                </div>
            </div>
        </div>

    @elseif(Request::is('admin/answers/search'))

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-xs-12 p-4 d-flex justify-content-between bg-grey">
                    <div class="greeting">
                        
                        <a href="{{ Request::path() }}" class="text-muted">
                            <small>
                                {{ Breadcrumbs::render(Request::path()) }}
                            </small>
                        </a>
                        
                        <div class="d-flex">
                            <i class="fas fa-search text-muted mt-1 mr-2"></i>
                            <p class="h4 text-muted nunito-font">
                                <strong>Answers</strong> Searching
                            </p>
                        </div>
                    </div>
                    <div class="date">
                        <p class="text-black-50 font-weight-bold montserrat-font">
                            {{ $currentDate }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4" id="back-to-selection">
                <a href="{{ route('admin.answers') }}">
                    <i class="fas fa-chevron-left text-muted"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 mt-4 p-3 shadow bg-white">
            <table class="table table-striped table-dark">
                <thead class="text-uppercase">
                    <tr>
                        <th>#</th>
                        <th><small>Заголовок</small></th>
                        <th><small>ID Обсуждения</small></th>
                        <th><small>Редактировать</small></th>
                        <th><small>Удалить</small></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($answers as $answer)

                        <tr>
                            <td>
                                <p class="text-muted">
                                    {{ $answer->id }}
                                </p>
                            </td>
                            <td>
                                <p class="text-muted h5">
                                    <small>
                                        {{ $answer->answer }}
                                    </small>
                                </p>
                            </td>
                            <td>
                                <p class="text-muted">
                                    {{ $answer->discussion->id }}   
                                </p>
                            </td>
                            <td>
                                <button class="btn btn-outline-success" data-toggle="modal" data-target="#edit-{{ $answer->id }}">
                                    Edit
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-{{ $answer->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Modal windows -->
                        <!-- Edit -->

                        <div class="modal fade" id="edit-{{ $answer->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="text-muted nunito-font">
                                            Редактирование записи
                                        </h4>
                                        <button class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('answers.update', $answer->id) }}" method="post">

                                            @csrf 

                                            @method('PUT')

                                            <div class="form-group">
                                                <textarea name="response" class="form-control @error('response') is-invalid @enderror" id="response" cols="30" rows="10">
                                                    {{ $answer->answer }}
                                                </textarea>            
        
                                                @error('response')

                                                    <div class="is-invalid" role="alert">
                                                        {{ $message }}
                                                    </div>

                                                @enderror

                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="float-right btn btn-outline-success text-uppercase">
                                                    <small>
                                                        Редактировать
                                                    </small>
                                                </button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" role="modal" id="delete-{{ $answer->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="text-muted nunito-font">
                                            Процесс удаления
                                        </h4>
                                        <button class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('answers.destroy', $answer->id) }}" method="post">
                                            
                                            @csrf

                                            @method('DELETE')
                                        
                                            <div class="form-group">
                                                <h4 class="text-danger nunito-font text-center">
                                                    Вы действительно хотите удалить эту запись?
                                                </h4>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="float-right text-uppercase btn btn-outline-success">
                                                    <small>
                                                        Да
                                                    </small>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="col-lg-12 col-sm-12 col-12">
                            <h3 class="text-center text-uppercase text-black-50">
                                <small>
                                    Ничего не найдено
                                </small>
                            </h3>
                        </div>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
            {{ $answers->links() }}
        </div>

    @elseif(Request::is('admin/comments/search'))

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-xs-12 p-4 d-flex justify-content-between bg-grey">
                    <div class="greeting">
                        
                        <a href="{{ Request::path() }}" class="text-muted">
                            <small>
                                {{ Breadcrumbs::render(Request::path()) }}
                            </small>
                        </a>
                        
                        <div class="d-flex">
                            <i class="fas fa-search text-muted mt-1 mr-2"></i>
                            <p class="h4 text-muted nunito-font">
                                <strong>Comments</strong> Searching
                            </p>
                        </div>
                    </div>
                    <div class="date">
                        <p class="text-black-50 font-weight-bold montserrat-font">
                            {{ $currentDate }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4" id="back-to-selection">
                <a href="{{ route('admin.comments') }}">
                    <i class="fas fa-chevron-left text-muted"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 mt-4 p-3 shadow bg-white">
            <table class="table table-striped table-dark">
                <thead class="text-uppercase">
                    <tr>
                        <th>#</th>
                        <th><small>Заголовок</small></th>
                        <th><small>ID записи</small></th>
                        <th><small>Редактировать</small></th>
                        <th><small>Удалить</small></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $comment)

                        <tr>
                            <td>
                                <p class="text-muted">
                                    {{ $comment->id }}
                                </p>
                            </td>
                            <td>
                                <p class="text-muted h5">
                                    <small>
                                        {{ $comment->comment }}
                                    </small>
                                </p>
                            </td>
                            <td>
                                <p class="text-muted">
                                    {{ $comment->article->id }}   
                                </p>
                            </td>
                            <td>
                                <button class="btn btn-outline-success" data-toggle="modal" data-target="#edit-{{ $comment->id }}">
                                    Edit
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-{{ $comment->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Modal windows -->
                        <!-- Edit -->

                        <div class="modal fade" id="edit-{{ $comment->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="text-muted nunito-font">
                                            Редактирование записи
                                        </h4>
                                        <button class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('comments.update', $comment->id) }}" method="post">

                                            @csrf 

                                            @method('PUT')

                                            <div class="form-group">
                                                <textarea name="comment" class="form-control @error('response') is-invalid @enderror" id="response" cols="30" rows="10">
                                                    {{ $comment->comment }}
                                                </textarea>            
        
                                                @error('response')

                                                    <div class="is-invalid" role="alert">
                                                        {{ $message }}
                                                    </div>

                                                @enderror

                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="float-right btn btn-outline-success text-uppercase">
                                                    <small>
                                                        Редактировать
                                                    </small>
                                                </button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" role="modal" id="delete-{{ $comment->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="text-muted nunito-font">
                                            Процесс удаления
                                        </h4>
                                        <button class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                                            
                                            @csrf

                                            @method('DELETE')
                                        
                                            <div class="form-group">
                                                <h4 class="text-danger nunito-font text-center">
                                                    Вы действительно хотите удалить эту запись?
                                                </h4>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="float-right text-uppercase btn btn-outline-success">
                                                    <small>
                                                        Да
                                                    </small>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="col-lg-12 col-sm-12 col-12">
                            <h3 class="text-center text-uppercase text-black-50">
                                <small>
                                    Ничего не найдено
                                </small>
                            </h3>
                        </div>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
            {{ $comments->links() }}
        </div>


    @else

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-7 text-center col-sm-12 p-4"  id="error-message">
                    <p class="display-3 nunito-font text-muted">
                        Something went wrong. You should come back.
                    </p>
                </div>
            </div>
        </div>

    @endif

@endsection