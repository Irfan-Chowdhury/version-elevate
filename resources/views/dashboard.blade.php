@extends('version-elevate::layout')
@section('title','Dashboard')

@section('content')

<h1 class="text-center">Dashboard</h1>


<div class="container">
    <!-- Alert Section for version upgrade-->
    <div id="alertSection" class="{{ $alertVersionUpgradeEnable===true ? null : 'd-none' }} alert alert-primary alert-dismissible fade show" role="alert">
        <p id="announce" class="{{ $alertVersionUpgradeEnable===true ? null : 'd-none' }}"><strong>Announce !!!</strong> A new version {{config('version_elevate.VERSION')}} <span id="newVersionNo"></span> has been released. Please <i><b><a href="{{route('new-release')}}">Click here</a></b></i> to check upgrade details.</p>
        <button type="button" id="closeButtonUpgrade" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <!-- Alert Section for Bug update-->
    <div id="alertBugSection" class=" {{ $alertBugEnable===true ? null : 'd-none' }} alert alert-primary alert-dismissible fade show" style="background-color: rgb(248,215,218)" role="alert">
        <p id="alertBug" class=" {{ $alertBugEnable===true ? null : 'd-none' }} " style="color: rgb(126,44,52)"><strong>Alert !!!</strong> Minor bug fixed in version {{env('VERSION')}}. Please <i><b><a href="{{route('bug-update-page')}}">Click here</a></b></i> to update the system.</p>
        <button type="button" style="color: rgb(126,44,52)" id="closeButtonBugUpdate" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>


@endsection
