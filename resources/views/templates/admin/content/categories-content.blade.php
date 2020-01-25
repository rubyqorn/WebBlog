@if(Request::is('admin/articles-categories'))

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
                        <strong>Articles Categories</strong> Table
                    </p>
                </div>
            </div>
            <div class="date">
                <p class="text-black-50 font-weight-bold montserrat-font">
                    20 JAN 2020
                </p>
            </div>
        </div>

        <!-- Back to the categories selection -->
        <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4" id="back-to-selection">
           <a href="{{ route('admin.categories') }}">
               <i class="fas fa-chevron-left text-muted"></i>
           </a>
        </div>

        <!-- Title and the add articles categories button -->
        <div class="col-lg-12 col-12 mb-4">
            <button class="btn btn-outline-primary text-uppercase" data-toggle="modal" data-target="#add">
                <small>
                    Создать категорию
                </small>
            </button>
        </div>

        <!-- Table with categories names and edit and delete buttons -->
        <div class="col-lg-12 col-sm-12 col-md-12 shadow bg-white p-3">
            <table class="table table-striped table-dark">
                <thead>
                    <tr class="text-uppercase">
                        <th>#</th>
                        <th><small>Категория</small></th>
                        <th><small>Редактировать</small></th>
                        <th><small>Удалить</small></th>
                    </tr>
                </thead>
                <tbody>

                @forelse($articles as $category)

                    <tr>
                        <td>
                            <p class="text-muted">
                                {{ $category->category_id }}
                            </p>
                        </td>
                        <td>
                            <p class="text-muted h5 montserrat-font">
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
        </div>

        <!-- Pagination for table -->
        <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4" id="pagination">
            {{ $articles->links() }}
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
                    <form action="{{ route('admin.articles.categories.store') }}" method="post">

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
                        <form action="{{ route('admin.articles.categories.update', $category->category_id) }}" method="post">

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
                        <form action="{{ route('admin.articles.categories.delete', $category->category_id) }}" method="post">
                            
                            @csrf

                            @method('DELETE')
                            
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
                        <strong>News Categories</strong> Table
                    </p>
                </div>
            </div>
            <div class="date">
                <p class="text-black-50 font-weight-bold montserrat-font">
                    20 JAN 2020
                </p>
            </div>
        </div>

        <!-- Back to the categories selection -->
        <div class="col-lg-12 col-md-12 col-12 mt-2 mb-3" id="back-to-selection">
            <a href="{{ route('admin.categories') }}">
                <i class="fas fa-chevron-left text-muted"></i>
            </a>
        </div>

        <!-- Title and the add news categories button -->
        <div class="col-lg-12 col-12 mb-4">
            <button class="btn btn-outline-primary text-uppercase" data-toggle="modal" data-target="#add">
                <small>
                    Создать категорию
                </small>
            </button>
        </div>

        <!-- Table with categories names and with delete and edit buttons -->
        <div class="col-lg-12 col-md-12 col-sm-12 shadow bg-white p-3">
            <table class="table table-striped table-dark mt-4">
                <thead>
                    <tr class="text-uppercase">
                        <th>#</th>
                        <th><small>Категория</small></th>
                        <th><small>Редактировать</small></th>
                        <th><small>Удалить</small></th>
                    </tr>
                </thead>
                <tbody>

                @forelse($news as $category)

                    <tr>
                        <td>
                            <p class="text-muted">
                                {{ $category->category_id }}
                            </p>
                        </td>
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
        </div>

        <!-- Pagination for table -->
        <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4" id="pagination">
            {{ $news->links() }}
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
                    <form action="{{ route('admin.news.categories.store') }}" method="post">

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
                        <form action="{{ route('admin.news.categories.update', $category->category_id) }}" method="post">

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
                        <form action="{{ route('admin.news.categories.delete', $category->category_id) }}" method="post">

                            @csrf

                            @method('DELETE')    
                            
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
                        <strong>Discussions Categories</strong> Table
                    </p>
                </div>
            </div>
            <div class="date">
                <p class="text-black-50 font-weight-bold montserrat-font">
                    20 JAN 2020
                </p>
            </div>
        </div>


        <!-- Back to the categories selection -->
        <div class="col-lg-12 col-md-12 col-12 mt-2 mb-3" id="back-to-selection">
            <a href="{{ route('admin.categories') }}">
                <i class="fas fa-chevron-left text-muted"></i>
            </a>
        </div>

        <!-- Title and the add discussions categories button -->
        <div class="col-lg-12 col-12 mb-4">
            <button class="btn btn-outline-primary text-uppercase" data-toggle="modal" data-target="#add">
                <small>
                    Создать категорию
                </small>
            </button>
        </div>

        <!-- Table with categories names and delete and edit buttons -->
        <div class="col-lg-12 col-md-12 col-sm-12 shadow bg-white p-3">
            <table class="table table-striped table-dark mt-4">
                <thead>
                    <tr class="text-uppercase">
                        <th>#</th>
                        <th><small>Категория</small></th>
                        <th><small>Редактировать</small></th>
                        <th><small>Удалить</small></th>
                    </tr>
                </thead>
                <tbody>

                @forelse($discussions as $category)

                    <tr>
                        <td>
                            <p class="text-muted">
                                {{ $category->category_id }}
                            </p>
                        </td>
                        <td>
                            <p class="text-muted h5 montserrat-font">
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
        </div>

        <!-- Pagination for table -->
        <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4" id="pagination">
            {{ $discussions->links() }}
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
                    <form action="{{ route('admin.discussions.categories.store') }}" method="post">

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
                        <form action="{{ route('admin.discussions.categories.update', $category->category_id) }}" method="post">

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
                        <form action="{{ route('admin.discussions.categories.delete', $category->category_id) }}" method="post">
                           
                           @csrf

                           @method('DELETE')
                           
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
