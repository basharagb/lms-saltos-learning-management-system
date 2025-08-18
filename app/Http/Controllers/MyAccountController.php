<?php

namespace App\Http\Controllers;


use App\Helpers\Qs;
use App\Http\Requests\UserChangePass;
use App\Http\Requests\UserUpdate;
use App\Repositories\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller
{
    protected $user;

    public function __construct(UserRepo $user)
    {
        $this->user = $user;
    }

    public function edit_profile()
    {
        $d['my'] = Auth::user();
        return view('pages.support_team.my_account', $d);
    }

    public function update_profile(UserUpdate $req)
    {
        $user = Auth::user();

        $d = $user->username ? $req->only(['email', 'phone', 'address']) : $req->only(['email', 'phone', 'address', 'username']);

        if(!$user->username && !$req->username && !$req->email){
            return back()->with('pop_error', __('msg.user_invalid'));
        }

        $user_type = $user->user_type;
        $code = $user->code;

        if($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'photo.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath($user_type).$code, $f['name']);
            $d['photo'] = asset('storage/' . $f['path']);
        }

        $this->user->update($user->id, $d);
        return back()->with('flash_success', __('msg.update_ok'));
    }

    public function change_pass(UserChangePass $req)
    {
        $user_id = Auth::user()->id;
        $my_pass = Auth::user()->password;
        $old_pass = $req->current_password;
        $new_pass = $req->password;

        if(password_verify($old_pass, $my_pass)){
            $data['password'] = Hash::make($new_pass);
            $this->user->update($user_id, $data);
            return back()->with('flash_success', __('msg.p_reset'));
        }

        return back()->with('flash_danger', __('msg.p_reset_fail'));
    }

    public function update_photo(Request $req)
    {
        $user = Auth::user();
        
        if(!$req->hasFile('photo')) {
            return back()->with('flash_danger', __('msg.photo_upload_error'));
        }

        $photo = $req->file('photo');
        
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($photo->getMimeType(), $allowedTypes)) {
            return back()->with('flash_danger', __('msg.photo_type_error'));
        }
        
        // Validate file size (2MB)
        if ($photo->getSize() > 2 * 1024 * 1024) {
            return back()->with('flash_danger', __('msg.photo_size_error'));
        }

        $user_type = $user->user_type;
        $code = $user->code;

        // Get file metadata and store
        $f = Qs::getFileMetaData($photo);
        $f['name'] = 'photo.' . $f['ext'];
        $f['path'] = $photo->storeAs(Qs::getUploadPath($user_type).$code, $f['name']);
        
        $data['photo'] = asset('storage/' . $f['path']);
        
        $this->user->update($user->id, $data);
        return back()->with('flash_success', __('msg.photo_upload_success'));
    }

    public function remove_photo()
    {
        $user = Auth::user();
        
        if($user->photo && $user->photo !== Qs::getDefaultUserImage()) {
            // Remove the photo file from storage if it exists and it's not the default
            // Handle both asset URLs and direct storage paths
            $photoPath = $user->photo;
            if (strpos($photoPath, asset('storage/')) === 0) {
                $photoPath = str_replace(asset('storage/'), '', $photoPath);
            } elseif (strpos($photoPath, 'storage/') === 0) {
                $photoPath = str_replace('storage/', '', $photoPath);
            }
            
            if(\Storage::disk('public')->exists($photoPath)) {
                \Storage::disk('public')->delete($photoPath);
            }
            
            // Update user record to set back to default photo
            $data['photo'] = Qs::getDefaultUserImage();
            $this->user->update($user->id, $data);
            
            return back()->with('flash_success', __('msg.photo_remove_success'));
        }
        
        return back()->with('flash_danger', __('msg.photo_remove_error'));
    }

}
