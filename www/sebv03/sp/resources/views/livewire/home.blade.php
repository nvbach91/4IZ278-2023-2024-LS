<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
    <div class="flex justify-center mb-4">
        <button
            class="px-4 py-2 border-b-2 focus:outline-none {{ $isLogin ? 'border-blue-500 text-blue-500' : 'border-transparent text-gray-500' }}"
            wire:click="toggleLogin"
        >
            Login
        </button>
        <button
            class="ml-4 px-4 py-2 border-b-2 focus:outline-none {{ !$isLogin ? 'border-blue-500 text-blue-500' : 'border-transparent text-gray-500' }}"
            wire:click="toggleLogin"
        >
            Register
        </button>
    </div>
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @isset($message)
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ $message }}
        </div>
    @endisset

    @if($isLogin)
        @include('auth.login')
    @else
        @include('auth.register')
    @endif
</div>
