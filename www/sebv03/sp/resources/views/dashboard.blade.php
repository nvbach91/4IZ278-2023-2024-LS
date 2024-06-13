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
                <div class="bg-gray-100 p-8 rounded-lg shadow mt-16">
                    <h1 class="text-xl font-bold mb-4">Create a new account</h1>
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('account.store') }}" method="post">
                        @csrf
                        <div class="flex flex-col mb-4">
                            <label for="display_name" class="mb-2 font-semibold">Display name:</label>
                            <input type="text" name="display_name" id="display_name" class="border border-gray-300 p-2 rounded-lg" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create account</button>
                    </form>
                </div>
        </div>
@endsection
