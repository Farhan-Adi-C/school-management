<?php

namespace App\Filament\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as AuthLogin;
use Filament\Forms\Components\Component;

class Login extends AuthLogin
{

    public function mount(): void
    {

        parent::mount();

        if (app()->environment('local')) {
            $this->form->fill([
                // 'email' => 'admin@gmail.com',
                'name' => 'yourname',
                'password' => 'password',
                'remember' => true
            ]);
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // $this->getEmailFormComponent(),
                $this->getLoginFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('login')
            ->label('Login')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $login_type = filter_var($data['login'], FILTER_VALIDATE_EMAIL ) ? 'email' : 'name';
 
        return [
            $login_type => $data['login'],
            'password'  => $data['password'],
        ];
    }
}
