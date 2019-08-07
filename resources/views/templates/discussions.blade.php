@extends('templates.app')

@section('title')
	Обсуждения
@endsection

@section('content')
	
<!-- Ask question button -->
  <div class="col-lg-12 col-md-12 col-12">
    <button class="btn btn-sm btn-outline-primary text-uppercase ml-4" data-toggle="modal" data-target="#ask">
      Задать вопрос
    </button>
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
        <form action="/" class="form-group" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="title" class="control-label col-xs-2 text-black-50 font-weight-bold">Заголовок *</label>
              <input type="text" class="form-control" name="title" required>
            </div>
            <div class="form-group">
              <label for="description" class="control-label col-xs-2 text-black-50 font-weight-bold">Подробное описание</label>
              <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
              <div class="custom-file">
                <label for="image" class="custom-file-label">Изображение</label>
                <input type="file" name="image" id="image" class="custom-file-input">
              </div>
            </div>
            <div class="form-group">
              <label for="categories" class="control-label col-xs-2 font-weight-bold text-black-50">Категория *</label>
              <select name="categories" class="custom-select" required>
                <option selected value="1">Git</option>
                <option value="2">PHP</option>
                <option value="3">JavaScript</option>
                <option value="4">Laravel</option>
              </select>
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
                  <tr>
                    <td>
                      <a href="/discussion.php" class="nav-link text-light-green miriam-font-family">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic ipsam ipsum repellendus nam ex est?</a>
                      <span class="badge badge-pill badge-purple ml-3">HTML/CSS</span>
                    </td>
                    <td>10</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="/" class="nav-link text-light-green miriam-font-family">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic ipsam ipsum repellendus nam ex est?</a>
                      <span class="badge badge-pill badge-purple ml-3">Bootstrap</span>
                    </td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="/" class="nav-link text-light-green miriam-font-family">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic ipsam ipsum repellendus nam ex est?</a>
                      <span class="badge badge-pill badge-purple ml-3">JavaScript</span>
                    </td>
                    <td>4</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="/" class="nav-link text-light-green miriam-font-family">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic ipsam ipsum repellendus nam ex est?</a>
                      <span class="badge badge-pill badge-purple ml-3">PHP</span>
                    </td>
                    <td>1</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="/" class="nav-link text-light-green miriam-font-family">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic ipsam ipsum repellendus nam ex est?</a>
                      <span class="badge badge-pill badge-purple ml-3">Git</span>
                    </td>
                    <td>3</td>
                  </tr>
                </tbody>
              </div>
            
          </table>

        </div>
		
		<!-- Discussions categories -->
        <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
          <div class="card">
            <div class="card-header">
              <h4 class="text-black-50">Категории вопросов</h4>
            </div>
            <div class="card-body">
              <a href="/" class="nav-link text-light-green">Git</a>
              <a href="/" class="nav-link text-light-green">PHP</a>
              <a href="/" class="nav-link text-light-green">JavaScript</a>
              <a href="/" class="nav-link text-light-green">PHP</a>
              <a href="/" class="nav-link text-light-green">Patterns</a>
            </div>
          </div>
        </div>

		<!-- Pagination for discussions -->
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4" id="pagination">
          <ul class="pagination">
            <li class="page-item active"><a href="/" class="page-link">1</a></li>
            <li class="page-item"><a href="/" class="page-link">2</a></li>
            <li class="page-item"><a href="/" class="page-link">3</a></li>
            <li class="page-item"><a href="/" class="page-link">4</a></li>
          </ul>
        </div>

       

      </div>
    </div>
</section>

@endsection