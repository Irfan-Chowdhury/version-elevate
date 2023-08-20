<div class="tab-pane fade" id="versionUpgradeSetting" role="tabpanel" aria-labelledby="version-upgrade-setting">
    <div class="card">
        <h4 class="card-header p-3"><b>@lang('version-elevate::file.Version Upgrade Setting')</b></h4>
        <hr>
        <div class="card-body">
            <form action="{{ route('version-upgrade-setting.submit') }}" method="POST">
                @csrf

                <!----------------------------------- Files ------------------------------------------>

                <h5><b>@lang('Files')</b></h5>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <div class="filesArea">
                            @if (isset($versionUpgradeSettings->files))
                                @foreach ($versionUpgradeSettings->files as $item)
                                    <div class="row">
                                        <div class="col-8 form-group">
                                            <label>{{__('version-elevate::file.File Name')}}</label>
                                            <input value="{{ $item->file_name }}" type="text" name="file_name[]" class="form-control" placeholder="{{__('version-elevate::file.Type File Name')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('version-elevate::file.Delete')</label><br>
                                            <span class="btn btn-default btn-sm del-row"><i class="dripicons-trash"></i></span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row">
                                    <div class="col-8 form-group">
                                        <label>{{__('version-elevate::file.File Name')}}</label>
                                        <input type="text" name="file_name[]" class="form-control" placeholder="{{__('version-elevate::file.Type File Name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('version-elevate::file.Delete')</label><br>
                                        <span class="btn btn-default btn-sm del-row"><i class="dripicons-trash"></i></span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <span class="btn btn-link add-more" id="addMoreFile"><i class="dripicons-plus"></i> @lang('version-elevate::file.Add More')</span>
                    </div>
                </div>

                <!----------------------------------- Change Log ------------------------------------------>
                <hr>
                <h5><b>@lang('version-elevate::file.Logs')</b></h5>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <div class="logArea">
                            @if (isset($versionUpgradeSettings->logs))
                                @foreach ($versionUpgradeSettings->logs as $item)
                                    <div class="row">
                                        <div class="col-8 form-group">
                                            <label>{{__('version-elevate::file.Type Log')}}</label>
                                            <input value="{{ $item->text }}" type="text" name="text[]" class="form-control" placeholder="{{__('version-elevate::file.Type Log')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('version-elevate::file.Delete')</label><br>
                                            <span class="btn btn-default btn-sm del-row-log"><i class="dripicons-trash"></i></span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row">
                                    <div class="col-8 form-group">
                                        <label>{{__('version-elevate::file.Type Log')}}</label>
                                        <input type="text" name="text[]" class="form-control" placeholder="{{__('version-elevate::file.Type Log')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('version-elevate::file.Delete')</label><br>
                                        <span class="btn btn-default btn-sm del-row-log"><i class="dripicons-trash"></i></span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <span class="btn btn-link add-more" id="addMoreLog"><i class="dripicons-plus"></i> @lang('version-elevate::file.Add More')</span>
                    </div>
                </div>

                <!----------------------------------- Important Note ------------------------------------------>
                <hr>
                <h5><b>@lang('version-elevate::file.Short Note')</b></h5>
                <hr>
                <div class="form-group row">
                    <div class="col-md-12">
                        @if (isset($versionUpgradeSettings->short_note))
                            <textarea name="short_note" class="form-control" rows="5">{{ $versionUpgradeSettings->short_note }}</textarea>
                        @else
                            <textarea name="short_note" class="form-control" rows="5"></textarea>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">@lang('version-elevate::file.Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>
