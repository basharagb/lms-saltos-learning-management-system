@extends('layouts.master')
@section('page_title', __('account.my_account'))
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">{{ __('account.my_account') }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#change-pass" class="nav-link active" data-toggle="tab">{{ __('account.change_password') }}</a></li>
                <li class="nav-item"><a href="#photo-upload" class="nav-link" data-toggle="tab"><i class="icon-image2"></i> {{ __('account.upload_new_photo') }}</a></li>
                @if(Qs::userIsPTA())
                    <li class="nav-item"><a href="#edit-profile" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> {{ __('account.manage_profile') }}</a></li>
                @endif
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="change-pass">
                    <div class="row">
                        <div class="col-md-8">
                            <form method="post" action="{{ route('my_account.change_pass') }}">
                                @csrf @method('put')

                                <div class="form-group row">
                                    <label for="current_password" class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.current_password') }} <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="current_password" name="current_password"  required type="password" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.new_password') }} <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="password" name="password"  required type="password" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.confirm_password') }} <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="password_confirmation" name="password_confirmation"  required type="password" class="form-control" >
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-danger">{{ __('account.submit_form') }} <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Photo Upload Section -->
                <div class="tab-pane fade" id="photo-upload">
                    <div class="row">
                        <div class="col-md-8">
                            <form enctype="multipart/form-data" method="post" action="{{ route('my_account.update_photo') }}">
                                @csrf @method('put')
                                
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.current_photo') }}</label>
                                    <div class="col-lg-9">
                                        @if($my->photo)
                                            <div class="mb-3">
                                                <img src="{{ $my->photo }}" alt="Profile Photo" class="img-fluid rounded" style="max-width: 150px; max-height: 150px;">
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <img src="{{ asset('assets/images/default-avatar.svg') }}" alt="Default Avatar" class="img-fluid rounded" style="max-width: 150px; max-height: 150px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_photo" class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.upload_new_photo') }}</label>
                                    <div class="col-lg-9">
                                        <input id="new_photo" accept="image/*" type="file" name="photo" class="form-control" data-fouc>
                                        <small class="form-text text-muted">Supported formats: JPG, PNG, GIF. Max size: 2MB</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.photo_preview') }}</label>
                                    <div class="col-lg-9">
                                        <div id="photo-preview" class="mb-3" style="display: none;">
                                            <img id="preview-image" src="" alt="Preview" class="img-fluid rounded" style="max-width: 150px; max-height: 150px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">{{ __('account.submit_form') }} <i class="icon-paperplane ml-2"></button>
                                </div>
                            </form>
                            
                            <!-- Remove Photo Button - Separate from upload form -->
                            @if($my->photo)
                                <div class="mt-3 text-center">
                                    <form method="post" action="{{ route('my_account.remove_photo') }}" style="display: inline;">
                                        @csrf @method('delete')
                                        <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to remove your profile photo?')">
                                            <i class="icon-trash"></i> {{ __('account.remove_photo') }}
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if(Qs::userIsPTA())
                    <div class="tab-pane fade" id="edit-profile">
                        <div class="row">
                            <div class="col-md-6">
                                <form enctype="multipart/form-data" method="post" action="{{ route('my_account.update') }}">
                                    @csrf @method('put')

                                    <div class="form-group row">
                                        <label for="name" class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.name') }}</label>
                                        <div class="col-lg-9">
                                            <input disabled="disabled" id="name" class="form-control" type="text" value="{{ $my->name }}">
                                        </div>
                                    </div>

                                    @if($my->username)
                                        <div class="form-group row">
                                            <label for="username" class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.username') }}</label>
                                            <div class="col-lg-9">
                                                <input disabled="disabled" id="username" class="form-control" type="text" value="{{ $my->username }}">
                                            </div>
                                        </div>

                                    @else

                                        <div class="form-group row">
                                            <label for="username" class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.username') }} </label>
                                            <div class="col-lg-9">
                                                <input id="username" name="username"  type="text" class="form-control" >
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label for="email" class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.email') }} </label>
                                        <div class="col-lg-9">
                                            <input id="email" value="{{ $my->email }}" name="email"  type="email" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone" class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.phone') }} </label>
                                        <div class="col-lg-9">
                                            <input id="phone" value="{{ $my->phone }}" name="phone"  type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone2" class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.telephone') }} </label>
                                        <div class="col-lg-9">
                                            <input id="phone2" value="{{ $my->phone2 }}" name="phone2"  type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address" class="col-lg-3 col-form-label font-weight-semibold">{{ __('account.address') }} </label>
                                        <div class="col-lg-9">
                                            <input id="address" value="{{ $my->address }}" name="address"  type="text"  class="form-control" >
                                        </div>
                                    </div>

                                    {{-- Photo upload removed from here - now handled in dedicated photo upload tab --}}

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-danger">{{ __('account.submit_form') }} <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{--My Profile Ends--}}

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Photo preview functionality
    $('#new_photo').change(function() {
        const file = this.files[0];
        if (file) {
            // Check file size (2MB limit)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size must be less than 2MB');
                this.value = '';
                return;
            }
            
            // Check file type
            if (!file.type.match('image.*')) {
                alert('Please select an image file');
                this.value = '';
                return;
            }
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
                $('#photo-preview').show();
            };
            reader.readAsDataURL(file);
        } else {
            $('#photo-preview').hide();
        }
    });
});
</script>
@endsection
