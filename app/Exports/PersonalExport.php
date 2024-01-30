<?php

namespace App\Exports;

use App\Models\administrator\Personal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PersonalExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array {

        // according to users table
    
        return [
            'Mã NV',
            'Họ tên',
            'Ngày sinh',
            'SĐT',
            'Địa chỉ',
            'CCCD',
            'Ngày cấp',
            'Nơi cấp',
            'GPLX',
            'Hạng',
            'Ngày cấp',
            'Nơi cấp',
            'Hiệu lực',
            'Phòng ban',
            'Đơn vị',
            'Dự án',
            'Ngày vào',
            'Ngày nghỉ',
            'Trạng thái',
            'BHXH',
            'Số xe'
        ];
    
    }
    public function collection()
    {
        return Personal::with('department')
        ->with('unit')
        ->with('project')
        ->with('vihicle')
        ->get();
    }
    
    public function map($row): array{
        return [
            $row->ma_nv,
            $row->ho_ten,
            $row->ngay_sinh,
            $row->sdt,
            $row->dia_chi,
            $row->cccd,
            $row->ngay_cap_cccd,
            $row->noi_cap_cccd,
            $row->gplx,
            $row->hang_gplx,
            $row->ngay_cap_glpx,
            $row->noi_cap_gplx,
            $row->hieu_luc_gplx,
            $row->department_id == null ? '' : $row->department->phong_ban,
            $row->unit_id == null ? '' : $row->unit->don_vi,
            $row->project_id == null ? '' : $row->project->du_an ,
            $row->ngay_vao,
            $row->ngay_nghi,    
            $row->trang_thai == 0 ? 'Đang làm' : 'Nghỉ việc',
            $row->bhxh == 'on' ? 'Đã đóng' : 'Chưa đóng',
            $row->vihicle_id == null ? '' : $row->vihicle->so_xe
        ];
    }
    
    
}
