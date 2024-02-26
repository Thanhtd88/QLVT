<div class="modal fade" id="info-vehicle{{ $vehicle->id }}" tabindex="-1" aria-labelledby="info-vehicle{{ $vehicle->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="info-vehicle{{ $vehicle->id }}">Thông tin chi tiết</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="card-body body-shadow p-0 border-content-none">
                        <table class="table text-left">
                            <tr>
                                <th>Số xe</th>
                                <td>{{ $vehicle->so_xe }}</td>
                                <th>Loại thùng</th>
                                <td>{{ $vehicle->loai_thung }}</td>
                                <td colspan="4" rowspan="6">
                                    <div class="card-body body-shadow img-thumbnail">
                                        @if (!is_null($vehicle->image_url_1))
                                            <img src="{{ asset('image'). '/'. $vehicle->image_url_1 }}" class="rounded float-start" alt="" width="250px">
                                            <img src="{{ asset('image'). '/'. $vehicle->image_url_2 }}" class="rounded float-end" alt=""  width="250px">
                                        @else
                                            <p class="text-center">Chưa có ảnh</p>   
                                        @endif   
                                    </div>
                                </td>                                
                            </tr>
                            <tr>
                                <th>Màu sơn</th>
                                <td>{{ $vehicle->mau_son }}</td>
                                <th>Nhãn hiệu</th>
                                <td class="text-upper">{{ $vehicle->nhan_hieu }}</td>
                            </tr>
                            <tr>
                                <th>Số máy</th>
                                <td class="text-upper">{{ $vehicle->so_may }}</td>
                                <th>Số khung</th>
                                <td class="text-upper">{{ $vehicle->so_khung }}</td>
                                
                            </tr>
                            <tr>
                                <th>Năm sản xuất</th>
                                <td>{{ $vehicle->nam_sx }}</td>
                                <th>Niên hạn</th>
                                <td>{{ $vehicle->nien_han }}</td>
                            </tr>
                            <tr>
                                <th>C.T bánh xe</th>
                                <td>{{ $vehicle->cong_thuc_banh_xe }}</td>
                                <th>C.D cơ sở</th>
                                <td>{{ number_format($vehicle->chieu_dai_co_so).' mm' }}</td>
                                
                            </tr>
                            <tr>
                                <th>K.T bao</th>
                                <td>{{ $vehicle->kich_thuoc_bao }}</td>
                                <th>K.T lòng thùng</th>
                                <td>{{ $vehicle->kich_thuoc_long_thung }}</td>
                            </tr>
                            <tr>
                                <th>K.L bản thân</th>
                                <td>{{ number_format($vehicle->khoi_luong_ban_than).' kg' }}</td>
                                <th>K.L hàng hóa</th>
                                <td>{{ number_format($vehicle->khoi_luong_hang_hoa).' kg' }}</td>
                                <th>K.L toàn bộ</th>
                                <td>{{ number_format($vehicle->khoi_luong_toan_bo).' kg' }}</td>
                                <th>K.L kéo theo</th>
                                <td>{{ number_format($vehicle->khoi_luong_keo_theo).' kg' }}</td>
                            </tr>
                            <tr>
                                <th>Số người chở</th>
                                <td>{{ $vehicle->so_nguoi_cho }}</td>
                                <th>Loại nhiên liệu</th>
                                <td>{{ $vehicle->loai_nhien_lieu }}</td>
                                <th>Hạn kiểm định</th>
                                <td>{{ date('d-m-Y', strtotime($vehicle->hieu_luc_kiem_dinh)) }}</td>
                                <th>Hạn ngân hàng</th>
                                <td>{{ is_null($vehicle->hieu_luc_ngan_hang) ? 'Cavet gốc' : date('d-m-Y', strtotime($vehicle->hieu_luc_ngan_hang)) }}</td>
                            </tr>   
                            <tr>
                                <th>Hạn BHDS</th>
                                <td>{{ date('d-m-Y', strtotime($vehicle->hieu_luc_bhds)) }}</td>
                                <th>C.ty BHDS</th>
                                <td class="text-upper">{{ $vehicle->cong_ty_bhds }}</td>
                                <th>Hạn BHVC</th>
                                <td>{{ is_null($vehicle->hieu_luc_bhvc) ? 'Không' : date('d-m-Y', strtotime($vehicle->hieu_luc_bhvc)) }}</td>
                                <th>C.ty BHVC</th>
                                <td class="text-upper">{{ is_null($vehicle->cong_ty_bhvc) ? 'Không' : $vehicle->cong_ty_bhvc }}</td>
                            </tr>
                            <tr>
                                <th>Đơn vị</th>
                                <td>{{ is_null($vehicle->unit_id) ? '' : $vehicle->unit->don_vi }}</td>
                                <th>Ngày mua</th>
                                <td>{{ date('d-m-Y', strtotime($vehicle->ngay_mua)) }}</td>
                                @if (!is_null($vehicle->ngay_ban))
                                    <th>Ngày bán</th>
                                    <td>{{ date('d-m-Y', strtotime($vehicle->ngay_ban)) }}</td>
                                @endif                                        
                                <th>Trạng thái</th>
                                <td>{{ $vehicle->trang_thai }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body --> 
        </div>
        <div class="modal-footer btn-group-sm">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Đóng</button>
            <a href="{{ route('admin.vehicle.edit', ['vehicle' => $vehicle->so_xe]) }}" type="submit" class="btn btn-primary"><i style="margin: 0 5px" class="far fa-edit"></i>Sửa</a>
        </div>
      </div>
    </div>
</div>