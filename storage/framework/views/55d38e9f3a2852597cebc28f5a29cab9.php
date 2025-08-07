<?php $__env->startSection('title', 'Dashboard - Informações completas sobre entregas cadastradas.'); ?>

<?php $__env->startSection('content'); ?>
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
                                        <?php if($totalReceivedToday == 1): ?>
                                            <?php echo e($totalReceivedToday); ?> Entrega
                                        <?php else: ?>
                                            <?php echo e($totalReceivedToday); ?> Entregas
                                        <?php endif; ?>
                                    </h5>
                                    <span class="text-white text-sm">
                                         <?php if($totalReceivedToday == 1): ?>
                                            Recebida hoje
                                        <?php else: ?>
                                            Recebidas hoje
                                        <?php endif; ?>
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
                                        <i class="fa-regular fa-thumbs-up text-dark dash-icon"></i>
                                    </div>
                                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                        <?php if($totalTakenToday == 1): ?>
                                            <?php echo e($totalTakenToday); ?> Retirada
                                        <?php else: ?>
                                            <?php echo e($totalTakenToday); ?> Retiradas
                                        <?php endif; ?>
                                    </h5>
                                    <span class="text-white text-sm">
                                         <?php if($totalTakenToday == 1): ?>
                                            Realizada hoje
                                        <?php else: ?>
                                            Realizadas hoje
                                        <?php endif; ?>

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
                        <span class="font-weight-bold">Métricas ao longo</span> <?php echo e(date("Y")); ?>

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
                            <h5>Unidades com mais entregas</h5>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidade</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Recebido</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Retirado</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Taxa de retirada</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $count; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?php echo e($unit['unit']); ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">
                                                    <?php if( $unit['total'] == 0 ||  $unit['total'] == 1): ?>
                                                        <?php echo e($unit['total']); ?> entrega
                                                    <?php else: ?>
                                                        <?php echo e($unit['total']); ?> entregas
                                                    <?php endif; ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Retirado -->
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm">
                                            <?php echo e($unit['pickedUp']); ?> <?php echo e($unit['pickedUp'] == 1 ? 'retirada' : 'retiradas'); ?>

                                        </h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="progress-wrapper w-75 mx-auto">
                                            <div class="progress-info">
                                                <div class="progress-percentage">
                                                    <span class="text-xs font-weight-bold"><?php echo e($unit['percent']); ?>%</span>
                                                    <div class="progress-bar bg-gradient-info w-<?php echo e($unit['percent']); ?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <h6 class="text-dark text-sm font-weight-bold mb-0"><?php echo e($total); ?> Entregas recebidas</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    <?php if($resume == 0 || $resume == 1): ?>
                                        <?php echo e($resume); ?> Recebida com observação
                                    <?php else: ?>
                                        <?php echo e($resume); ?> Recebidas com observações
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                    <?php if($totalWithdrawn == 0 || $totalWithdrawn == 1): ?>
                                        <?php echo e($totalWithdrawn); ?> Entrega retirada
                                    <?php else: ?>
                                        <?php echo e($totalWithdrawn); ?> Entregas retiradas
                                    <?php endif; ?>
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    <?php if($totalOthers == 0 || $totalOthers == 1): ?>
                                        <?php echo e($totalOthers); ?> Retirada por terceiros
                                    <?php else: ?>
                                        <?php echo e($totalOthers); ?> Retiradas por terceiros
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                    <?php if($waiting == 0 || $waiting == 1): ?>
                                        <?php echo e($waiting); ?> Entrega aguardando retirada
                                    <?php else: ?>
                                        <?php echo e($waiting); ?> Entregas aguardando retirada
                                    <?php endif; ?>

                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Pelo proprietário ou terceiros</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                    <?php if($cancelled == 1): ?>
                                        <?php echo e($cancelled); ?> entrega cancelada
                                    <?php else: ?>
                                        <?php echo e($cancelled); ?> entregas canceladas
                                    <?php endif; ?>
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Via administrativo</p>
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

    <script>
        var dataTotal = <?php echo json_encode($dataTotal); ?>;
        var dataTaken = <?php echo json_encode($dataTaken); ?>;

        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: [
                    "Janeiro", "Fevereiro", "Março", "Abril", "Maio",
                    "Junho", "Julho", "Agosto", "Setembro", "Outubro",
                    "Novembro", "Dezembro"
                ],
                datasets: [{
                    label: "Entregas recebidas",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#cb0c9f",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: dataTotal,
                    maxBarThickness: 6

                },
                    {
                        label: "Entregas retiradas",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#0f2eda",
                        borderWidth: 3,
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: dataTaken,
                        maxBarThickness: 6
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#b2b9bf',
                            font: {
                                size: 11,
                                family: "Inter",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Inter",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsivity.css')); ?>">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\E-Locker\resources\views/dashboard.blade.php ENDPATH**/ ?>