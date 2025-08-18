@extends('layouts.app')

@section('title', 'Dashboard - Informações completas sobre entregas cadastradas.')

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card first-item">
                        <span class="mask bg-primary opacity-10 border-radius-lg"></span>
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-8 text-start">
                                    <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                        <i class="fa-solid fa-box-open text-dark dash-icon"></i>
                                    </div>
                                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                        Retiradas
                                    </h5>
                                    <span class="text-white text-sm">
                                        Hoje
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                    <div class="card">
                        <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-8 text-start">
                                    <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                        <i class="fa-solid fa-calendar-week text-dark dash-icon"></i>
                                    </div>
                                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                       Retiradas
                                    </h5>
                                    <span class="text-white text-sm">
                                         este mês
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card z-index-2">
                <div class="card-header pb-0 title-format">
                    <h5>Resumo de entregas</h5>
                    <p class="text-sm dashboard-legend">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">Métricas ao longo</span> {{ date("Y") }}
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-12 title-format">
                            <h5>Condomínios com mais ocorrências</h5>
                            <p class="text-sm mb-0 dashboard-legend">
                                <i class="fa fa-check text-info" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">Recebimento x Retirada</span> no mês atual
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive first-item">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Condomínio</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ocorrências</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Taxa de ocorrência</th>
                            </tr>
                            </thead>
                            <tbody>
                           <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">2</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">
                                                   entrega
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                            
                                    <td class="align-middle text-center">
                                        <div class="progress-wrapper w-75 mx-auto">
                                            <div class="progress-info">
                                                <div class="progress-percentage">
                                                    <span class="text-xs font-weight-bold">10%</span>
                                                    <div class="progress-bar bg-gradient-info w-75" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0 title-format">
                    <h5>Resumo mensal</h5>
                    <p class="text-sm dashboard-legend">
                        <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                        <span class="font-weight-bold">Métricas resumidas</span> do mês atual
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side dashboard-legend">
                        <div class="timeline-block mb-3">
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0"> Equipamentos mais utilizados</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                   Recebida com observação
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4" style="display: none;">
        <div class="col-lg-5 mb-lg-0 mb-4">
            <div class="card z-index-2">
                <div class="card-body p-2">
                    <div class="bg-dark border-radius-md py-3 pe-1 mb-3">
                        <div class="chart">
                            <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                    <h6 class="ms-2 mt-4 mb-0"> Active Users </h6>
                    <p class="text-sm ms-2"> (<span class="font-weight-bolder">+23%</span>) than last week </p>
                    <div class="container border-radius-lg">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/plugins/chartjs.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/responsivity.css') }}">
@endsection
