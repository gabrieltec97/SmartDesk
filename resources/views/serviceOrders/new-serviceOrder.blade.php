@extends('layouts.app')

@section('title', 'Nova ordem de serviço.')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <form action="{{ route('ordens-servico.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 title-format">
                                <h5 class="mb-0">Nova ordem de serviço</h5>
                            </div>

                            <div class="col-4 my-3">
                                <span class="font-weight-bold">Condomínio</span>
                                <select name="condos" style="cursor: pointer;" class="form-control mt-2">
                                    <option selected disabled>Selecione</option>
                                     @foreach($condos as $condo)
                                        <option value="{{ $condo->name }}" class="form-control">{{ $condo->name }}</option>
                                     @endforeach
                                </select>
                            </div>

                            <div class="col-4 my-3">
                                <span class="font-weight-bold">Técnico</span>
                                <select name="technical" style="cursor: pointer;" class="form-control mt-2">
                                    <option selected disabled>Selecione</option>
                                    @foreach($techs as $tech)
                                        <option value="{{ $tech->name }}" class="form-control">{{ $tech->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4 my-3">
                                <span class="font-weight-bold">Responsável</span>
                                <input type="text" class="form-control mt-2" style="cursor: not-allowed;" value="{{ $user->name. ' ' . $user->surname }}" disabled required>
                            </div>

                            <div class="col-12 my-3">
                                <span class="font-weight-bold">Descrição do problema</span>
                                <textarea class="form-control mt-3" name="description" id="description" style="resize: none;" cols="30" rows="10" required></textarea>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Registrar &nbsp; <i class="fa-solid fa-circle-check"></i></button>
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
