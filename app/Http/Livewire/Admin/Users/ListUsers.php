<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class ListUsers extends Component
{
    public $state=[];
    public $user;
    public $showEditModal=false;
    public $userIdBeingRemoved=null;

    public function AddNew()
    {
        $this->state=[];
        $this->showEditModal=false;
        $this->showHideForm('show-form');
    }

    public function createUser()
    {
       $validateData=Validator::make($this->state, [
        'name'=>'required',
        'email'=>'required|email|unique:users,email',
        'password'=>'required|confirmed',
       ])->validate();

       $validateData['password']= Hash::make($validateData['password']);
        User::create($validateData);
        //session()->flash('message', 'User added successfully!')
        $this->showHideForm('hide-form', ['message'=>'User added successfully!']);
    }

    public function edit(User $user)
    {
        $this->showEditModal=true;
        $this->user=$user;
        $this->state=$user->toArray();
        $this->showHideForm('show-form');

    }

    public function updateUser()
    {
        $validateData=Validator::make($this->state, [
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$this->user->id,
            'password'=>'sometimes|confirmed',
           ])->validate();

           if(!empty( $validateData['password'])){
                $validateData['password']= Hash::make($validateData['password']);
           }
            $this->user->update($validateData);
            $this->showHideForm('hide-form', ['message'=>'User updated successfully!']);

    }

    public function confirmUserRemoval($userId)
    {
        $this->userIdBeingRemoved=$userId;
        $this->showHideForm('show-delete-modal');
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->showHideForm('hide-delete-modal', ['message'=>'User deleted successfully!']);
    }

    public function render()
    {
        $users=User::latest()->paginate();
        return view('livewire.admin.users.list-users', ['users'=>$users]);
    }

    private function showHideForm(String $name, array $message=[])
    {
        return $this->dispatchBrowserEvent($name, $message);
    }

}
