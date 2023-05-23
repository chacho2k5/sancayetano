<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>SAN CAYETANO</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Font Awesome Icons (chacho - Ver si esto no deberia ir en la carpeta VENDOR) -->
        <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        {{-- @isset($css)
            {{ $css }}
        @endisset --}}
        <style> 
            .my-table-responsive {
              overflow-x: scroll;
              width: 1366px;
              max-width: 100%;
            }
        </style>
        <!-- Alpine Plugins -->
        <script defer src="https://unpkg.com/@alpinejs/focus@3.12.0/dist/cdn.min.js"></script>
        <script defer src="https://unpkg.com/@alpinejs/mask@3.12.0/dist/cdn.min.js"></script>
        <!-- Alpine Core -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
        
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-light">
        {{-- No se para que es este componente, pero se produce un flasheo cada vez que se ejecuta una opcion del nav --}}
        {{-- <x-jet-banner /> --}}
         @livewire('navigation-menu')

        <!-- Page Heading -->
        {{-- @isset($header)
            <header class="py-3 bg-white shadow-sm d-flex border-bottom">
                <div class="container">
                    {{ $header }}
                </div>
            </header>
        @endisset --}}

        {{-- @isset($header)
            <header class="py-2 h4 d-flex">
                <div class="container">
                    {{ $header }}
                </div>
            </header>
        @endisset --}}

        <!-- Page Content -->
        {{-- <main class="container my-5"> --}}
        {{-- <main class="my-2 container-fluid"> --}}
        <main class="my-2 container-fluid">
            {{ $slot }}
        </main>

        @stack('modals')
        @livewireScripts
        {{-- <script>
            window.addEventListener('alert', event => {
                result = window.alert(event.detail.msg);
            });

            window.addEventListener('sumar-estado', event => {
                result = window.confirm(event.detail.msg);
                if (result) {
                    pendiente = false;
                    if(event.detail.pendiente !== 0) {
                        result = window.confirm("La OT tiene otra OT pendiente, desea cambiar el estado de ambas?");
                        if (result) {
                            pendiente = true;
                        }
                    }
                    window.Livewire.emit('grabar-proximo-estado',
                            {
                                id : event.detail.id,
                                orden : event.detail.orden,
                                estado_id : event.detail.estado_id,
                                pendiente : pendiente
                            });
                }
            });
            
            // window.addEventListener('sumar-estado', event => {
            //     result = window.confirm(event.detail.msg);
            //     if (result) {
            //         window.Livewire.emit('grabar-proximo-estado',
            //         {
            //             id : event.detail.id,
            //             orden : event.detail.orden,
            //             estado_id : event.detail.estado_id,
            //             pendiente_numero : event.detail.pendiente_numero
            //         });
            //     } else {
            //     }
            // });

            window.addEventListener('cancelar-ot', event => {
                result = window.confirm(event.detail.msg);
                if (result) {
                    window.Livewire.emit('borrarOtTemp', {id : event.detail.numero});
                }
            });

            window.addEventListener('msg-box', event => {
                result = window.confirm(event.detail.msg);
                if (result) {
                    // console.log(event.detail.id);
                    window.livewire.emit('borrar', {id : event.detail.id});
                }
                // alert(event.detail.id);
            });

            // Livewire.on('alert', function(message) {
            //     alert(message);
            //     // Swal.fire(
            //     //     'Good job!',
            //     //     message,
            //     //     'success'
            //     // )
            // });
        </script> --}}
        @stack('scripts')

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        @isset($js)
            {{ $js }}
        @endisset
    </body>
</html>
