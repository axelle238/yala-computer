<?php

/**
 * Komponen: Admin\Login
 * Peran: Menangani proses masuk administrator ke sistem
 */

namespace App\Livewire\Admin;

use App\Traits\PencatatLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    use PencatatLog;

    public $surel;

    public $kata_sandi;

    public $ingat_saya = false;

    protected $rules = [
        'surel' => 'required|email',
        'kata_sandi' => 'required',
    ];

    /**
     * Proses Login.
     */
    public function masuk()
    {
        $this->validate();

        if (Auth::attempt(['surel' => $this->surel, 'password' => $this->kata_sandi], $this->ingat_saya)) {
            session()->regenerate();

            $this->catatAktivitas(
                'login',
                'Sistem',
                'Admin '.Auth::user()->nama.' berhasil masuk ke sistem administrasi.'
            );

            return redirect()->intended(route('admin.dashboard'));
        }

        throw ValidationException::withMessages([
            'surel' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ]);
    }

    /**
     * Render komponen.
     */
    public function render()
    {
        return view('livewire.admin.login')
            ->layout('components.layouts.app', ['title' => 'Login Admin']);
    }
}
