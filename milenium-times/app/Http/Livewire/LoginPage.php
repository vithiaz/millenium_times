<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginPage extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    protected $messages = [
        'email.required' => 'Email tidak boleh kosong.',
        'email.email' => 'Format Email salah.',
        'password.required' => 'Password tidak boleh kosong.',
    ];

    public function render()
    {
        return view('livewire.login-page')->layout('layouts.root-page');
    }

    public function login() {
        $this->validate();
        $remember_me = true;

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $remember_me)) {
            return redirect()->route('sport-home');
        }
        else {
            $this->password = '';
            session()->flash('error', 'Email atau password salah!');
        }
    }
}
