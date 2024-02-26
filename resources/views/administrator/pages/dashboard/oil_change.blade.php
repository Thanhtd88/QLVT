<div class="modal fade" id="info-thay-nhot" tabindex="-1" aria-labelledby="create-account" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-account">Danh sách xe đến hạn thay nhớt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                    <th class="text-center">Quảng đường còn lại</th>
                                </thead>
                                <tbody>
                                    @if ($thay_nhot_count == 0)
                                        <tr><td class="text-center" colspan="7">Chưa có phương tiện đến hạn ngân hàng</td></tr>
                                    @else
                                        @foreach ($thay_nhot_vehicles as $thay_nhot_vehicle)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $thay_nhot_vehicle->so_xe }}</td>
                                                <td class="text-upper text-center">{{ $thay_nhot_vehicle->nhan_hieu }}</td>
                                                <td class="text-center">{{ $thay_nhot_vehicle->loai_thung }}</td>
                                                <td class="text-center">{{ number_format($thay_nhot_vehicle->khoi_luong_hang_hoa/1000,2) }}</td>
                                                <td class="text-center">{{ $thay_nhot_vehicle->quang_duong_con_lai }}</td>
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
                {{-- <a href="{{ route('admin.vehicle.edit', ['vehicle' => $vehicle->so_xe]) }}" type="submit" class="btn btn-primary"><i style="margin: 0 5px" class="far fa-edit"></i>Sửa</a> --}}
            </div>
        </div>
    </div>
</div>