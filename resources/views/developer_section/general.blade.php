
<div class="tab-pane fade show active" id="generalSetting" role="tabpanel" aria-labelledby="general-setting">
<div class="card">
    <h4 class="card-header p-3"><b>@lang('version-elevate::file.General Setting')</b></h4>
    <hr>
    <div class="card-body">
        <form action="{{ route('developer-section.submit') }}" method="POST">
            @csrf

            <h5><b>@lang('General')</b></h5>
            <hr>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('version-elevate::file.Product Mode')</label>
                <div class="col-sm-8">
                    <input type="text" readonly name="product_mode" class="form-control" value="{{env('PRODUCT_MODE')}}">
                    <small class="text-danger">You have to change it from .env</small>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('version-elevate::file.Version') <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" required name="version" class="form-control" value="{{env('VERSION')}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('version-elevate::file.Minimum Required Version') <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" required name="minimum_required_version" class="form-control" value="{{$general->minimum_required_version}}">
                </div>
            </div>

            <!----------------------------------- Version Upgrade ------------------------------------------>
            <hr>
            <h5><b>@lang('version-elevate::file.Version Upgrade')</b></h5>
            <hr>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('version-elevate::file.Latest Version Upgrade')</label>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input type="checkbox" {{$control->version_upgrade->latest_version_upgrade_enable ? 'checked':''}} class="form-check-input" name="latest_version_upgrade_enable">
                        <label class="form-check-label" for="exampleCheck1">Enable</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('version-elevate::file.Latest Version DB Migrate')</label>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input type="checkbox" {{$control->version_upgrade->latest_version_db_migrate_enable ? 'checked':''}} class="form-check-input" name="latest_version_db_migrate_enable">
                        <label class="form-check-label" for="exampleCheck1">Enable</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('version-elevate::file.Version Upgrade URL') <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" required name="version_upgrade_base_url" class="form-control" value="{{$control->version_upgrade->version_upgrade_base_url}}" placeholder="Ex: https://cartproshop.com/version_upgrade_files/">
                </div>
            </div>


            <div class="form-group row">
                <button type="submit" class="btn btn-primary btn-lg btn-block">@lang('version-elevate::file.Submit')</button>
            </div>
        </form>
    </div>
</div>

</div>
