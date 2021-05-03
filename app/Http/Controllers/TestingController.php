<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Session;
use Illuminate\Support\Facades\Redirect;

class TestingController extends Controller
{
	//const backendTesting = 'localhost';

    public function show_jobs_testing()
    {
    	$response = Http::get('http://'.env("BACKEND_GOLANG").':7000/report/jobs-testing');
    	$data = $response->json()['data'];
    	return view('admin.all_jobs_testing')->with('jobs_testing', $data);
    }

    public function run_jobs_testing(Request $request)
    {
    	$response = Http::post('http://'.env("BACKEND_GOLANG").':7000/tester/run-testing', [
    		'jodName' => $request->job_name,
    	]);
    	echo $response->body();
    }

    public function show_runs_jobs($job_id, $alert_telegram, $time_range='')
    {
        if ($time_range == '') {
            $body = array(
                'jobId' => $job_id,
                'startTime' => (time() - 1*60*60)*1000000000,
                'endTime' => time()*1000000000,
            );
            $time_range=1;
        }else {
            $body = array(
                'jobId' => $job_id,
                'startTime' => (time() - $time_range*60*60)*1000000000,
                'endTime' => time()*1000000000,
            );
        }
    	$response = Http::post('http://'.env("BACKEND_GOLANG").':7000/report/run-jobs', $body);
    	$data = $response->json()['data'];

        //get list alert telegram
        $response_alert = Http::get('http://'.env("BACKEND_GOLANG").':7000/alert/list-telegram');
        $data_alert = $response_alert->json()['data'];


    	return view('admin.show_run_jobs_by_job_id')
        ->with('run_jobs', $data)
        ->with('alert_telegrams', $data_alert)
        ->with(compact('time_range', 'job_id', 'alert_telegram'));
    }

    public function show_run_test($test_id)
    {
    	$body = array(
    		'testId' => $test_id
    	);
    	$response = Http::post('http://'.env("BACKEND_GOLANG").':7000/report/run-test', $body);
    	$data = $response->json()['data'];
    	return view('admin.show_run_test_by_test_id')->with('run_test', $data);
    }

    public function add_jobs_testing()
    {
        return view('admin.add_job');
    }

    public function save_job_testing(Request $request)
    {
        $data = $request->all();
        if (isset($data['status_job']) && $data['status_job'] == 'on') {
            $status = 1;
        }else {
            $status = 0;
        }
        $body = array(
            'jobName' => $data['job_name'],
            'status' => $status
        );
        $response = Http::post('http://'.env("BACKEND_GOLANG").':7000/tester/add-job', $body);
        if ($response->json()['code'] == 200) {
            Session::put('job_id',$response->json()['data']['jobID']);
            Session::put('job_name',$data['job_name']);
            Session::save();

            return Redirect::to('/add-user-for-job-testing');
        }else {
            return redirect()->back()->with('message_err','Thêm Job thất bại - Đổi tên Job Name khác!!!');
        }
    }

    public function add_user_for_job_testing()
    {
        return view('admin.add_user_4_job');
    }

    public function save_user_job_testing(Request $request)
    {
        $data = $request->all();
        if (isset($data['status_user_job']) && $data['status_user_job'] == 'on') {
            $status = 1;
        }else {
            $status = 0;
        }
        $body = array(
            'userName' => $data['username_job'],
            'password' => $data['password_job'],
            'jobId' => Session::get('job_id'),
            'status' => $status,
        );

        $response = Http::post('http://'.env("BACKEND_GOLANG").':7000/tester/add-user', $body);
        if ($response->json()['code'] == 200) {
            return Redirect::to('/add-github-for-job-testing');
        }else {
            return redirect()->back()->with('message_err','Thêm Job thất bại - Hãy thử lại');
        }
    }

    public function add_github_for_job_testing()
    {
        return view('admin.add_github_4_job');
    }

    public function save_github_job_testing(Request $request)
    {
        $data = $request->all();
        $body = array(
            'accessToken' => $data['access_token'],
            'owner' => $data['owner'],
            'repo' => $data['repo'],
            'path' => $data['path'],
            'jobID' => Session::get('job_id'),
        );

        $response = Http::post('http://'.env("BACKEND_GOLANG").':7000/tester/add-github', $body);
        if ($response->json()['code'] == 200) {

            Session::forget('job_id');
            Session::put('message','Thêm Job thành công!!!');
            Session::save();
            return Redirect::to('/show-jobs-testing');
        }else {
            return redirect()->back()->with('message_err','Thêm Job thất bại - Hãy thử lại');
        }
    }

    public function delete_runs_jobs($job_id)
    {
        $response = Http::delete('http://'.env("BACKEND_GOLANG").':7000/tester/delete-job/'.$job_id);
        if ($response->json()['code'] == 200) {

            Session::forget('job_id');
            Session::put('message','Delete Job thành công!!!');
            Session::save();
            return Redirect::to('/show-jobs-testing');
        }else {
            return redirect()->back()->with('message_err','Delete Job thất bại - Hãy thử lại');
        }
    }

    public function upate_alert_telegram_job(Request $request)
    {
        $data = $request->all();

        $body = array(
            'jobId' => $data['job_id'],
            'alertTelegram' => $data['alert_telegram'],
        );

        $response = Http::post('http://'.env("BACKEND_GOLANG").':7000/tester/update-alert-telegram', $body);
        if ($response->json()['code'] == 200) {
            // return Redirect::to('/show-jobs-testing')->with('message','Cập nhật Alert Telegram thành công');
            return $response->json()['data'];
        }else {
            return redirect()->back()->with('message_err','Cập nhật Alert Telegram thất bại - Hãy thử lại');
        }
    }
}
