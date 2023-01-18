<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class RegisterPage extends Component
{
    public $email;
    public $password;
    public $repassword;
    public $first_name;
    public $last_name;
    public $gender;

    protected $rules = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'repassword' => 'required|same:password',
        'first_name' => 'required|string',
        'last_name' => 'nullable|string',
        'gender' => 'nullable',
    ];

    protected $messages = [
        'email.required' => 'Email tidak boleh kosong.',
        'email.email' => 'Format Email salah.',
        'password.required' => 'Password tidak boleh kosong.',
        'password.min' => 'Password harus lebih dari 8 karakter.',
        'repassword.same' => 'Konfirmasi password tidak sama.',
        'repassword.required' => 'Konfirmasi password tidak sama.',
        'first_name.required' => 'Nama depan tidak boleh kosong.',
        'first_name.string' => 'Nama depan harus berupa teks.',
        'last_name.string' => 'Nama belakang harus berupa teks.',
    ];
 
    public function mount() {
        $this->gender = 'male';
    }

    public function render()
    {
        return view('livewire.register-page')->layout('layouts.root-page');
    }

    public function register() {
        $validatedData = $this->validate();
        
        $generator_rules = [
            'table' => 'users',
            'length' => '10',
            'prefix' => date('ymd'),
        ];
        $id = IdGenerator::generate($generator_rules);

        $user = new User;
        $user->id = $id;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->gender = $this->gender;
        $user->save();
        return redirect()->route('base-login');

    }
}
