@extends('layouts.app')

@section('title', 'Retirada de Equipamentos - Gerenciamento completo.')

@section('content')
    <div class="row">
            <div class="col-8 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">

                            <!-- Coluna do título -->
                            <div class="col-md-6 col-12 title-format">
                                <h5 class="mb-0">Retiradas</h5>
                                <p class="text-sm mb-0">
                                    <span class="font-weight-bold">Gerenciamento</span> completo
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 first-item">
                        <div class="container">
                            @livewire('newTake')
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <!-- Coluna do título -->
                            <div class="col-12 title-format">
                                <h5 class="mb-0">Equipamentos selecionados:</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 first-item">
                        <div class="container">
                            @livewire('take-items-list')
                        </div>
                    </div>
                </div>
            </div>
        </div>



    @if(session('msg-success'))
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .success({
                    message: '{{ session('msg-success') }}',
                    dismissible: true,
                    duration: 5000
                });
        </script>
    @endif

    @if(session('msg-error'))
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .error({
                    message: '{{ session('msg-error') }}',
                    dismissible: true,
                    duration: 5000
                })
        </script>
    @endif

    @if ($errors->any())
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .error({
                    message: '{{ $errors->first() }}',
                    dismissible: true,
                    duration: 5000
                })
        </script>
    @endif

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsivity.css') }}">
    <script src="{{ asset('assets/js/resources/new-user.js') }}"></script>
    <script src="{{ asset('assets/js/take/realtime-take.js') }}"></script>
@endsection
