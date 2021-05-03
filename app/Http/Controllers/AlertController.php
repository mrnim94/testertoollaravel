<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Session;
use Illuminate\Support\Facades\Redirect;

class AlertController extends Controller
{
    public function list_alert_telegram()
    {
    	$response = Http::get('http://'.env("BACKEND_GOLANG").':7000/alert/list-telegram');
    	$data = $response->json()['data'];
    	return view('admin.show_alert_telegram')->with('list_alert_telegram', $data);
    }

    public function add_alert_telegram()
    {
    	return view('admin.add_alert_telegram');
    }

    public function save_alert_telegram(Request $request)
    {
        $data = $request->all();
        $body = array(
            'telegramName' => $data['name'],
            'telegramToken' => $data['token'],
            'chatId' => $data['chat_id'],
            'disableNotification' => $data['disable_notification']
        );
        $response = Http::post('http://'.env("BACKEND_GOLANG").':7000/alert/add-telegram', $body);
        if ($response->json()['code'] == 200) {
            return Redirect::to('/list-alert-telegram')->with('message','Thêm Telegram thành công');
        }else {
            return redirect()->back()->with('message_err','Thêm Telegram thất bại - Kiểm tra lại!!!');
        }
    }

    public function delete_alert_telegram(Request $request)
    {
        $data = $request->all();
        $body = array(
            'telegramName' => $data['name']
        );
        $response = Http::post('http://'.env("BACKEND_GOLANG").':7000/alert/delete-telegram', $body);
        if ($response->json()['code'] == 200) {
            return Redirect::to('/list-alert-telegram')->with('message','xóa Telegram thành công');
        }else {
            return redirect()->back()->with('message_err','xóa Telegram thất bại - Kiểm tra lại!!!');
        }
    }
}
