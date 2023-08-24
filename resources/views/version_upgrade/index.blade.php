@extends('version-elevate::layout')
@section('title','Admin | New Release Version')
@section('content')

    @include('version-elevate::includes.session_message')


    <!-- Cuurent Version -->
    @if (!$alertVersionUpgradeEnable)
        <section id="oldVersionSection" class="container mt-5 text-center">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center text-info">Your current version is <span>{{env('VERSION')}}</span></h4>
                        <p>Please wait for upcoming version</p>
                    </div>
                </div>
        </section>
    @else
        <!-- For New Version -->
        <section id="newVersionSection" class="container mt-5 text-center">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center text-success"> Version <b>{{ $newVersion }}</b> has been released.</h4>
                    <p>Before upgrading, we highly recomend to you that keep a backup of your current script and database.</p>
                </div>
            </div>

            @isset($getVersionUpgradeDetails->short_note)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="text-left text-danger"><b>Important Note : </b> {{ $getVersionUpgradeDetails->short_note }} </h5>
                    </div>
                </div>
            @endisset

            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="text-left p-4">New Change Log</h4>
                    <ul class="list-group text-left ml-4" id="logUL">
                        @if(isset($getVersionUpgradeDetails->logs))
                            @foreach ($getVersionUpgradeDetails->logs as $item)
                                <p> {{ $item->text }} </p>
                            @endforeach
                        @else
                            <p class="text-danger"> No Data Found </p>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3 mb-3">
                <div id="spinner" class="d-none spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <form action="{{route('version-upgrade')}}" method="post">
                @csrf
                <button type="submit" class="mt-5 mb-5 btn btn-primary btn-lg">Upgrade</button>
            </form>

        </section>
    @endif
@endsection
