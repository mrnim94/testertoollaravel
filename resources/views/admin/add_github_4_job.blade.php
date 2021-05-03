@extends('admin_layout')
@section('admin_content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <form id="TypeValidation" class="form-horizontal" action="{{URL::to('/save-github-job-testing')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Github cho JOB {{Session::get('job_name')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Access Token:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="access_token" required />
                                </div>
                            </div>
                            <label class="col-sm-3 label-on-right">
                                <code>required</code>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Owner:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="owner" required />
                                </div>
                            </div>
                            <label class="col-sm-3 label-on-right">
                                <code>required</code>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Repo:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="repo" required />
                                </div>
                            </div>
                            <label class="col-sm-3 label-on-right">
                                <code>required</code>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Path:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="path" required />
                                </div>
                            </div>
                            <label class="col-sm-3 label-on-right">
                                <code>required</code>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection