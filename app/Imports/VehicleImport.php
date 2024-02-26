<?php

namespace App\Imports;

use App\Models\administrator\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VehicleImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $vihicle = Vehicle::where('so_xe', $row['so_xe'])->first();
            if($vihicle){
                $vihicle->update([
                    'so_xe' => $row['so_xe'],
                    'loai_thung' => $row['loai_thung'],
                    'mau_son' => $row['mau_son'],
                    'nhan_hieu' => $row['nhan_hieu'],
                    'so_loai' => $row['so_loai'],
                    'so_may' => $row['so_may'],
                    'so_khung' => $row['so_khung'],
                    'nam_sx' => $row['nam_sx'],
                    'nien_han' => $row['nien_han'],
                    'cong_thuc_banh_xe' => $row['cong_thuc_banh_xe'],
                    'kich_thuoc_bao' => $row['kich_thuoc_bao'],
                    'kich_thuoc_long_thung' => $row['kich_thuoc_long_thung'],
                    'chieu_dai_co_so' => $row['chieu_dai_co_so'],
                    'khoi_luong_ban_than' => $row['khoi_luong_ban_than'],
                    'khoi_luong_hang_hoa' => $row['khoi_luong_hang_hoa'],
                    'khoi_luong_keo_theo' => $row['khoi_luong_keo_theo'],
                    'khoi_luong_toan_bo' => $row['khoi_luong_toan_bo'],
                    'so_nguoi_cho' => $row['so_nguoi_cho'],
                    'loai_nhien_lieu' => $row['loai_nhien_lieu'],
                    'hieu_luc_kiem_dinh' => !is_null($row['hieu_luc_kiem_dinh']) ? Carbon::createFromFormat('d/m/Y', $row['hieu_luc_kiem_dinh'])->format('Y-m-d') : null,
                    'hieu_luc_bhds' => !is_null($row['hieu_luc_bhds']) ? Carbon::createFromFormat('d/m/Y', $row['hieu_luc_bhds'])->format('Y-m-d') : null,
                    'cong_ty_bhds' => $row['cong_ty_bhds'],
                    'hieu_luc_bhvc' => !is_null($row['hieu_luc_bhvc']) ? Carbon::createFromFormat('d/m/Y', $row['hieu_luc_bhvc'])->format('Y-m-d') : null,
                    'cong_ty_bhvc' => $row['cong_ty_bhvc'],
                    'hieu_luc_ngan_hang' => !is_null($row['hieu_luc_ngan_hang']) ? Carbon::createFromFormat('d/m/Y', $row['hieu_luc_ngan_hang'])->format('Y-m-d') : null,
                    'dinh_muc_tb' => $row['dinh_muc_tb'],
                    'ngay_mua' => !is_null($row['ngay_mua']) ? Carbon::createFromFormat('d/m/Y', $row['ngay_mua'])->format('Y-m-d') : null,
                    'dinh_muc_thay_nhot' => $row['dinh_muc_thay_nhot'],
                    'trang_thai' => 'Hoạt động'
                ]);

            }else{
                Vehicle::create([                    
                    'so_xe' => $row['so_xe'],
                    'loai_thung' => $row['loai_thung'],
                    'mau_son' => $row['mau_son'],
                    'nhan_hieu' => $row['nhan_hieu'],
                    'so_loai' => $row['so_loai'],
                    'so_may' => $row['so_may'],
                    'so_khung' => $row['so_khung'],
                    'nam_sx' => $row['nam_sx'],
                    'nien_han' => $row['nien_han'],
                    'cong_thuc_banh_xe' => $row['cong_thuc_banh_xe'],
                    'kich_thuoc_bao' => $row['kich_thuoc_bao'],
                    'kich_thuoc_long_thung' => $row['kich_thuoc_long_thung'],
                    'chieu_dai_co_so' => $row['chieu_dai_co_so'],
                    'khoi_luong_ban_than' => $row['khoi_luong_ban_than'],
                    'khoi_luong_hang_hoa' => $row['khoi_luong_hang_hoa'],
                    'khoi_luong_keo_theo' => $row['khoi_luong_keo_theo'],
                    'khoi_luong_toan_bo' => $row['khoi_luong_toan_bo'],
                    'so_nguoi_cho' => $row['so_nguoi_cho'],
                    'loai_nhien_lieu' => $row['loai_nhien_lieu'],
                    'hieu_luc_kiem_dinh' => !is_null($row['hieu_luc_kiem_dinh']) ? Carbon::createFromFormat('d/m/Y', $row['hieu_luc_kiem_dinh'])->format('Y-m-d') : null,
                    'hieu_luc_bhds' => !is_null($row['hieu_luc_bhds']) ? Carbon::createFromFormat('d/m/Y', $row['hieu_luc_bhds'])->format('Y-m-d') : null,
                    'cong_ty_bhds' => $row['cong_ty_bhds'],
                    'hieu_luc_bhvc' => !is_null($row['hieu_luc_bhvc']) ? Carbon::createFromFormat('d/m/Y', $row['hieu_luc_bhvc'])->format('Y-m-d') : null,
                    'cong_ty_bhvc' => $row['cong_ty_bhvc'],
                    'hieu_luc_ngan_hang' => !is_null($row['hieu_luc_ngan_hang']) ? Carbon::createFromFormat('d/m/Y', $row['hieu_luc_ngan_hang'])->format('Y-m-d') : null,
                    'dinh_muc_tb' => $row['dinh_muc_tb'],
                    'ngay_mua' => !is_null($row['ngay_mua']) ? Carbon::createFromFormat('d/m/Y', $row['ngay_mua'])->format('Y-m-d') : null,
                    'dinh_muc_thay_nhot' => $row['dinh_muc_thay_nhot'],
                    'trang_thai' => 'Hoạt động'
                ]);
            }

        }
    }
}
