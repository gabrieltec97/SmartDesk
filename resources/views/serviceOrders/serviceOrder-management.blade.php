@extends('layouts.app')

@section('title', 'Ordens de serviço')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">

                        <!-- Coluna do título -->
                        <div class="col-md-6 col-12 title-format">
                            <h5 class="mb-0">Ordens de serviço</h5>
                            <p class="text-sm mb-0">
                                <span class="font-weight-bold">Gerenciamento</span> completo
                            </p>
                        </div>

                        <!-- Coluna dos botões -->
                        <div class="col-md-6 col-12 d-flex justify-content-center justify-content-lg-end gap-2 mt-2 mt-md-0">
                            <a class="btn btn-primary" href="{{ route('ordens-servico.create') }}"><i class="fa-solid fa-user-plus icon-format"></i> Nova Ordem de Serviço</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2 first-item">
                    <div class="container">
                        @livewire('service-order')
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
@endsection
