<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ListUsers extends Component
{
    public $state = [];
    public $showEditModal = false;
    public $user;
    public $userIdBeingDelete = null;



    public function addNew()
    {
        $this->state = [];
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser()
    {
        $validatedData = Validator::make(
            $this->state,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $this->user->id . ',id',
                'password' => 'somtimes|confirmed'
            ]
        )
            ->validate();
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        $user = $this->user->update($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'user updated successfully']);
    }

    public function confirmDelete($userId)
    {
        $this->userIdBeingDelete = $userId;
        $this->dispatchBrowserEvent('show-confirm-delete-form');
    }

    public function deleteUser()
    {
        $user = User::find($this->userIdBeingDelete);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'user deleted successfully']);
    }

    public function createUser()
    {

        $validatedData = Validator::make(
            $this->state,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed'
            ]
        )
            ->validate();
        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'user added successfully']);
        // session()->flash('message', 'User added successfully.');
        // return  redirect()->back();
    }

    public function edit(User $user)
    {

        $this->showEditModal = true;
        //dd($this->showEditModal);
        $this->user = $user;
        $this->state = $user->toArray();
        // dd($this->state);
        $this->dispatchBrowserEvent('show-form');
        //dd($user);
    }
    public function render()
    {
        $users = User::latest()->paginate(10);
        return view('livewire.admin.users.list-users', ['users' => $users]);
    }
}
