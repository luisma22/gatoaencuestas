<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
Use Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPassword extends Component
{
    public $email = '';
    public $password = '';
    public $passwordConfirmation = '';
    public $urlID = '';

    protected $rules= [
        'email' => 'required|email',
        'password' => 'required|min:8|same:passwordConfirmation',
    ];

    public function messages()
    {
        return [
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser un correo electrónico válido.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres.',
            'password.same' => 'La confirmación de la contraseña no coincide.',
        ];
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }

    public function mount($id) {
        $existingUser = User::find($id);
        $this->urlID = intval($existingUser->id);
    }

    public function update(){
        
        $this->validate(); 
          
        $existingUser = User::where('email', $this->email)->first();

        if($existingUser && $existingUser->id == $this->urlID) { 
            $existingUser->update([
                'password' => $this->password
            ]);
            redirect('sign-in')->with('status', 'Tu password ha sido restablecida!');
        } else {
            return back()->with('email', "No podemos encontrar ningún usuario con esa dirección de correo electrónico.");
        }
    
    }

}
