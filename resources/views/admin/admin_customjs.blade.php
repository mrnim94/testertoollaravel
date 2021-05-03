<?php
if (request()->segment(1) == 'show-jobs-testing') {
?>
<script>
    $(document).ready(function() {
      $('#datatable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: false,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }

      });

      var table = $('#datatable').DataTable();

      // Edit record
      // table.on('click', '.edit', function() {
      //   $tr = $(this).closest('tr');
      //   if ($($tr).hasClass('child')) {
      //     $tr = $tr.prev('.parent');
      //   }

      //   var data = table.row($tr).data();
      //   alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      // });

      // Delete a record
      // table.on('click', '.remove', function(e) {
      //   $tr = $(this).closest('tr');
      //   if ($($tr).hasClass('child')) {
      //     $tr = $tr.prev('.parent');
      //   }
      //   table.row($tr).remove().draw();
      //   e.preventDefault();
      // });

      //Like record
      // table.on('click', '.like', function() {
      //   alert('You clicked on Like button');
      // });
    });
</script>

{{-- sử lý action khi click vào bảng--}}
<script type="text/javascript">
	$(document).ready(function() {
		$('.table-jobs-testing tbody').on('click','.action_jobs_testing',function(){
			var currow = $(this).closest('tr');
			var job_name = $.trim(currow.find('td:eq(1)').text());
      var job_id = $.trim(currow.find('td:eq(0)').text());
			$.ajaxSetup({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "POST",
				cache: false,
				url: "{{URL::to('/run-jobs-testing')}}",
				data: {job_name : job_name},
			})
			.fail(function(response){
				alert(response)
			})
			.done(function(response){
				Swal.fire({
            type: 'success',
            title: 'Server đã nhận request của bạn',
            text: 'Nếu bạn muốn xem ngay trang thái của Jobs '+job_name+' thì ấn "Xem ngay"',
            confirmButtonText: 'Xem ngay',
            showCancelButton: true,
            cancelButtonText: "Tạo request tiếp",
            footer: '',
            showCloseButton: true
        })
        .then(function (result) {
            if (result.value) {
                window.location = "{{url('/show-runs-jobs').'/'}}"+job_id;
            }
        });
			});
		});
	});
</script>
<?php
}
?>

<?php
if (request()->segment(1) == 'show-runs-jobs') {
?>
<script>
    $(document).ready(function() {
      $('#datatable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }

      });

      var table = $('#datatable').DataTable();

      // Edit record
      // table.on('click', '.edit', function() {
      //   $tr = $(this).closest('tr');
      //   if ($($tr).hasClass('child')) {
      //     $tr = $tr.prev('.parent');
      //   }

      //   var data = table.row($tr).data();
      //   alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      // });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      // table.on('click', '.like', function() {
      //   alert('You clicked on Like button');
      // });
    });
</script>

{{-- sử lý action khi click vào bảng--}}
<script type="text/javascript">
	$(document).ready(function() {
		$('.table-run-jobs tbody').on('click','.action_jobs_testing',function(){
			var currow = $(this).closest('tr');
			var job_name = $.trim(currow.find('td:eq(1)').text());
			$.ajaxSetup({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "POST",
				cache: false,
				url: "{{URL::to('/run-jobs-testing')}}",
				data: {job_name : job_name},
			})
			.fail(function(response){
				alert(response)
			})
			.done(function(response){
				Swal.fire({
		          position: 'center',
		          type: 'success',
		          title: 'Jobs Testing bắt đầu chạy!',
		          showConfirmButton: false,
		          timer: 1500
		        });
			});
		});
	});
</script>

{{-- chọn thời gian hiện thị job --}}
<script type="text/javascript">
  $('#relative_time_range').on('change', function() {
    var time_range = $(this).val();
    $(location).attr("href","{{URL::to('/show-runs-jobs/'.$job_id.'/'.$alert_telegram)}}"+"/"+time_range)
  });
</script>

