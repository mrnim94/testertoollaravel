@extends('admin_layout')
@section('admin_content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>
                    <span>
                        <b> Success - </b> This is a regular notification made with ".alert-success"
                    </span>
                </div>
            @elseif(session()->has('message_err'))
                <div class="alert alert-warning">
                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>
                    <span><b> Warning - </b> {{ session()->get('message_err') }}</span>
                </div>
            @endif
            @php
            Session::put('message',null);
            Session::put('message_err',null);
            @endphp
            <form id="add_job_testing" class="form-horizontal" action="{{URL::to('/save-job-testing')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm thông tin JOB</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Job Name:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="job_name" required />
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
                                    <input type="checkbox" checked name="status_job" class="bootstrap-switch" data-on-label="<i class='tim-icons icon-check-2'></i>" data-off-label="<i class='tim-icons icon-simple-remove'></i>" />
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