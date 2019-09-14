@if(Request::is('admin/articles-categories'))

        <!-- Back to the categories selection -->
        <div class="col-lg-12 col-md-12 col-12" id="back-to-selection">
           <a href="{{ route('admin.categories') }}">
               <i class="fas fa-chevron-left fa-2x"></i>
           </a>
        </div>

        <!-- Title and the add articles categories button -->
        <div class="col-lg-12 col-12 mb-4">
            <h3 class="text-left mb-4">
                Категории статей
            </h3>
            <button class="btn btn-outline-primary text-uppercase" data-toggle="modal" data-target="#add">
                <small>
                    Создать категорию
                </small>
            </button>
        </div>

        <!-- Table with categories names and edit and delete buttons -->
        <table class="table table-striped dark-theme-item">
            <thead>
                <tr class="text-uppercase">
                    <th><small>Категория</small></th>
                    <th><small>Редактировать</small></th>
                    <th><small>Удалить</small></th>
                </tr>
            </thead>
            <tbody>

            @forelse($articles as $category)

                <tr>
                    <td>
                        <p class="text-light-green montserrat-font">
                            <small>
                                {{ $category->name }}
                            </small>
                        </p>
                    </td>
                    <td>
                        <button class="btn btn-outline-info" data-toggle="modal" data-target="#edit-{{ $category->category_id }}">
                            Редактировать
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-{{ $category->category_id }}">
                            Удалить
                        </button>
                    </td>
                </tr>

            @empty

                <h4 class="text-center">
                    Нет записей
                </h4>

            @endforelse

            </tbody>
        </table>

        <!-- Pagination for table -->
        <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4" id="pagination">
            <ul class="pagination">
                {{ $articles->links() }}
            </ul>
        </div>

        <!-- Modal windows -->
        <!-- Add -->
        <div class="modal fade" role="dialog" tabindex="-1" id="add">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="text-black-50 modal-title">
                            Создание категории
                        </h4>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.categories.store') }}" method="post">

                        @csrf

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category" class="control-label col-xs-2 font-weight-bold montserrat-font">Категория</label>
                                <input type="text" class="form-control" name="category" value="{{ old('category') }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success text-uppercase">
                                <small>
                                    Добавить
                                </small>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit -->
        @foreach($articles as $category)
            <div class="modal fade" role="dialog" tabindex="-1" id="edit-{{ $category->category_id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-black-50 modal-title">
                                Процесс редактирования
                            </h4>
                            <button class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.categories.update', $category->category_id) }}" method="post">

                            @csrf

                            @method('PUT')

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="category" class="control-label col-xs-2 font-weight-bold montserrat-font">Категория</label>
                                    <input type="text" class="form-control" name="category" value="{{ $category->name }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success text-uppercase">
                                    <small>
                                        Редактировать
                                    </small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
  

            <!-- Delete -->
            <div class="modal fade" tabindex="-1" role="dialog" id="delete-{{ $category->category_id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-black-50">
                                Удаление записи
                            </h4>
                            <button class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.categories.delete', $category->category_id) }}" method="post">
                            <div class="modal-body">
                                <h4 class="text-center text-danger">
                                    Вы действительно хотите удалить эту запись???
                                </h4>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success text-uppercase">
                                    <small>
                                        Да
                                    </small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

@elseif(Request::is('admin/news-categories'))

        <!-- Back to the categories selection -->
        <div class="col-lg-12 col-md-12 col-12" id="back-to-selection">
            <a href="{{ route('admin.categories') }}">
                <i class="fas fa-chevron-left fa-2x"></i>
            </a>
        </div>

        <!-- Title and the add news categories button -->
        <div class="col-lg-12 col-12 mb-4">
            <h3 class="text-left mb-4 mt-4">
                Категории новостей
            </h3>
            <button class="btn btn-outline-primary text-uppercase" data-toggle="modal" data-target="#add">
                <small>
                    Создать категорию
                </small>
            </button>
        </div>

        <!-- Table with categories names and with delete and edit buttons -->
        <table class="table table-striped dark-theme-item mt-4">
            <thead>
                <tr class="text-uppercase">
                    <th><small>Категория</small></th>
                    <th><small>Редактировать</small></th>
                    <th><small>Удалить</small></th>
                </tr>
            </thead>
            <tbody>

            @forelse($news as $category)

                <tr>
                    <td>
                        <p class="text-light-green montserrat-font">
                            <small>
                                {{ $category->name }}
                            </small>
                        </p>
                    </td>
                    <td>
                        <button class="btn btn-outline-info" data-toggle="modal" data-target="#edit-{{ $category->category_id }}">
                            Редактировать
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-{{ $category->category_id }}">
                            Удалить
                        </button>
                    </td>
                </tr>

            @empty

                <h4 class="text-center">
                    Нет записей
                </h4>

            @endforelse

            </tbody>
        </table>

        <!-- Pagination for table -->
        <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4" id="pagination">
            <ul class="pagination">
                {{ $news->links() }}
            </ul>
        </div>

        <!-- Modal windows -->
        <!-- Add -->
        <div class="modal fade" role="dialog" tabindex="-1" id="add">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="text-black-50 modal-title">
                            Создание категории
                        </h4>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.categories.store') }}" method="post">

                        @csrf

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category" class="control-label col-xs-2 font-weight-bold montserrat-font">Категория</label>
                                <input type="text" class="form-control" name="category" value="{{ old('category') }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success text-uppercase">
                                <small>
                                    Добавить
                                </small>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit -->
        @foreach($news as $category)
            <div class="modal fade" role="dialog" tabindex="-1" id="edit-{{ $category->category_id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-black-50 modal-title">
                                Процесс редактирования
                            </h4>
                            <button class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.categories.update', $category->category_id) }}" method="post">

                            @csrf

                            @method('PUT')

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="category" class="control-label col-xs-2 font-weight-bold montserrat-font">Категория</label>
                                    <input type="text" class="form-control" name="category" value="{{ $category->name }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success text-uppercase">
                                    <small>
                                        Редактировать
                                    </small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
  

            <!-- Delete -->
            <div class="modal fade" tabindex="-1" role="dialog" id="delete-{{ $category->category_id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-black-50">
                                Удаление записи
                            </h4>
                            <button class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.categories.delete', $category->category_id) }}" method="post">
                            <div class="modal-body">
                                <h4 class="text-center text-danger">
                                    Вы действительно хотите удалить эту запись???
                                </h4>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success text-uppercase">
                                    <small>
                                        Да
                                    </small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

