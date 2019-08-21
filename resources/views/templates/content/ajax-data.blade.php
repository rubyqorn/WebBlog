
@switch(Request::path())

  @case('news-content')

    @foreach($news as $item)
        <div class="col-lg-12 mt-3 rounded">
            <div class="card">
                <div class="card-body bg-dark p-5">
                    <div class="d-flex">
                        <i class="fas fa-tags text-white"></i>
                        <p class="text-light-green font-weight-bold text-uppercase ml-2">{{ $item->name }}</p>
                        <p class="text-light-green ml-3 miriam-font-family text-uppercase">
                          {{ date('M d, Y', strtotime($item->created_at) )}}
                        </p>
                    </div>
                    <h4 class="card-title font-weight-bold">
                        <a href="{{ route('singleNews', $item->id) }}" class="text-white miriam-font-family">{{ $item->title }}</a>
                    </h4>

                
                </div>
            </div>
        </div>
    @endforeach

    @break

  
  @case('articles-content')

    @foreach($articles as $article)
      <div class="col-lg-12 mt-3 rounded">
          <div class="card">
              <div class="card-body bg-dark p-5">
                  <div class="d-flex">
                      <i class="fas fa-tags text-white"></i>
                      <p class="text-light-green font-weight-bold text-uppercase ml-2">{{ $article->name }}</p>
                      <p class="text-light-green ml-3 miriam-font-family text-uppercase">
                        {{ date('M d, Y', strtotime($article->created_at)) }}
                      </p>
                  </div>
                  <h4 class="card-title font-weight-bold">
                      <a href="{{ route('article', $article->id) }}" class="text-white miriam-font-family">{{ $article->title }}</a>
                  </h4>
              
              </div>
          </div>
      </div>
    @endforeach

    @break

  @default
    {{ abort(404) }}
    
@endswitch