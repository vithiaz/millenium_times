<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserSettings extends Component
{
    use WithFileUploads;

    // Binding Variable
    public $first_name;
    public $last_name;
    public $gender;
    public $password;
    public $repassword;
    public $image;

    // public $ImgDeleteState;
    public $delete_state;

    public function updatedImage() {
        $validator = Validator::make([ 'image' => $this->image ],
            [
                'image' => 'nullable|image|mimes:png,jpeg,jpg,svg'
            ],
            [
                'image.image' => 'tipe file harus berupa gambar',
                'image.mimes' => 'tipe file harus berupa: jpg, jpeg, png atau svg'
            ]);
        if ($validator->fails()) {
            $this->image = null;
        }
        $validator->validate();
        $this->delete_state = true;
    }

    public function mount() {
        $this->first_name = Auth::user()->first_name;
        $this->last_name = Auth::user()->last_name;
        $this->image = Auth::user()->profile_img;
        $this->gender = Auth::user()->gender;

        $this->delete_state = false;
    }

    public function render()
    {
        return view('livewire.user-settings')->layout('layouts.root-page');
    }

    public function update_data() {
        $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',    
        ]);
        $user = User::find(Auth::user()->id);
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->gender = $this->gender;
        $user->save();

        $msg = ['success' => 'Data diubah'];
        $this->dispatchBrowserEvent('display-message', $msg);
    }

    public function update_password() {
        $this->validate([
            'password' => 'required|min:8',
            'repassword' => 'required|same:password',
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($this->password);
        $user->save();

        $this->password = null;
        $this->repassword = null;
        $msg = ['success' => 'Password diubah'];
        $this->dispatchBrowserEvent('display-message', $msg);
    }

    public function empty_image() {
        $this->image = null;
        $this->delete_state = true;
    }

    public function store_image() {
        $user = User::find(Auth::user()->id);
        $msg = null;
        
        if ($this->delete_state && $user->profile_img != null) {
            if (file_exists(public_path() . '/storage/'. $user->profile_img)) {
                unlink(public_path() . '/storage/'. $user->profile_img);
            }
        }

        $store_img_path = null;
        if ($this->image != null) {
            $store_img_path = $this->image->store('profile_img');
            $msg = 'Foto profil diubah!';
        }

        $user->profile_img = $store_img_path;
        $user->save();

        if ($msg) {
            return redirect(request()->header('Referer'))->with('message', $msg);
        } else {
            return redirect(request()->header('Referer'));
        }
    }

    public function reload() {
        return redirect(request()->header('Referer'));
    }


}