@elseif(Request::is('admin/discussions-categories'))

        <!-- Back to the categories selection -->
        <div class="col-lg-12 col-md-12 col-12" id="back-to-selection">
            <a href="{{ route('admin.categories') }}">
                <i class="fas fa-chevron-left fa-2x"></i>
            </a>
        </div>

        <!-- Title and the add discussions categories button -->
        <div class="col-lg-12 col-12 mb-4">
            <h3 class="text-left mb-4 mt-4">
                Категории обсуждений
            </h3>
            <button class="btn btn-outline-primary text-uppercase" data-toggle="modal" data-target="#add">
                <small>
                    Создать категорию
                </small>
            </button>
        </div>

        <!-- Table with categories names and delete and edit buttons -->
        <table class="table table-striped dark-theme-item mt-4">
            <thead>
                <tr class="text-uppercase">
                    <th><small>Категория</small></th>
                    <th><small>Редактировать</small></th>
                    <th><small>Удалить</small></th>
                </tr>
            </thead>
            <tbody>

            @forelse($discussions as $category)

                <tr>
                    <td>
                        <p class="text-light-green montserrat-font">
                            <small>
                                {{ $category->name }}
                            </small>
                        </p>
                    </td>
                    <td>
                        <button class="btn btn-outline-info" data-toggle="modal" data-target="#edit-{{ $category->category_id }}">
                            Редактировать
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-{{ $category->category_id }}">
                            Удалить
                        </button>
                    </td>
                </tr>

            @empty

                <h4 class="text-center">
                    Нет записей
                </h4>

            @endforelse

            </tbody>
        </table>

        <!-- Pagination for table -->
        <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4" id="pagination">
            <ul class="pagination">
                {{ $discussions->links() }}
            </ul>
        </div>

        <!-- Modal windows -->
        <!-- Add -->
        <div class="modal fade" role="dialog" tabindex="-1" id="add">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="text-black-50 modal-title">
                            Создание категории
                        </h4>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.categories.store') }}" method="post">

                        @csrf

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category" class="control-label col-xs-2 font-weight-bold montserrat-font">Категория</label>
                                <input type="text" class="form-control" name="category" value="{{ old('category') }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success text-uppercase">
                                <small>
                                    Добавить
                                </small>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit -->
        @foreach($discussions as $category)
            <div class="modal fade" role="dialog" tabindex="-1" id="edit-{{ $category->category_id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-black-50 modal-title">
                                Процесс редактирования
                            </h4>
                            <button class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.categories.update', $category->category_id) }}" method="post">

                            @csrf

                            @method('PUT')

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="category" class="control-label col-xs-2 font-weight-bold montserrat-font">Категория</label>
                                    <input type="text" class="form-control" name="category" value="{{ $category->name }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success text-uppercase">
                                    <small>
                                        Редактировать
                                    </small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
  

            <!-- Delete -->
            <div class="modal fade" tabindex="-1" role="dialog" id="delete-{{ $category->category_id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-black-50">
                                Удаление записи
                            </h4>
                            <button class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.categories.delete', $category->category_id) }}" method="post">
                            <div class="modal-body">
                                <h4 class="text-center text-danger">
                                    Вы действительно хотите удалить эту запись???
                                </h4>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success text-uppercase">
                                    <small>
                                        Да
                                    </small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

@else

    {{ abort(404)  }}

@endif
