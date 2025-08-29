@extends('layouts.app')

@section('title', 'Retirada de Equipamentos - Gerenciamento completo.')

@section('content')
    <div class="row">
        <div class="col-8 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-12 title-format">
                            <h5 class="mb-0">Dados da retirada:</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2 first-item">
                    <div class="container">
                        <form action="{{ route('retiradas.update', $id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label class="format-label">Condomínio:</label>
                                    <select name="condo" class="form-control">
                                        <option value="">Selecione</option>
                                        @foreach($condos as $condo)
                                            <option value="{{ $condo->name }}">{{ $condo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="format-label">Técnico:</label>
                                    <select name="technical" class="form-control">
                                        <option value="">Selecione</option>
                                        @foreach($technicals as $technical)
                                            <option value="{{ $technical->name }}">{{ $technical->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mt-3">
                                    <label class="format-label">Comentários:</label>
                                    <textarea name="comments" class="form-control txt-area-format" rows="5"></textarea>
                                </div>

                                <div class="col-12 col-md-6 mt-3">
                                    <label class="format-label">Imagem:</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>

                                <div class="col-12 title-format take-format d-flex justify-content-end">
                                    <button class="btn btn-primary my-3 take-btn"><i class="fa-solid fa-clipboard-check"></i> &nbsp;Finalizar retirada</button>
                                </div>
                            </div>
                        </form>
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
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col" class="d-flex">Item</th>
                                <th scope="col">Quantidade</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <th scope="row">{{ $item->item }}</th>
                                    <td>{{ $item->quantity }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="col-12 title-format take-format d-flex justify-content-end">
                            <a href="{{ route('retiradas.create') }}" class="btn btn-dark take-btn"><i class="fa-solid fa-file-pen"></i> &nbsp;Editar itens</a>
                        </div>
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
