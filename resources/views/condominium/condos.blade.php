@extends('layouts.app')

@section('title', 'Condomínios Clientes - Gerenciamento completo.')

@section('content')
    <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">

                            <!-- Coluna do título -->
                            <div class="col-md-6 col-12 title-format">
                                <h5 class="mb-0">Condomínios</h5>
                                <p class="text-sm mb-0">
                                    <span class="font-weight-bold">Gerenciamento</span> completo
                                </p>
                            </div>

                            <!-- Coluna dos botões -->
                            <div class="col-md-6 col-12 d-flex justify-content-center justify-content-lg-end gap-2 mt-2 mt-md-0">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-condo"><i class="fa-solid fa-user-plus icon-format"></i> Novo condomínio</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 first-item">
                       <div class="container">
                           @livewire('condos')
                       </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal de novo condomínio-->
    <div class="modal fade" id="new-condo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Novo condomínio</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('condominios.store') }}" id="condosForm" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label class="format-label">Nome</label>
                                <input type="text" class="form-control text-black" name="name" id="name" autocomplete="off">
                            </div>
                            <div class="col-12 col-md-6 mt-3 mt-md-0">
                                <label class="format-label">Localização</label>
                                <input type="text" class="form-control text-black" name="city" id="city" autocomplete="off">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark modal-format"  data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary modal-format" id="newCondo">
                        <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i> Cadastrar condomínio</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
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
    <script src="{{ asset('assets/js/resources/new-condo.js') }}"></script>
@endsection
