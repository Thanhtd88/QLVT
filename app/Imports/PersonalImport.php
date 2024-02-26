<?php

namespace App\Imports;

use App\Models\administrator\Personal;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonalImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $personal = Personal::where('ma_nv', $row['ma_nv'])->first();
            if($personal){
                $personal->update([
                    'ho_ten' => $row['ho_ten'],
                    'ngay_sinh' => !is_null($row['ngay_sinh']) ? Carbon::createFromFormat('d/m/Y', $row['ngay_sinh'])->format('Y-m-d') : null,
                    'sdt' => $row['sdt'],
                    'dia_chi' => $row['dia_chi'],
                    'cccd' => $row['cccd'],
                    'ngay_cap_cccd' => !is_null($row['ngay_cap_cccd']) ? Carbon::createFromFormat('d/m/Y', $row['ngay_cap_cccd'])->format('Y-m-d') : null,
                    'noi_cap_cccd' => $row['noi_cap_cccd'],
                    'gplx' => $row['gplx'],
                    'hang_gplx' => $row['hang_gplx'],
                    'ngay_cap_gplx' => !is_null($row['ngay_cap_gplx']) ? Carbon::createFromFormat('d/m/Y', $row['ngay_cap_gplx'])->format('Y-m-d') : null,
                    'noi_cap_gplx' => $row['noi_cap_gplx'],
                    'hieu_luc_gplx' => !is_null($row['hieu_luc_gplx']) ? Carbon::createFromFormat('d/m/Y', $row['hieu_luc_gplx'])->format('Y-m-d') : null,
                    'ngay_vao' => !is_null($row['ngay_vao']) ? Carbon::createFromFormat('d/m/Y', $row['ngay_vao'])->format('Y-m-d') : null,
                    'trang_thai' => $row['trang_thai'],
                    'bhxh' => $row['bhxh'],
                ]);

            }else{
                Personal::create([                    
                    'ma_nv' => $row['ma_nv'],
                    'ho_ten' => $row['ho_ten'],
                    'ngay_sinh' => Carbon::createFromFormat('d/m/Y', $row['ngay_sinh'])->format('Y-m-d'),
                    'sdt' => $row['sdt'],
                    'dia_chi' => $row['dia_chi'],
                    'cccd' => $row['cccd'],
                    'ngay_cap_cccd' => Carbon::createFromFormat('d/m/Y', $row['ngay_cap_cccd'])->format('Y-m-d'),
                    'noi_cap_cccd' => $row['noi_cap_cccd'],
                    'gplx' => $row['gplx'],
                    'hang_gplx' => $row['hang_gplx'],
                    'ngay_cap_gplx' => !is_null($row['ngay_cap_gplx']) ? Carbon::createFromFormat('d/m/Y', $row['ngay_cap_gplx'])->format('Y-m-d') : null,
                    'noi_cap_gplx' => $row['noi_cap_gplx'],
                    'hieu_luc_gplx' => !is_null($row['hieu_luc_gplx']) ? Carbon::createFromFormat('d/m/Y', $row['hieu_luc_gplx'])->format('Y-m-d') : null,
                    'ngay_vao' => Carbon::createFromFormat('d/m/Y', $row['ngay_vao'])->format('Y-m-d'),
                    'trang_thai' => $row['trang_thai'],
                    'bhxh' => $row['bhxh'],
                ]);
            }

        }
    }
}
