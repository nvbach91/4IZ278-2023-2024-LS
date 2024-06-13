@extends('layouts.base')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
        <h1 class="text-2xl font-bold mb-4">Detail of {{ $account->display_name }}</h1>

        <div class="mb-6">
            <h2 class="text-lg font-semibold">Account balance:</h2>
            <div class="flex justify-between items-center bg-gray-100 p-4 rounded-lg shadow mt-2">
                <span class="text-3xl font-bold">{{ number_format($account->balance, 2) }}-,</span>
                <a href="{{route('account.make-payment', ['account' => $account->id] )}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Make a payment
                </a>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-semibold">Users with permission:</h2>
            <div class="flex justify-between items-center bg-gray-100 p-4 rounded-lg shadow mt-2">
                <div>
                    @foreach($account->getPermissions() as $permission)
                        <span class="block">{{ $permission->user->name }}</span>
                    @endforeach
                </div>
                <a href="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Manage permissions
                </a>
            </div>
        </div>

        <div>
            <h2 class="text-lg font-semibold">Transactions:</h2>
            <div class="space-y-4 mt-2">
                @foreach($account->getTransactions() as $transaction)
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <div class="flex justify-between items-center">
                            <div>
                                @isset($transaction->message)
                                    <span class="block text-gray-700">{{ $transaction->message }}</span>
                                @endisset
                                <span class="block text-gray-500 text-sm">{{ $transaction->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                            <span class="text-xl font-bold {{  $transaction->targetAccount == $account ? 'text-green-500' : 'text-red-500' }}">
                                {{ number_format($transaction->amount, 2) }}-,
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
