<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public bool $isLogin;

    public function mount()
    {
        $this->isLogin = true;
    }
    public function toggleLogin()
    {
        $this->isLogin = !$this->isLogin;
    }
    public function render()
    {
        return view('livewire.home');
    }
}
