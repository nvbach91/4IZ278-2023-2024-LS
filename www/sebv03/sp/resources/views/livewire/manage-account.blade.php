<div>
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
        <h1 class="text-2xl font-bold mb-4">Detail of {{ $account->display_name }}</h1>
        <h2 class="text-lg font-semibold">Account ID: {{ $account->id }}</h2>
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Account balance:</h2>
            <div class="flex justify-between items-center bg-gray-100 p-4 rounded-lg shadow mt-2">
                <span class="text-3xl font-bold">{{ number_format($account->balance, 2) }}-,</span>
                @if($usersPermission != 'follower')
                <a href="{{route('account.make-payment', ['account' => $account->id] )}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Make a payment
                </a>
                @endif
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-semibold">Users with permission:</h2>
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="flex flex-col bg-gray-100 p-4 rounded-lg shadow mt-2">
                <div class="flex justify-between items-center">
                    <div>
                        @foreach($account->getPermissions() as $permission)
                            <span class="block">{{ $permission->user->name }}</span>
                        @endforeach
                    </div>
                    @if($usersPermission == 'owner')
                    <button wire:click="toggleManagePermissions" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Manage permissions
                    </button>
                    @endif
                </div>
                @if($showManagePermissions)
                    <div class="m-4">
                        <table class="min-w-full bg-white">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">User</th>
                                <th class="px-4 py-2">Permission Type</th>
                                <th class="px-4 py-2 text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($account->getPermissions() as $permission)
                                @if($permission->user->id == auth()->id())
                                    @continue
                                @endif
                                <tr>
                                    <td class="border px-4 py-2">{{ $permission->user->name }}</td>
                                    <td class="border px-4 py-2">
                                        <select wire:change="changePermissionType({{ $permission->id }}, $event.target.value)">
                                            <option value="manager" {{ $permission->permission == 'manager' ? 'selected' : '' }}>manager</option>
                                            <option value="follower" {{ $permission->permission == 'follower' ? 'selected' : '' }}>follower</option>
                                        </select>
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <button wire:click="removePermission({{ $permission->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="border px-4 py-2">
                                    <input type="text" wire:model.live.debounce.50ms="search" wire:keydown.debounce.50ms="updateSearch" wire:keydown="updateSearch" placeholder="Search users" class="w-full p-2 border border-gray-300 rounded">
                                    <ul class="bg-white border border-gray-300 rounded mt-2">
                                        @foreach($allUsers as $user)
                                            @if(!$account->getPermissions()->contains('user_id', $user->id))
                                                <li class="px-4 py-2 cursor-pointer @if($newPermissionUserId == $user->id) bg-gray-200 @endif hover:bg-gray-100" wire:click="$set('newPermissionUserId', {{ $user->id }})">{{ $user->name }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="border px-4 py-2">
                                    <select  wire:model="newPermissionType">
                                        <option value="manager">manager</option>
                                        <option value="follower">follower</option>
                                    </select>
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <button wire:click="addPermission" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Add Permission
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div>
            <h2 class="text-lg font-semibold">Transactions:</h2>
            <div class="space-y-4 mt-2">
                @foreach($transactions as $transaction)
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <div class="flex justify-between items-center">
                            <div>
                                @isset($transaction->message)
                                    <span class="block text-gray-700">{{ $transaction->message }}</span>
                                @endisset
                                <span class="block text-gray-500 text-sm">{{ $transaction->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="text-xl font-bold {{  $transaction->targetAccount == $account ? 'text-green-500' : 'text-red-500' }}">
                                    {{$transaction->targetAccount == $account ? '+' : '-'}}{{ number_format($transaction->amount, 2) }}-,
                                </span>
                                <span class="block text-gray-500 text-sm">{{ $transaction->targetAccount == $account ? 'From:' . App\Models\User::find($transaction->sent_by)->name : 'To: ' . $transaction->targetAccount->getOwner()->name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div class="mt-4">
                        {{ $transactions->links() }}
                    </div>
            </div>
        </div>
    </div>
</div>
