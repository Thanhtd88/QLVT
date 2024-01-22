<div class="modal fade" id="info-bao-hiem" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Danh sách xe đến hạn bảo hiểm dân sự</h5>
                <button type="button" class="btn" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"/></svg></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 two-column">     
                    <div class="col-md-12">
                        <div class="card-body body-shadow p-0 border-content-none">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th class="text-center">Số xe</th>
                                    <th class="text-center">Nhãn hiệu</th>
                                    <th class="text-center">Loại</th>
                                    <th class="text-center">Tải trọng (tấn)</th>
                                    <th class="text-center">Hạn bảo hiểm dân sự</th>
                                    <th class="text-center">Thời gian còn lại</th>
                                </thead>
                                <tbody>
                                    @if ($bao_hiem_count == 0)
                                        <tr><td class="text-center" colspan="7">Chưa có phương tiện đến hạn ngân hàng</td></tr>
                                    @else
                                        @foreach ($bao_hiem_vihicles as $bao_hiem_vihicle)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $bao_hiem_vihicle->so_xe }}</td>
                                                <td class="text-upper text-center">{{ $bao_hiem_vihicle->nhan_hieu }}</td>
                                                <td class="text-center">{{ $bao_hiem_vihicle->loai_thung }}</td>
                                                <td class="text-center">{{ number_format($bao_hiem_vihicle->khoi_luong_hang_hoa/1000,2) }}</td>
                                                <td class="text-center">{{ date('d-m-Y', strtotime($bao_hiem_vihicle->hieu_luc_bhds)) }}</td>
                                                <td class="text-center">{{ $bao_hiem_vihicle->tg_con_lai }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Đóng</button>
                {{-- <a href="{{ route('admin.vihicle.edit', ['vihicle' => $vihicle->so_xe]) }}" type="submit" class="btn btn-primary"><i style="margin: 0 5px" class="far fa-edit"></i>Sửa</a> --}}
            </div>
        </div>
    </div>
</div>