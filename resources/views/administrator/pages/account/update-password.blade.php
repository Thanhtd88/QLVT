<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('put')
    <div class="modal fade" id="update-password" tabindex="-1" aria-labelledby="update-password" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-password">Đổi mật khẩu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">  
                    <div class="card-body">
                        <div class="box1 col-md-12">
                            <div class="form-group">
                                <x-input-label for="update_password_current_password" :value="__('Mật khẩu hiện tại')" />
                                <div class="input-group mb-3"  id="show_hide_current_password">
                                    <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control"  autocomplete="current-password" aria-describedby="current_password" required/>
                                    <span class="input-group-text" id="current_password"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                </div>    
                            </div>
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>
                        <div class="box1 col-md-12">
                            <div class="form-group">
                                <x-input-label for="update_password_password" :value="__('Mật khẩu mới')"/>
                                <div class="input-group mb-3" id="show_hide_password">
                                    <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" aria-describedby="password" required/>
                                    <span class="input-group-text" id="password"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>
                        <div class="box1 col-md-12">
                            <div class="form-group">
                                <x-input-label for="update_password_password_confirmation" :value="__('Xác nhận mật khẩu')" />
                                <div class="input-group" id="show_hide_password_confirmation">
                                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" aria-describedby="password_confirmation" required/>
                                    <span class="input-group-text" id="password_confirmation"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                </div>                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Đóng</button>
                    <div class="flex items-center gap-4">
                        <button class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
                        @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>    
    </div>
</form>