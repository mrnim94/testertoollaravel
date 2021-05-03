@extends('admin_layout')
@section('admin_content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <form id="TypeValidation" class="form-horizontal" action="{{URL::to('/save-user-job-testing')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm User cho JOB {{Session::get('job_name')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Username:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="username_job" required />
                                </div>
                            </div>
                            <label class="col-sm-3 label-on-right">
                                <code>required</code>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Password:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password_job" required />
                                </div>
                            </div>
                            <label class="col-sm-3 label-on-right">
                                <code>required</code>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Trạng thái:</label>
                            <div class="col-sm-7">
                                <div class="form-group" >
                                    <input type="checkbox" checked name="status_user_job" class="bootstrap-switch" data-on-label="<i class='tim-icons icon-check-2'></i>" data-off-label="<i class='tim-icons icon-simple-remove'></i>" />
                                </div>
                            </div>
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