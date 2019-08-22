
@foreach($news as $item)

	<div class="col-lg-12 mt-3 rounded">
	  <div class="card">
	      <div class="card-body bg-dark p-5">
	          <div class="d-flex">
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