<?php

namespace App\Http\Controllers;

use App\Models\AccountPermission;
use Auth;
use Illuminate\Http\Request;

class AccountPermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function update($permissionId, $permission)
    {
        $account = AccountPermission::find($permissionId)->account;
       //check if the user is the owner of the account
        if (!Auth::user()->id == $account->getOwner()->id) {
            abort(403);
        }
        //check if the permission is valid
        if (!in_array($permission, ['owner', 'manager', 'follower'])) {
            abort(400);
        }

        $accountPermission = AccountPermission::find($permissionId);
        $accountPermission->permission = $permission;
        $accountPermission->save();
        return redirect()->back();
    }
    public function destroy($permissionId)
    {
        //check if the user is the owner of the account
        if (!Auth::user()->getAccountPermissions()->where('permission', 'owner')->first()) {
            abort(403);
        }
        $accountPermission = AccountPermission::find($permissionId);
        $accountPermission->delete();
        return redirect()->back();
    }
}
