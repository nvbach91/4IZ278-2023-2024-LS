<?php

namespace App\Livewire;

use App\Http\Controllers\AccountPermissionController;
use App\Models\Account;
use App\Models\AccountPermission;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class ManageAccount extends Component
{
    use WithPagination;

    public Account $account;
    public bool $showManagePermissions = false;
    public Collection $allUsers;
    public $newPermissionType;
    public $newPermissionUserId;
    public bool $isOnlyOwner;
    public $search = '';
   public $usersPermission;

    public function mount(Account $account)
    {
        $this->account = $account;
        $this->allUsers = collect();
        $this->isOnlyOwner = $this->account->accountPermissions()->where('permission', 'owner')->count() == 1;
        $this->usersPermission = $this->account->accountPermissions()->where('user_id', auth()->id())->first()->permission;
        $this->newPermissionType = 'manager';
    }
    public function render()
    {
        $transactions = $this->account->getTransactions()->orderBy('created_at', 'desc')->paginate(3);
        return view('livewire.manage-account',
            [
                'transactions' => $transactions
            ]);
    }
    public function toggleManagePermissions()
    {
        $this->showManagePermissions = !$this->showManagePermissions;
    }
    public function changePermissionType($permissionId, $permission)
    {
        app('App\Http\Controllers\AccountPermissionController')->update($permissionId, $permission);
    }
    public function removePermission($permissionId)
    {
        app('App\Http\Controllers\AccountPermissionController')->destroy($permissionId);
    }
    public function addPermission()
    {
        $this->validate([
            'newPermissionType' => 'required|in:manager,follower',
            'newPermissionUserId' => 'required|exists:users,id'
        ]);
        $accountPermission = new AccountPermission();
        $accountPermission->account_id = $this->account->id;
        $accountPermission->user_id = $this->newPermissionUserId;
        $accountPermission->permission = $this->newPermissionType;
        $accountPermission->save();
        $this->newPermissionType = '';
    }
    public function updateSearch()
    {
        $this->allUsers = User::where('name', 'like', '%'.$this->search.'%')->get();
    }
}
