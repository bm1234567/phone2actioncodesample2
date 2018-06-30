<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>
<body>
    <main id="app">
        <nav>
            <a href="{{ route('blogs.index') }}" dusk="blogs-link">Blogs</a>
            <a href="{{ route('blogs.create') }}" dusk="blogs-create-link">Create Blog</a>
        </nav>
        @if(Session::has('message'))
            <div>{{ Session::get('message') }}</div>
        @endif

        @if ($errors->any())
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif

        <h1>
            @yield('pagetitle')
        </h1>

        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>
        var app = new Vue({
            el: '#app',
            methods: {
                confirmDelete(msg, event){
                    if ( ! confirm(msg)) {
                        event.preventDefault();
                        return false;
                    }
                }
            }
        })
    </script>
</body>
</html>