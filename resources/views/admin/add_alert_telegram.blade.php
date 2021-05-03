@extends('admin_layout')
@section('admin_content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <form id="TypeValidation" class="form-horizontal NimValidation" action="{{URL::to('/save-alert-telegram')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm thông tin Alert Telegram</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control timepicker" placeholder="chọn giờ bắt đầu chạy Schedule" required />
                                </div>
                            </div>
                            <label class="col-sm-3 label-on-right">
                                <code>required</code>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Token:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="token" value="" required />
                                </div>
                            </div>
                            <label class="col-sm-3 label-on-right">
                                <code>required</code>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Chat ID(Group):</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="chat_id" value="" required />
                                </div>
                            </div>
                            <label class="col-sm-3 label-on-right">
                                <code>required</code>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Disable Notification:</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <select class="selectpicker required" name="disable_notification" data-size="7" data-style="btn btn-primary" title="Vui lòng chọn Disable Notification: và ấn lưu">
                                        <option disabled selected>Khi message được gửi group sẽ alert</option>
                                        <option value="true">TRUE</option>
                                        <option value="false">FALSE</option>
                                    </select>
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