{{-- Đặt alert telegram cho job --}}
<script type="text/javascript">
  $('#set_alert_telegram').on('change', function() {
    var job_id = '{{$job_id}}';
    var alert_telegram = $(this).val();

    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      cache: false,
      url: "{{URL::to('/upate-alert-telegram-job')}}",
      data: {job_id : job_id,alert_telegram : alert_telegram},
    })
    .fail(function(response){
      alert(response)
    })
    .done(function(response){
      Swal.fire({
        position: 'center',
        type: 'success',
        title: 'Cập nhật Alert thành công!',
        showConfirmButton: false,
        timer: 1500
      });
      // table.row($tr).remove().draw();
      // e.preventDefault();
      $(location).attr("href","{{URL::to('/show-runs-jobs/'.$job_id)}}"+"/"+alert_telegram+"/1")
    });
  });
</script>
<?php
}
?>

<?php
if (request()->segment(1) == 'dashboard') {
?>
<script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

      //demo.initVectorMap();

    });
</script>
<?php
}
?>

<?php
if (request()->segment(1) == 'add-schedule') {
?>
<script>
    $(document).ready(function() {
        // initialise Datetimepicker and Sliders
        blackDashboard.initDateTimePicker();
        if ($('.slider').length != 0) {
          demo.initSliders();
        }
    });
</script>
<?php
}
?>

<?php
if (request()->segment(1) == 'list-schedules') {
?>
<script>
    $(document).ready(function() {
      $('#datatable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: false,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }

      });

      var table = $('#datatable').DataTable();

      // delete schedule
      table.on('click', '.remove', function() {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }

        var data = table.row($tr).data();
        var schedule_id = data[0];
        // alert('You press on Row: ' + data[0] + '\'s row.');
        $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "POST",
          cache: false,
          url: "{{URL::to('/delete-schedules')}}",
          data: {schedule_id : schedule_id},
        })
        .fail(function(response){
          alert(response)
        })
        .done(function(response){
          Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Delete schedule thành công!',
            showConfirmButton: false,
            timer: 1500
          });
          table.row($tr).remove().draw();
          e.preventDefault();
        });
      });

      // // Edit record
      // table.on('click', '.remove', function() {
      //   $tr = $(this).closest('tr');
      //   if ($($tr).hasClass('child')) {
      //     $tr = $tr.prev('.parent');
      //   }

      //   var data = table.row($tr).data();
      //   alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      // });

      //Delete a record
      // table.on('click', '.remove', function(e) {
      //   $tr = $(this).closest('tr');
      //   if ($($tr).hasClass('child')) {
      //     $tr = $tr.prev('.parent');
      //   }
      //   table.row($tr).remove().draw();
      //   e.preventDefault();
      // });

      //Like record
      // table.on('click', '.like', function() {
      //   alert('You clicked on Like button');
      // });
    });
</script>
<?php
}
?>


{{-- list-alert-telegram --}}
<?php
if (request()->segment(1) == 'list-alert-telegram') {
?>
<script>
    $(document).ready(function() {
      $('#datatable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: false,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }

      });

      var table = $('#datatable').DataTable();

      // delete schedule
      table.on('click', '.remove', function() {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }

        var data = table.row($tr).data();
        var name = data[1];
        // alert('You press on Row: ' + data[0] + '\'s row.');
        $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "POST",
          cache: false,
          url: "{{URL::to('/delete-alert-telegram')}}",
          data: {name : name},
        })
        .fail(function(response){
          alert(response)
        })
        .done(function(response){
          Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Delete Telegram thành công!',
            showConfirmButton: false,
            timer: 1500
          });
          table.row($tr).remove().draw();
          // e.preventDefault();
        });
      });

      // // Edit record
      // table.on('click', '.remove', function() {
      //   $tr = $(this).closest('tr');
      //   if ($($tr).hasClass('child')) {
      //     $tr = $tr.prev('.parent');
      //   }

      //   var data = table.row($tr).data();
      //   alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      // });

      //Delete a record
      // table.on('click', '.remove', function(e) {
      //   $tr = $(this).closest('tr');
      //   if ($($tr).hasClass('child')) {
      //     $tr = $tr.prev('.parent');
      //   }
      //   table.row($tr).remove().draw();
      //   e.preventDefault();
      // });

      //Like record
      // table.on('click', '.like', function() {
      //   alert('You clicked on Like button');
      // });
    });
</script>
<?php
}
?>