<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VehicleExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array {

        // according to users table
    
        return [
            'Số xe',
            'Loại thùng',
            'Màu sơn',
            'Nhãn hiệu',
            'Số máy',
            'Số khung',
            'Năm sản xuất',
            'Niên hạn',
            'Công thức bánh xe',
            'Kích thước bao',
            'Kích thước lòng',
            'Chiều dài cơ sở',
            'KLBT',
            'KLCC',
            'KLTB',
            'Số người chở',
            'Hạn đăng kiểm',
            'Hạn ngân hàng',
            'Hạn BHDS',
            'Định mức nhiên liệu',
            'Định mức thay nhớt',
            'Ngày đăng ký',
            'Ngày bán',
            'Đơn vị trực thuộc'
        ];
    
    }
    public function collection()
    {
        // return Vihicle::with('unit')
        // ->get();
        return $this->data;
    }
    
    public function map($row): array{
        return [
            $row->so_xe,
            $row->loai_thung,
            $row->mau_son,
            $row->nhan_hieu,
            $row->so_may,
            $row->so_khung,
            $row->san_sx,
            $row->nien_han,
            $row->cong_thuc_banh_xe,
            $row->kich_thuoc_bao,
            $row->kich_thuoc_long_thung,
            $row->chieu_dai_co_so,
            $row->khoi_luong_ban_than,
            $row->khoi_luong_hang_hoa,
            $row->khoi_luong_toan_bo,
            $row->so_nguoi_cho,
            $row->hieu_luc_kiem_dinh,
            $row->hieu_luc_ngan_hang,
            $row->hieu_luc_bhds,
            $row->dinh_muc_tb,
            $row->dinh_muc_thay_nhot,
            $row->ngay_mua,
            $row->ngay_ban,
            $row->unit_id == null ? '' : $row->unit->don_vi,
           
        ];
    }
}
