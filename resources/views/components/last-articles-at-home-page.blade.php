@foreach($articles as $article)

    <div class="col-lg-3 col-md-5 col-sm-12 mr-3 mt-2">
        <div class="card">
            <img src="{{ $article->image }}" alt="" class="card-img-top">
            <div class="card-body bg-dark">
                <h5 class="card-title">
                    <a href="{{ route('article', $article->id) }}" class="miriam-font-family text-white">{{ $article->title }}</a>
                </h5>
                <div class="d-flex">
                    <i class="fas fa-tags text-white"></i>
                    <p class="text-light-green ml-2 miriam-font-family">{{ $article->category->name }}</p>
                    <p class="text-light-green miriam-font-family ml-3 text-uppercase">{{ date('M d, y', strtotime($article->created_at)) }}</p>
                </div>
            </div>
        </div>
    </div>

@endforeach