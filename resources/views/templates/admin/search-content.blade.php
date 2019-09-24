@extends('templates.admin.app')

@section('title', 'Поиск записей')

@section('content')


    @if(Request::is('admin/articles/search'))
        <div class="container content mt-4">
            <div class="col-lg-12 col-md-12 col-12 mt-4">
                <h5 class="raleway-font">
                    <a href="{{ route('articles.index') }}" class="text-decoration-none text-secondary">
                        <i class="fas fa-chevron-left fa-lg"></i>
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
                    <table class="table table-hover dark-theme-item">
                        <thead>
                            <tr class="text-uppercase">
                                <th><small>Заголовок</small></th>
                                <th><small>Редактировать</small></th>
                                <th><small>Удалить</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($articles as $article)
                                <tr>
                                    <td>
                                        <a href="{{ route('article', $article->id) }}" class="text-light-green">
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
                        <ul class="pagination">
                            {{ $articles->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    @elseif(Request::is('admin/news/search'))

    <div class="container content mt-4">
        <div class="col-lg-12 col-md-12 col-12 mt-4">
            <h5 class="raleway-font">
                <a href="{{ route('news.index') }}" class="text-decoration-none text-secondary">
                    <i class="fas fa-chevron-left fa-lg"></i>
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
                <table class="table table-hover dark-theme-item">
                    <thead>
                        <tr class="text-uppercase">
                            <th><small>Заголовок</small></th>
                            <th><small>Редактировать</small></th>
                            <th><small>Удалить</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('news', $item->id) }}" class="text-light-green">
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
                                            
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $item->title }}">

                                                @error('title')

                                                    <div class="invalid-feedback" role="alert">
                                                        <span>{{ $message }}</span>
                                                    </div>

                                                @enderror

                                            </div>

                                            <div class="form-group">
                                                
                                                <label for="description" class="control-label font-weight-bold col-xs-2 montserrat-font">Подробное описание</label>

                                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ $item->description }}</textarea>

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
                                                        {{ $item->image }}
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
                    <ul class="pagination">
                        {{ $news->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @elseif(Request::is('admin/discussions/search'))

    <div class="container content mt-4">
            <div class="col-lg-12 col-md-12 col-12 mt-4">
                <h5 class="raleway-font">
                    <a href="{{ route('discussions.index') }}" class="text-decoration-none text-secondary">
                        <i class="fas fa-chevron-left fa-lg"></i>
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
                    <table class="table table-hover dark-theme-item">
                        <thead>
                            <tr class="text-uppercase">
                                <th><small>Заголовок</small></th>
                                <th><small>Редактировать</small></th>
                                <th><small>Удалить</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($discussions as $discussion)
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
                                                
                                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $discussion->title }}">

                                                    @error('title')

                                                        <div class="invalid-feedback" role="alert">
                                                            <span>{{ $message }}</span>
                                                        </div>

                                                    @enderror

                                                </div>

                                                <div class="form-group">
                                                    
                                                    <label for="description" class="control-label font-weight-bold col-xs-2 montserrat-font">Подробное описание</label>

                                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ $discussion->description }}</textarea>

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
                                                            {{ $discussion->image }}
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
                        <ul class="pagination">
                            {{ $discussions->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    @else

        {{ abort(404) }}

    @endif

@endsection