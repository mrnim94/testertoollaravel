@extends('admin_layout')
@section('admin_content')
<div class="content">
    <div class="col-md-8 ml-auto mr-auto">
      <h2 class="text-center">Show Jobs Testing</h2>
      <p class="text-center">Ở đây chúng tôi show tất cả thông tin của các Jobs phục vụ cho việc Testing!!
        {{-- <a href="https://datatables.net/" target="_blank">full documentation.</a> --}}
      </p>
    </div>
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>
                    <span>
                        <b> Success - </b> {{ session()->get('message') }}
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
            <table id="datatable" class="table table-striped table-jobs-testing">
              <thead>
                <tr>
                  <th>Job ID</th>
                  <th>Job Name</th>
                  <th>Owner</th>
                  <th>Repo</th>
                  <th>Path</th>
                  <th>Status</th>
                  <th class="sorting_desc_disabled sorting_asc_disabled text-right">Actions</th>
                </tr>
              </thead>
              <tbody>
              	<meta name="csrf-token" content="{{ csrf_token() }}">
              	@foreach($jobs_testing as $key => $job_testing)
                <tr>
                  <td>{{ $job_testing['jobID'] }}</td>
                  <td>{{ $job_testing['jobName'] }}</td>
                  <td>{{ $job_testing['owner'] }}</td>
                  <td>{{ $job_testing['repo'] }}</td>
                  <td>{{ $job_testing['path'] }}</td>
                  <td>
                  	<?php
                  	if ($job_testing['status'] == 1) {
                  	?>
                  		<a href="javascript:void(0)" class="btn btn-link btn-success btn-icon btn-sm like"><i class="tim-icons icon-check-2"></i></a>
                  	<?php
                  	}else {
                  	?>
                  		<a href="javascript:void(0)" class="btn btn-link btn-dangers btn-icon btn-sm like"><i class="tim-icons icon-alert-circle-exc"></i></a>
                  	<?php
                  	}
                  	?>
                  </td>
                  <td class="text-right">
                    <a href="javascript:void(0)" class="btn btn-link btn-info btn-icon btn-sm like" title="Chạy Testing"><i class="tim-icons icon-heart-2 action_jobs_testing"></i></a>
                    <a href="{{URL::to('/show-runs-jobs/'.$job_testing['jobID'].'/'.$job_testing['alertTelegram'].'/1')}}" class="btn btn-link btn-warning btn-icon btn-sm edit" title="Xem chi tiết"><i class="tim-icons icon-bullet-list-67"></i></a>
                    <a href="{{URL::to('/delete-runs-jobs/'.$job_testing['jobID'])}}" class="btn btn-link btn-danger btn-icon btn-sm remove"><i class="tim-icons icon-simple-remove"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Job ID</th>
                  <th>Job Name</th>
                  <th>Owner</th>
                  <th>Repo</th>
                  <th>Path</th>
                  <th>Status</th>
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