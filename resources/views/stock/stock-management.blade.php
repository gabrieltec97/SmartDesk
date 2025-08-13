@extends('layouts.app')

@section('title', 'Estoque de Equipamentos - Gerenciamento completo.')

@section('content')
    <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">

                            <!-- Coluna do título -->
                            <div class="col-md-6 col-12 title-format">
                                <h5 class="mb-0">Estoque</h5>
                                <p class="text-sm mb-0">
                                    <span class="font-weight-bold">Gerenciamento</span> completo
                                </p>
                            </div>

                            <!-- Coluna dos botões -->
                            <div class="col-md-6 col-12 d-flex justify-content-center justify-content-lg-end gap-2 mt-2 mt-md-0">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-item"><i class="fa-solid fa-user-plus icon-format"></i> Novo item</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 first-item">
                        <div class="container">
                            @livewire('stock')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal de novo item-->
    <div class="modal fade" id="new-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Novo item</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('estoque.store') }}" id="new-itemForm" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label class="format-label">Nome</label>
                                <input type="text" class="form-control text-black" name="name" id="name" autocomplete="off">
                            </div>
                            <div class="col-12 col-md-6 mt-3 mt-md-0">
                                <label class="format-label">Quantidade</label>
                                <input type="number" class="form-control text-black" name="quantity" id="quantity" autocomplete="off">
                            </div>

                            <div class="col-12 col-md-6 mt-3">
                                <label class="format-label">Nº de série</label>
                                <input type="text" class="form-control text-black" name="serialNumber" autocomplete="off">
                            </div>

                            <div class="col-12 col-md-6 mt-3">
                                <label class="format-label">Imagem</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark modal-format"  data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary modal-format" id="newItem">
                        <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i> Cadastrar item</span>
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
    <script src="{{ asset('assets/js/resources/new-item.js') }}"></script>
@endsection
