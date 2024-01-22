<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $dang_kiem_vihicles = DB::select('SELECT *, DATEDIFF(hieu_luc_kiem_dinh, CURDATE()) as tg_con_lai FROM vihicle WHERE DATEDIFF(hieu_luc_kiem_dinh, CURDATE()) < 15;');
        $dang_kiem_count = count($dang_kiem_vihicles);

        $bao_hiem_vihicles = DB::select('SELECT *, DATEDIFF(hieu_luc_bhds, CURDATE()) as tg_con_lai FROM vihicle WHERE DATEDIFF(hieu_luc_bhds, CURDATE()) < 15;');
        $bao_hiem_count = count($bao_hiem_vihicles);

        $ngan_hang_vihicles = DB::select('SELECT *, DATEDIFF(hieu_luc_ngan_hang, CURDATE()) as tg_con_lai FROM vihicle WHERE DATEDIFF(hieu_luc_ngan_hang, CURDATE()) < 15;');
        $ngan_hang_count = count($ngan_hang_vihicles);

        $datas = DB::table('maintenance')
        ->selectRaw("DATE_FORMAT(ngay_thuc_hien, '%Y%m') as monthYear, SUM(thanh_tien) AS total")
        ->groupBy('monthYear')
        ->get();

        $result = [];
        $result[] = ['Tháng', 'Chi phí'];
        foreach ($datas as $data){
            $result[] = [ucfirst($data->monthYear), $data->total];
        }

        return view('administrator.pages.dashboard.dashboard')
        ->with('result', $result)
        ->with('dang_kiem_vihicles', $dang_kiem_vihicles)
        ->with('dang_kiem_count', $dang_kiem_count)
        ->with('bao_hiem_vihicles', $bao_hiem_vihicles)
        ->with('bao_hiem_count', $bao_hiem_count)
        ->with('ngan_hang_vihicles', $ngan_hang_vihicles)
        ->with('ngan_hang_count', $ngan_hang_count);
    }
}
