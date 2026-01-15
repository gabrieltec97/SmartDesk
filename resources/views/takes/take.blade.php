@extends('layouts.app')

@section('title', 'Retirada de Equipamentos - Gerenciamento completo.')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-12 title-format">
                            <h5 class="mb-0">Retirada {{ $take->id }}:</h5>
                        </div>

                        <div class="col-3 mt-3">
                            <span class="font-weight-bold">Condomínio</span>
                            <input type="text" class="form-control mt-2" value="{{ $take->condominium }}" disabled>
                        </div>

                        <div class="col-3 mt-3">
                            <span class="font-weight-bold">Técnico</span>
                            <input type="text" class="form-control mt-2" value="{{ $take->technical }}" disabled>
                        </div>

                        <div class="col-3 mt-3">
                            <span class="font-weight-bold">Responsável</span>
                            <input type="text" class="form-control mt-2" value="{{ $take->responsible_name }}" disabled>
                        </div>

                        <div class="col-3 mt-3">
                            <span class="font-weight-bold">Data</span>
                            <input type="text" class="form-control mt-2" value="{{ $take->date }}" disabled>
                        </div>

                        <div class="col-12 mt-4">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="ps-2 text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Quantidade</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td class="align-middle">
                                                <h6 class="text-sm cursor-pointer">{{ $item->item }}</h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6 class="text-sm cursor-pointer">{{ $item->quantity }} <?= $item->quantity > 1 ? 'unidades' : 'unidade' ?></h6>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsivity.css') }}">
    <script src="{{ asset('assets/js/resources/new-user.js') }}"></script>
    <script src="{{ asset('assets/js/take/realtime-take.js') }}"></script>
@endsection
