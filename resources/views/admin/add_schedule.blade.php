@extends('admin_layout')
@section('admin_content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <form id="TypeValidation" class="form-horizontal NimValidation" action="{{URL::to('/save-schedule')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Schedule cho JOB</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Job Name:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <select class="selectpicker required" name="job_name" data-size="7" data-style="btn btn-primary" title="Vui lòng chọn Job Name và ấn lưu">
                                        <option disabled selected>chọn Job Name</option>
                                        @foreach($jobs_testing as $key => $job_testing)
                                        <option value="{{$job_testing['jobName'] }}">{{$job_testing['jobName'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <label class="col-sm-3 label-on-right">
                                <code>required</code>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Start time:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input type="text" name="start_time" class="form-control timepicker" placeholder="chọn giờ bắt đầu chạy Schedule" required />
                                </div>
                            </div>
                            <label class="col-sm-3 label-on-right">
                                <code>required</code>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Every:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="every" value="1" required readonly="true" />
                                </div>
                            </div>
                            <label class="col-sm-3 label-on-right">
                                <code>required</code>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Day:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="day" value="day" required readonly="true"/>
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