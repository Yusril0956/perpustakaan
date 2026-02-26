<?php

namespace App\Livewire\Forms\Admin\Users;

use App\Models\User;
use Livewire\Form;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;

class UserForm extends Form
{
    public ?User $user = null;

    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|min:8')]
    public $password = '';

    #[Validate('required')]
    public $role = '';

    #[Validate('nullable|numeric|digits_between:10,15')]
    public $phone = '';

    #[Validate('nullable|min:5')]
    public $address = '';

    public function setUser(?User $user = null)
    {
        $this->user = $user;

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->password = '';
            $this->phone = $user->phone ?? '';
            $this->address = $user->address ?? '';
            $this->role = $user->getRoleNames()->first() ?? '';
        }
    }

    public function store()
    {
        $this->validate($this->rules());

        $data = $this->all();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        // Assign role
        if ($this->role) {
            $user->assignRole($this->role);
        }
    }

    public function update()
    {
        $this->validate($this->rules());

        $data = $this->except(['user', 'password']);

        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }

        $this->user->update($data);

        // Update role
        if ($this->role) {
            $this->user->syncRoles([$this->role]);
        }
    }

    protected function rules()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'role' => 'required',
            'phone' => 'nullable|numeric|digits_between:10,15',
            'address' => 'nullable|min:5',
        ];

        // If editing, make password optional and validate email uniqueness excluding current user
        if ($this->user) {
            $rules['email'] = ['required', 'email', Rule::unique('users')->ignore($this->user->id)];
            $rules['password'] = 'nullable|min:8';
        } else {
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|min:8';
        }

        return $rules;
    }
}
