@extends('admin_layout')
@section('admin_content')
<div class="content">
    <div class="col-md-8 ml-auto mr-auto">
      <h2 class="text-center">Hiện thị các Test Case trong 1 Job</h2>
      <p class="text-center">Ở đây chúng tôi show tất cả thông tin của các Test Case phục vụ cho việc Testing!!
        {{-- <a href="https://datatables.net/" target="_blank">full documentation.</a> --}}
      </p>
    </div>
    <div class="row">
      <div class="col-lg-2 col-md-6 col-sm-3">
        <label class="text-warning">Select Alert Telegram</label>
        <select id="set_alert_telegram" class="selectpicker" data-size="7" data-style="btn btn-primary" title="Single Select">
          <option disabled>Chọn thời Alert</option>
          @foreach($alert_telegrams as $key => $telegram)
          <option {{($alert_telegram == 'no') ? "selected" : ""}} value="no">No</option>
          <option {{($alert_telegram == $telegram['telegramName']) ? "selected" : ""}} value="{{ $telegram['telegramName'] }}">{{ $telegram['telegramName'] }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-lg-2 col-md-6 col-sm-3 ml-auto">
        <label>Relative time ranges</label>
        <select id="relative_time_range" class="selectpicker" data-size="7" data-style="btn btn-primary" title="Single Select">
          <option disabled>Chọn khoản thời gian</option>
          <option {{($time_range == '1') ? "selected" : ""}} value="1">1 hour</option>
          <option {{($time_range == '3') ? "selected" : ""}} value="3">3 hours</option>
          <option {{($time_range == '6') ? "selected" : ""}} value="6">6 hours</option>
          <option {{($time_range == '12') ? "selected" : ""}} value="12">12 hours</option>
          <option {{($time_range == '24') ? "selected" : ""}} value="24">24 hours</option>
          <option {{($time_range == '48') ? "selected" : ""}} value="48">2 days</option>
          <option {{($time_range == '72') ? "selected" : ""}} value="72">3 days</option>
        </select>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="datatable" class="table table-striped table-run-jobs">
              <thead>
                <tr>
                  <th>Job ID</th>
                  <th>Test ID</th>
                  <th>Test name</th>
                  <th>Version</th>
                  <th>Browser</th>
                  <th>Agent</th>
                  <th>Status</th>
                  <th>Start time</th>
                  <th>End Time</th>
                  <th>Duration</th>
                  <th class="sorting_desc_disabled sorting_asc_disabled text-right">Actions</th>
                </tr>
              </thead>
              <tbody>
              	<meta name="csrf-token" content="{{ csrf_token() }}">
              	@foreach($run_jobs as $key => $run)
                <tr>
                  <td>{{ $run['jobId'] }}</td>
                  <td>{{ $run['testId'] }}</td>
                  <td>{{ $run['nameTest'] }}</td>
                  <td>{{ $run['version'] }}</td>
                  <td>{{ $run['browser'] }}</td>
                  <td>{{ $run['agent'] }}</td>
                  <td>{{-- đây là status --}}
                  	<?php
                  	if ($run['status'] == 'Error') {
                  	?>
                  		<p class="text-danger">Error</p>
                  	<?php
                  	}elseif ($run['status'] == 'Warning') {
                    ?>
                      <p class="text-warning">Warning</p>
                    <?php
                    }else {
                  	  if ($run['endTime'] == '9223372036854775800') {
                      ?>
                        <p class="text-warning">Not End</p>
                      <?php
                      }else {
                      ?>
                        <p class="text-success">Completed</p>
                      <?php
                      }
                  	}
                  	?>
                  </td>
                  <td>{{ date("H:i:s d/m/Y", floor($run['startTime']/1000000000)) }}</td>
                  <td>
                    <?php
                    if ($run['endTime'] == 9223372036854775800) {
                    ?>
                      <a href="javascript:void(0)" class="btn btn-link btn-danger btn-icon btn-sm remove"><i class="tim-icons icon-alert-circle-exc"></i></a>
                    <?php
                    }else {
                    ?>
                      {{ date("H:i:s d/m/Y", floor($run['endTime']/1000000000)) }}
                    <?php
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if ($run['endTime'] == '9223372036854775800') {
                    ?>
                      <a href="javascript:void(0)" class="btn btn-link btn-danger btn-icon btn-sm remove"><i class="tim-icons icon-alert-circle-exc"></i></a>
                    <?php
                    }else {
                      $diff  = abs(floor($run['endTime']/1000000000) - floor($run['startTime']/1000000000));
                      $years = floor($diff / (365*60*60*24));
                      $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                      $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24) / (60*60*24));
                      $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                      $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60) / 60);
                      $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
                      echo $hours." h ".$minutes." m ".$seconds." s";
                    }
                    ?>
                  </td>
                  <td class="text-right">
                    {{-- <a href="javascript:void(0)" class="btn btn-link btn-info btn-icon btn-sm like"><i class="tim-icons icon-heart-2 action_jobs_testing"></i></a> --}}
                    <a href="{{URL::to('/show-run-test/'.$run['testId'])}}" class="btn btn-link btn-warning btn-icon btn-sm edit" title="Xem chi tiết"><i class="tim-icons icon-bullet-list-67"></i></a>
                    <a href="javascript:void(0)" class="btn btn-link btn-danger btn-icon btn-sm remove"><i class="tim-icons icon-simple-remove"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Job ID</th>
                  <th>Test ID</th>
                  <th>Test name</th>
                  <th>Version</th>
                  <th>Browser</th>
                  <th>Agent</th>
                  <th>Status</th>
                  <th>Start time</th>
                  <th>End Time</th>
                  <th>Duration</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>
      <!-- end col-md-12 -->
    </div>
    <!-- end row -->
</div>
@endsection