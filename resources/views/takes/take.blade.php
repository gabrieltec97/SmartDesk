@extends('layouts.app')

@section('title', 'Retirada de Equipamentos - Gerenciamento completo.')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-12 title-format">
                            <h5 class="mb-0">Equipamentos selecionados:</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2 first-item">
                    <div class="container">

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
