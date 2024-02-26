<form method="POST" action="{{ route('admin.account.store') }}">
    @csrf
    <div class="modal fade" id="create-account" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tài khoản - tạo mới</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal"><i class="far fa-times-circle"></i></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <!-- Name -->
                        <div class="form-group input-group-sm">
                            <label for="tenpb">Họ tên</label>
                            <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <!-- Email Address -->
                        <div class="form-group input-group-sm">
                            <label for="">Email</label>
                            <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <!-- Password -->
                        <div class="form-group">
                            <label for="">Mật khẩu</label>
        
                            <div class="input-group input-group-sm" id="show_hide_password">
                                <x-text-input id="password" class="form-control"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="">Xác nhận mật khẩu</label>
        
                            <div class="input-group input-group-sm" id="show_hide_password_confirmation">
                                <x-text-input id="password_confirmation" class="form-control"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <!-- /.card-body -->  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Hủy</a>
                </div>
            </div>
        </div>
    </div>
</form>