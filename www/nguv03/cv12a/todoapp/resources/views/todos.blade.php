<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        button { width: 80px }
        .form-row { display: flex }
    </style>
</head>
<body>
    <h1>Todo list</h1>

    <form method="POST" action="{{ route('saveTodo') }}">
        @csrf
        <div class="form-row">
            <input placeholder="title" name="title">
            <button>Submit</button>
            @if($errors->has('title'))
                <p style="background-color: red">{{  $errors->first('title') }}</p>
            @endif
        </div>
    </form>

    <ul>
        @foreach ($todos as $todo)
            <li style="display: flex">
                <form method="POST" action="{{ route('deleteTodo', $todo->id) }}">
                    @csrf @method('DELETE')
                    <button>Delete</button>
                </form>
                @if($todo->finished == 1)
                    <form method="POST" action="{{ route('unfinishTodo', $todo->id) }}">
                        @csrf @method('PUT')
                        <button>Unfinish</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('finishTodo', $todo->id) }}">
                        @csrf @method('PUT')
                        <button>Finish</button>
                    </form>
                @endif
                <div style="{{ $todo->finished == 1 ? 'background-color:green' : ''}}">{{ $todo->id }} {{ $todo->title }}</div>
            </li>
        @endforeach
    </ul>
    <footer>Powered by Laravel</footer>
</body>
</html>
