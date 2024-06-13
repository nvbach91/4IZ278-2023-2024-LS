@extends('layouts.base')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
        <h1 class="text-2xl font-bold mb-4">Your accounts:</h1>
        <div class="space-y-4">
            @foreach($accounts as $account)
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-lg font-semibold">{{ $account->display_name }}</span>
                            <span class="text-xl font-bold block">{{ number_format($account->balance, 2) }}-,</span>
                        </div>
                        <a href="{{ route('account.show', ['account' => $account->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Manage account
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
