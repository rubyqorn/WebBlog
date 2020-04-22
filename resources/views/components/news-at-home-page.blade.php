@foreach($lastNews as $news)
    <div class="col-lg-12 mt-3">
        <div class="card">
            <img src="{{ asset('assets/' . $news->image) }}" alt="" class="card-img-top">
            <div class="card-body bg-dark p-5">
                <div class="d-flex">
                    <i class="far fa-clock text-white mt-1"></i>
                    <p class="text-light-green ml-2 miriam-font-family text-uppercase">{{ date('M d, Y', strtotime($news->created_at)) }}</p>
                </div>
                <h4 class="card-title font-weight-bold">
                    <a href="{{ route('singleNews', $news->id) }}" class="text-white miriam-font-family">{{ $news->title }}</a>
                </h4>
            
            </div>
        </div>
    </div>
@endforeach