@if(session('status'))

    <div class="alert alert-dismissible alert-success fade show" role="alert" id="success-message">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        <strong>{{ session('status') }}</strong>
    </div>

@endif

@if($errors->any())

    @foreach($errors->all() as $error)
        <div class="alert dismissible alert-danger fade show" role="alert" id="error-message">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <strong>{{ $error }}</strong>
        </div>
    @endforeach

@endif