@extends('layouts.app')

@section('title', 'Nova ordem de serviço.')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <form action="#">
                        @csrf
                        <div class="row">
                            <div class="col-12 title-format">
                                <h5 class="mb-0">Nova ordem de serviço</h5>
                            </div>

                            <div class="col-4 my-3">
                                <span class="font-weight-bold">Condomínio</span>
                                <input type="text" class="form-control mt-2" name="condominium">
                            </div>

                            <div class="col-4 my-3">
                                <span class="font-weight-bold">Técnico</span>
                                <input type="text" class="form-control mt-2" name="technical" required>
                            </div>

                            <div class="col-4 my-3">
                                <span class="font-weight-bold">Responsável</span>
                                <input type="text" class="form-control mt-2" name="responsible" disabled required>
                            </div>

                            <div class="col-12 my-3">
                                <span class="font-weight-bold">Descrição do problema</span>
                                <textarea class="form-control mt-3" name="description" id="description" style="resize: none;" cols="30" rows="10"></textarea>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsivity.css') }}">
    <script src="{{ asset('assets/js/resources/new-user.js') }}"></script>
    <script src="{{ asset('assets/js/take/realtime-take.js') }}"></script>
@endsection
