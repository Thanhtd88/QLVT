<form method="POST" action="">
    {{-- {{ route('admin.account.update', ['user' => $user->id]) }} --}}
    @csrf
    <div class="modal fade" id="role-account{{ $user->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Phân quyền sử dụng chức năng</h5>
                    {{-- <button type="button" class="btn" data-bs-dismiss="modal"><i class="far fa-times-circle"></i></button> --}}
                </div>
                <div class="modal-body">
                    <table style="width: 100%">
                        <thead>
                            <th></th>
                            <th>Xem</th>
                            <th>Thêm - xóa - sửa</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-left">Quản lý phương tiện</th>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="vehicle_read_all" name="vehicle_read_all">
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="vehicle_action_all" name="vehicle_action_all">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Phương tiện</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="vehicle_read" name="vehicle_read" {{ $user->vehicle_read == '1' ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="vehicle_action" name="vehicle_action" {{ $user->vehicle_action == '1' ? 'checked' : '' }}>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Lịch sử bàn giao</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="transfer_read" name="transfer_read" {{ $user->transfer_read == '1' ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="transfer-create" name="transfer_action" {{ $user->transfer_action == '1' ? 'checked' : '' }}>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Bảo dưỡng - sửa chữa</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="maintenance_read" name="maintenance_read" {{ $user->maintenance_read == '1' ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="maintenance-create" name="maintenance_action" {{ $user->maintenance_action == '1' ? 'checked' : '' }}/>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Nhân sự</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="personal_read" name="personal_read" {{ $user->personal_read == '1' ? 'checked' : '' }}/>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="personal-create" name="personal_action" {{ $user->personal_action == '1' ? 'checked' : '' }}/>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Phòng ban</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="department_read" name="department_read" {{ $user->department_read == '1' ? 'checked' : '' }}/>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="department-create" name="department_action" {{ $user->department_action == '1' ? 'checked' : '' }}/>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Dự án</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="project_read" name="project_read" {{ $user->project_read == '1' ? 'checked' : '' }}/>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="project-create" name="project_action" {{ $user->project_action == '1' ? 'checked' : '' }}/>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Đơn vị</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="unit_read" name="unit_read" {{ $user->unit_read == '1' ? 'checked' : '' }}/>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="unit-create" name="unit_action" {{ $user->unit_action == '1' ? 'checked' : '' }}/>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Vật tư</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="warehouse_read" name="warehouse_read" {{ $user->warehouse_read == '1' ? 'checked' : '' }}/>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="warehouse-create" name="warehouse_action" {{ $user->warehouse_action == '1' ? 'checked' : '' }}/>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Nhập kho</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="stockin_read" name="stockin_read" {{ $user->stockin_read == '1' ? 'checked' : '' }}/>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="stockin-create" name="stockin_action" {{ $user->stockin_action == '1' ? 'checked' : '' }}/>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Nhà cung cấp</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="supplier_read" name="supplier_read" {{ $user->supplier_read == '1' ? 'checked' : '' }}/>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="supplier-create" name="supplier_action" {{ $user->supplier_action == '1' ? 'checked' : '' }}/>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Xe đổ dầu</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="diesel_read" name="diesel_read" {{ $user->diesel_read == '1' ? 'checked' : '' }}/>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="diesel-create" name="diesel_action" {{ $user->diesel_action == '1' ? 'checked' : '' }}/>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Dụng cụ bảo hộ</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="protection_read" name="protection_read" {{ $user->protection_read == '1' ? 'checked' : '' }}/>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="" id="protection-create" name="protection_action" {{ $user->protection_action == '1' ? 'checked' : '' }}/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- /.card-body -->                    
                </div>
                <div class="modal-footer btn-group-sm">
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                    <a href="#" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Hủy</a>
                </div>
            </div>
        </div>
    </div>
</form>