@extends('version-elevate::layout')
@section('title','Dashboard')

@section('content')

<h1 class="text-center">Dashboard</h1>

@include('version-elevate::includes.session_message')


<div class="container">
    <div id="alertSection" class="{{ $alertVersionUpgradeEnable===true ? null : 'd-none' }} alert alert-primary alert-dismissible fade show" role="alert">
        <p id="announce" class="{{ $alertVersionUpgradeEnable===true ? null : 'd-none' }}"><strong>Announce !!!</strong> A new version {{config('version_elevate.VERSION')}} <span id="newVersionNo"></span> has been released. Please <i><b><a href="{{route('new-release')}}">Click here</a></b></i> to check upgrade details.</p>
        <button type="button" id="closeButtonUpgrade" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>


@endsection

