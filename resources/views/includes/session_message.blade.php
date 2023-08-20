@if (session()->has('message'))
    <div class="alert alert-{{session('type')}} alert-dismissible fade show text-center" role="alert">
        <strong>{{ session('message')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

{{-- <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    <strong>Test</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div> --}}


@if (isset($errors) && $errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" >
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
