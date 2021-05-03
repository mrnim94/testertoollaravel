<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Session;
use Illuminate\Support\Facades\Redirect;

class ScheduleController extends Controller
{
    public function add_schedule()
    {
    	$response = Http::get('http://'.env("BACKEND_GOLANG").':7000/report/jobs-testing');
    	$data = $response->json()['data'];
    	return view('admin.add_schedule')->with('jobs_testing', $data);
    }

    public function save_schedule(Request $request)
    {
    	$data = $request->all();
    	$atTime = date("H:i", strtotime($data['start_time']));
    	$body = array(
            'jobName' => $data['job_name'],
            'every' => $data['every'],
            'atTime' => $atTime,
            'day' => $data['day']
        );
    	$response = Http::post('http://'.env("BACKEND_GOLANG").':7000/schedule/add', $body);
        if ($response->json()['code'] == 200) {
        	return Redirect::to('/list-schedules')->with('message','Thêm Schedule Job thành công');
        }else {
            return redirect()->back()->with('message_err','Thêm Schedule Job thất bại - Kiểm tra lại!!!');
        }
    }

    public function list_schedules()
    {
    	$response = Http::get('http://'.env("BACKEND_GOLANG").':7000/schedule/list');
    	$data = $response->json()['data'];
    	return view('admin.show_schedules')->with('list_schedules', $data);
    }

    public function delete_schedules(Request $request)
    {
    	$data = $request->all();
    	$body = array(
            'scheduleId' => $data['schedule_id']
        );
        $response = Http::post('http://'.env("BACKEND_GOLANG").':7000/schedule/delete', $body);
        if ($response->json()['code'] == 200) {
        	// return Redirect::to('/list-schedule')->with('message','Xóa Schedule Job thành công');
        	echo "xóa thành công";
        }else {
            // return redirect()->back()->with('message_err','Xóa Schedule Job thất bại - Kiểm tra lại!!!');
            echo "xóa không thành công";
        }
    }
}