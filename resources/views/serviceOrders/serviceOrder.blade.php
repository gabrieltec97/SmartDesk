@extends('layouts.app')

@section('title', 'Nova ordem de serviço.')

@section('content')
    <div class="row">
        <div class="col-8 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-12 title-format">
                            <h5 class="mb-0">Ordem de serviço Nº {{ $os->id }}</h5>
                        </div>

                        <div class="col-4 my-3">
                            <span class="font-weight-bold">Condomínio</span>
                            <input type="text" class="form-control" value="{{ $os->condominium }}" disabled>
                        </div>

                        <div class="col-4 my-3">
                            <span class="font-weight-bold">Técnico</span>
                            <input type="text" class="form-control" value="{{ $os->technical }}" disabled>
                        </div>

                        <div class="col-4 my-3">
                            <span class="font-weight-bold">Responsável</span>
                            <input type="text" class="form-control" value="{{ $os->responsible }}" disabled>
                        </div>

                        <div class="col-12 my-3">
                            <span class="font-weight-bold">Descrição do problema</span>
                            <textarea class="form-control mt-3" style="resize: none;" cols="30" rows="10" disabled>{{ $os->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-12 title-format">
                            <h5 class="mb-0">Material usado</h5>
                        </div>

                    <div class="col-12 mt-3">
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
