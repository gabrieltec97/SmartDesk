<link rel="stylesheet" href="<?php echo e(asset('assets/css/main.css')); ?>">

<?php $__env->startSection('title', 'Histórico de entregas - Gerenciamento completo de registros.'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-md-6 col-12 text-center text-lg-start fine-tunning">
                            <h5 class="mb-0">Histórico de entregas</h5>
                            <p class="text-sm mb-0">
                                <span class="font-weight-bold">Gestão completa</span> de entregas
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('packets');

$__html = app('livewire')->mount($__name, $__params, 'lw-1931411176-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>
        </div>
    </div>

    <?php if(session('msg-success')): ?>
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .success({
                    message: '<?php echo e(session('msg-success')); ?>',
                    dismissible: true,
                    duration: 5000
                });
        </script>
    <?php endif; ?>

    <?php if(session('msg-error')): ?>
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .error({
                    message: '<?php echo e(session('msg-error')); ?>',
                    dismissible: true,
                    duration: 5000
                })
        </script>
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsivity.css')); ?>">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\E-Locker\resources\views/Packets/historic.blade.php ENDPATH**/ ?>