<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\administrator\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        
        $thay_nhot_vehicles = DB::select('SELECT *, dinh_muc_thay_nhot - (odo - odo_thay_nhot)  as quang_duong_con_lai FROM vehicle WHERE dinh_muc_thay_nhot - (odo - odo_thay_nhot) < 900  AND dinh_muc_thay_nhot - (odo - odo_thay_nhot) > -10000 ORDER BY quang_duong_con_lai ASC;');
        $thay_nhot_count = count($thay_nhot_vehicles);

        $dang_kiem_vehicles = DB::select('SELECT *, DATEDIFF(hieu_luc_kiem_dinh, CURDATE()) as tg_con_lai FROM vehicle WHERE DATEDIFF(hieu_luc_kiem_dinh, CURDATE()) < 15 ORDER BY tg_con_lai ASC;');
        $dang_kiem_count = count($dang_kiem_vehicles);

        $bao_hiem_vehicles = DB::select('SELECT *, DATEDIFF(hieu_luc_bhds, CURDATE()) as tg_con_lai FROM vehicle WHERE DATEDIFF(hieu_luc_bhds, CURDATE()) < 15 ORDER BY tg_con_lai ASC;');
        $bao_hiem_count = count($bao_hiem_vehicles);

        $ngan_hang_vehicles = DB::select('SELECT *, DATEDIFF(hieu_luc_ngan_hang, CURDATE()) as tg_con_lai FROM vehicle WHERE DATEDIFF(hieu_luc_ngan_hang, CURDATE()) < 15 ORDER BY tg_con_lai ASC;');
        $ngan_hang_count = count($ngan_hang_vehicles);

        $datas = DB::table('maintenance')
        ->selectRaw("DATE_FORMAT(ngay_thuc_hien, '%Y%m') as monthYear, SUM(thanh_tien) AS total")
        ->groupBy('monthYear')
        ->get();

        $result = [];
        $result[] = ['Tháng', 'Tổng'];
        foreach ($datas as $data){
            $result[] = [ucfirst($data->monthYear), $data->total];
        }

        $month_result = [];
        foreach ($datas as $data){
            $month_result[] = $data->monthYear;
        }
        $total_result = [];
        foreach ($datas as $data){
            $total_result[] = $data->total;
        }

        return view('administrator.pages.dashboard.dashboard')
        ->with('result', $result)
        ->with('month_result', $month_result)
        ->with('total_result', $total_result)
        ->with('dang_kiem_vehicles', $dang_kiem_vehicles)
        ->with('dang_kiem_count', $dang_kiem_count)
        ->with('bao_hiem_vehicles', $bao_hiem_vehicles)
        ->with('bao_hiem_count', $bao_hiem_count)
        ->with('ngan_hang_vehicles', $ngan_hang_vehicles)
        ->with('ngan_hang_count', $ngan_hang_count)
        ->with('thay_nhot_vehicles', $thay_nhot_vehicles)
        ->with('thay_nhot_count', $thay_nhot_count);
    }
}
