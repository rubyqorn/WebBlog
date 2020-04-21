<div class="col-lg-3 col-md-3 col-6 mt-4 ml-4">
    <a href="{{ Request::path() }}">
        {{ Breadcrumbs::render(Request::path()) }}
    </a>
</div>