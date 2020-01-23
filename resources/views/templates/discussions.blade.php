@extends('templates.app')

@section('title')
	Обсуждения
@endsection

@section('content')

  <div class="col-lg-3 col-md-3 col-6 mt-4 ml-4">
    <a href="{{ Request::path() }}">
      {{ Breadcrumbs::render(Request::path()) }}
    </a>
  </div>
	
  @if(Auth::check())
      <!-- Ask question button -->
      <div class="col-lg-12 col-md-12 col-12">
        <button class="btn btn-sm btn-outline-primary text-uppercase ml-4" data-toggle="modal" data-target="#ask">
          Задать вопрос
        </button>
      </div>
  @endif

   <!-- Search form -->
   <div class="container mt-4 p-0" id="search-form">
      <div class="d-flex justify-content-end col-lg-12">
          <div class="col-lg-4">
              <form action="{{ route('discussions.search') }}" class="form-group" method="post">
                  
                  @csrf
                  
                  <div class="form-group search-button d-flex">
                      <i class="fas fa-search fa-lg mt-2 ml-1 text-muted"></i>
                  </div>
                  <div class="form-group search-form d-none">
                      <input type="search" class="form-control text-muted montserrat-font-family" name="search">
                      <button type="submit" class="btn btn-outline-success text-uppercase mt-1">
                          <small>
                              Search
                          </small>
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!-- Modal window for ask question button -->
  <div class="modal fade" role="dialog" tabindex="-1" id="ask">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-black-50">Задать вопрос</h4>
          <button class="close" data-dismiss="modal">
            <span aria-label="Close">&times;</span>
          </button>
        </div>
        <form action="{{ route('askQuestions') }}" class="form-group" method="post" enctype="multipart/form-data">

          @csrf

          <div class="modal-body">

            <div class="form-group">

              <label for="title" class="control-label col-xs-2 text-black-50 font-weight-bold">Заголовок *</label>

              <textarea name="title" class="form-control @error('title') is-invalid @enderror" required cols="2" rows="2">{{ old('title') }}</textarea>

              @error('title')

                <div class="invalid-feedback" role="alert">
                  <small>
                    <strong>{{ $message }}</strong>
                  </small>
                </div>

              @enderror

            </div>

            <div class="form-group">

              <label for="description" class="control-label col-xs-2 text-black-50 font-weight-bold">Подробное описание</label>

              <textarea name="description" class="form-control @error('descriiption') is-invalid @enderror" cols="30" rows="10" value="{{ old('description') }}"></textarea>

              <script>
                CKEDITOR.replace('description')
              </script>

              @error('description')

                <div class="invalid-feedback" role="alert">
                  <small>
                    <strong>{{ $message }}</strong>
                  </small>
                </div>

              @enderror

            </div>

            <div class="form-group">
              <div class="custom-file">

                <label for="image" class="custom-file-label">Изображение</label>

                <input type="file" name="image" id="image" class="custom-file-input @error('image') is-invalid @enderror" value="{{ old('image') }}">

                @error('image')
                  
                  <div class="invalid-feedback" role="alert">
                    <small>
                      <strong>{{ $message }}</strong>
                    </small>
                  </div>

                @enderror

              </div>
            </div>

            <div class="form-group">

              <label for="category" class="control-label col-xs-2 font-weight-bold text-black-50">
              Категория *</label>

              <select name="category" class="custom-select @error('categories') is-invalid @enderror" required>

                @foreach($categories as $category)

                  <option value="{{ $category->category_id }}">{{ $category->name }}</option>

                @endforeach

              </select>

              @error('categories')

                <div class="invalid-feedback" role="alert">
                  <small>
                    <strong>{{ $message }}</strong>
                  </small>
                </div>
              
              @enderror

            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-outline-info" name="submit">Отправить</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Discussions -->
  <section class="mt-4 mb-4" id="discussions">
    <div class="container">
      <div class="row">
  
        <!-- Category title -->
        <div class="col-lg-12" id="categories-title"></div>

        <div class="col-lg-8 col-md-8 col-sm-12 shadow p-4 bg-light">

          <table class="table table-hover">

              <thead>
                <tr>
                  <th>Вопрос</th>
                  <th>Количество ответов</th>
                </tr>
              </thead>

              <div class="records">
                <tbody>

                  @foreach($discussions as $discussion)

                  <tr>
                    <td>
                      <a href="{{ route('discussion', $discussion->id) }}" class="nav-link text-light-green miriam-font-family">
                        {{ $discussion->title }}
                      </a>
                      <p class="badge badge-pill badge-purple ml-3">
                        {{ $discussion->category->name }}
                      </p>
                    </td>
                    <td>{{ $discussion->answers_count }}</td>
                  </tr>

                  @endforeach

                </tbody>
              </div>
            
          </table>

        </div>
		
		    <!-- Discussions categories -->
        <div class="col-lg-4 col-md-4 col-sm-12 mt-2" id="categories">
          <div class="card">
            <div class="card-header">
              <h4 class="text-black-50">Категории вопросов</h4>
            </div>
            <div class="card-body">

              @foreach($categories as $category)

                <a href="{{ route('discussionsCategories', $category->category_id) }}" class="nav-link text-light-green">
                    {{ $category->name }}
                </a>

              @endforeach

            </div>
          </div>
        </div>

		    <!-- Pagination for discussions -->
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4" id="pagination">
          <ul class="pagination">
            {{ $discussions->links() }}
          </ul>
        </div>

       

      </div>
    </div>
</section>

@include('templates.parts.alert')

@endsection