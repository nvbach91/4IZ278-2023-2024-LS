<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 flex justify-between">
        <a href="{{route('dashboard')}}" class="self-center text-xl font-semibold whitespace-nowrap">Internet banking</a>
        @if(Auth::check())
            <div class="flex items-center">
                <a href="{{route('logout')}}">Logout</a>
            </div>
        @endif
    </nav>
</header>
