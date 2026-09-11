<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{

    public $name ='';
    public $email = '';
    public $password = '';

    protected $rules=[
    'name' => 'required|min:3',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|min:5',];

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El campo nombre debe tener al menos 3 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser un correo electrónico válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'El campo contraseña debe tener al menos 5 caracteres.',
        ];
    }

    public function store(){

        $attributes = $this->validate();

        $user = User::create($attributes);

        auth()->login($user);
        
        return redirect('/principal');
    } 

    public function render()
    {
        return view('livewire.auth.register');
    }
}
