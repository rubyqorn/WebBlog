@if(Request::is('news-categories/*'))

		@foreach($news as $item)

			<div class="col-lg-12 mt-3 rounded">
			  <div class="card">
			      <div class="card-body bg-dark p-5">
			          <div class="d-flex">
                    <i class="fas fa-tags text-white"></i>
                    <p class="text-light-green font-weight-bold text-uppercase ml-2 mr-2">{{ $item->category->name }}</p>
                    <i class="fas fa-clock text-white mt-1"></i>
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

@elseif(Request::is('articles-categories/*'))

	 @foreach($articles as $article)
      <div class="col-lg-12 mt-3 rounded">
          <div class="card">
              <div class="card-body bg-dark p-5">
                  <div class="d-flex">
                      <i class="fas fa-tags text-white"></i>
                      <p class="text-light-green font-weight-bold text-uppercase ml-2">{{ $article->category->name }}</p>
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


@elseif(Request::is('discussions-categories/*'))

  @foreach($discussions as $discussion)

      <tr>
        <td>
          <a href="{{ route('discussion', $discussion->id) }}" class="nav-link text-light-green miriam-font-family">
            {{ $discussion->title }}
          </a>
          <p class="badge badge-dark badge-pill">{{ $discussion->category->name }}</p>
        </td>
        <td>{{ $discussion->answers_count }}</td>
      </tr>

    @endforeach

@else
	
	{{ abort(404) }}

@endif

