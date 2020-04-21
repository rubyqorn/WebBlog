@foreach($news as $item)
				
    <div class="col-lg-12 mt-2">
        <div class="shadow p-3 bg-light">
            <h4 class="miriam-font-family">
                <a href="{{ route('singleNews', $item->id) }}" class="text-light-green">{!! $item->title !!}</a>
            </h4>
            <p class="text-black-50">
                {!! $item->preview_text !!}
            </p>
            <div class="d-flex">
                <i class="fas fa-clock text-black-50 mt-1"></i>
                <p class="miriam-font-family text-black-50 text-uppercase ml-2">
                    {{ date('M d, Y', strtotime($item->created_at)) }}
                </p>
            </div>
        </div>
    </div>

@endforeach