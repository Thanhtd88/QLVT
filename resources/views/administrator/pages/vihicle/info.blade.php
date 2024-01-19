{{-- <form role="form" method="POST"> --}}
    <div class="modal fade" id="info-vihicle{{ $vihicle->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thông tin chi tiết</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"/></svg></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 two-column">                            
                        {{-- <div class="col-md-2">
                            <div class="card-body body-shadow">
                                @if (!is_null($vihicle->image_url))
                                    <img src="{{ asset('image'). '/'. $vihicle->image_url }}" alt="" style="width:100%">
                                @else
                                    <p>Chưa có ảnh</p>      
                                @endif   
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="card-body body-shadow p-0 border-content-none">
                                <table class="table">
                                    <tr>
                                        <th>Số xe</th>
                                        <td>{{ $vihicle->so_xe }}</td>
                                        <th>Loại thùng</th>
                                        <td>{{ $vihicle->loai_thung }}</td>
                                        <th>Màu sơn</th>
                                        <td>{{ $vihicle->mau_son }}</td>
                                        <th>Nhãn hiệu</th>
                                        <td class="text-upper">{{ $vihicle->nhan_hieu }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số loại</th>
                                        <td class="text-upper">{{ $vihicle->so_loai }}</td>
                                        <th>Số máy</th>
                                        <td class="text-upper">{{ $vihicle->so_may }}</td>
                                        <th>Số khung</th>
                                        <td class="text-upper" colspan="3">{{ $vihicle->so_khung }}</td>
                                    </tr>
                                    <tr>
                                        <th>Năm sản xuất</th>
                                        <td>{{ $vihicle->nam_sx }}</td>
                                        <th>Niên hạn</th>
                                        <td colspan="5">{{ $vihicle->nien_han }}</td>
                                    </tr>
                                    <tr>
                                        <th>C.T bánh xe</th>
                                        <td>{{ $vihicle->cong_thuc_banh_xe }}</td>
                                        <th>C.D cơ sở</th>
                                        <td>{{ number_format($vihicle->chieu_dai_co_so).' mm' }}</td>
                                    </tr>
                                    <tr>
                                        <th>K.T bao</th>
                                        <td>{{ $vihicle->kich_thuoc_bao }}</td>
                                        <th>K.T lòng thùng</th>
                                        <td colspan="5">{{ $vihicle->kich_thuoc_long_thung }}</td>
                                    </tr>
                                    <tr>
                                        <th>K.L bản thân</th>
                                        <td>{{ number_format($vihicle->khoi_luong_ban_than).' kg' }}</td>
                                        <th>K.L hàng hóa</th>
                                        <td>{{ number_format($vihicle->khoi_luong_hang_hoa).' kg' }}</td>
                                        <th>K.L toàn bộ</th>
                                        <td>{{ number_format($vihicle->khoi_luong_toan_bo).' kg' }}</td>
                                        <th>K.L kéo theo</th>
                                        <td>{{ number_format($vihicle->khoi_luong_keo_theo).' kg' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số người chở</th>
                                        <td>{{ $vihicle->so_nguoi_cho }}</td>
                                        <th>Loại nhiên liệu</th>
                                        <td colspan="5">{{ $vihicle->loai_nhien_lieu }}</td>
                                    </tr>   
                                    <tr>
                                        <th>Hạn kiểm định</th>
                                        <td>{{ date('d-m-Y', strtotime($vihicle->hieu_luc_kiem_dinh)) }}</td>
                                        <th>Hạn ngân hàng</th>
                                        <td colspan="5">{{ is_null($vihicle->hieu_luc_ngan_hang) ? 'Cavet gốc' : date('d-m-Y', strtotime($vihicle->hieu_luc_ngan_hang)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hạn BHDS</th>
                                        <td>{{ date('d-m-Y', strtotime($vihicle->hieu_luc_bhds)) }}</td>
                                        <th>Công ty</th>
                                        <td class="text-upper">{{ $vihicle->cong_ty_bhds }}</td>
                                        <th>Hạn BHVC</th>
                                        <td>{{ is_null($vihicle->hieu_luc_bhvc) ? 'Chưa mua' : date('d-m-Y', strtotime($vihicle->hieu_luc_bhvc)) }}</td>
                                        <th>Công ty</th>
                                        <td class="text-upper">{{ $vihicle->cong_ty_bhvc }}</td>
                                    </tr>
                                    <tr>
                                        <th>Đơn vị</th>
                                        <td>{{ $vihicle->unit->don_vi }}</td>
                                        <th>Ngày mua</th>
                                        <td>{{ date('d-m-Y', strtotime($vihicle->ngay_mua)) }}</td>
                                        @if (!is_null($vihicle->ngay_ban))
                                            <th>Ngày bán</th>
                                            <td>{{ date('d-m-Y', strtotime($vihicle->ngay_ban)) }}</td>
                                        @endif                                        
                                        <th>Trạng thái</th>
                                        <td>{{ $vihicle->trang_thai }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Đóng</button>
                    <a href="{{ route('admin.vihicle.edit', ['vihicle' => $vihicle->so_xe]) }}" type="submit" class="btn btn-primary"><i style="margin: 0 5px" class="far fa-edit"></i>Sửa</a>
                </div>
            </div>
        </div>
    </div>
{{-- </form> --}}