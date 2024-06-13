<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
    <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
            <input id="password" type="password" name="password" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
        </div>
        <div class="text-center">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-200">
                Login
            </button>
        </div>
    </form>
</div>
