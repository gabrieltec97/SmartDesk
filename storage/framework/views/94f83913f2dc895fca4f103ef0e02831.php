<?php $__env->startSection('title', 'Blocos e Unidades - Gerenciamento completo de unidades.'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-md-6 col-12 title-format">
                            <h5 class="mb-0">Blocos e Unidades</h5>
                            <p class="text-sm mb-0">
                                <span class="font-weight-bold">Gerenciamento</span> completo
                            </p>
                        </div>

                        <!-- Coluna dos botões -->
                        <div class="col-md-6 col-12 d-flex justify-content-end gap-2 mt-2 mt-md-0">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-unit"><i class="fa-solid fa-circle-plus icon-format"></i> Nova unidade</button>
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#new-block"><i class="fa-solid fa-circle-plus icon-format"></i> Novo bloco</button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('units');

$__html = app('livewire')->mount($__name, $__params, 'lw-982466713-0', $__slots ?? [], get_defined_vars());

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
    </div>

    <!-- Modal de blocos-->
    <div class="modal fade" id="new-block" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar bloco</h5>
                    <i class="fa-solid fa-circle-xmark text-danger ms-auto cursor-pointer" data-bs-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form class="form-group" id="new-block-form" action="<?php echo e(route('blocos.store')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <span class="font-weight-bold modal-label">Número do bloco:</span>
                                    <input type="number" id="block" name="block" class="form-control input-format field-modal-format mt-3 mb-2">
                                    <span class="text-danger input-format font-weight-bold d-none" id="block-info"><i class="fa-solid fa-circle-info"></i> Digite o número do novo bloco</span>
                                    <span class="text-danger input-format font-weight-bold d-none" id="block-text"><i class="fa-solid fa-circle-info"></i> O preencha o bloco apenas com números.</span>
                                </form>
                            </div>

                            <div class="col-12">
                                <span class="font-weight-bold modal-label">Blocos cadastrados:</span>
                                <div class="row mt-3">
                                   <?php $__currentLoopData = $blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-2">
                                            <span class="<?= $key == 0 ? 'first-format' : 'block-format'; ?> font-weight-bold"><?php echo e($value->number); ?></span>
                                            <i class="fa-solid fa-trash cursor-pointer text-danger" data-bs-dismiss="modal" id="delete-block<?php echo e($value->id); ?>"></i>
                                        </div>

                                        <form action="<?php echo e(route('blocos.destroy', $value->id)); ?>" id="block-delete<?php echo e($value->id); ?>" method="post" hidden><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?></form>
                                        <script>
                                           document.getElementById('delete-block<?php echo e($value->id); ?>').addEventListener('click', function (){
                                               Swal.fire({
                                                   html: `Tem certeza que deseja excluir o bloco <?php echo e($value->number); ?></b>?`,
                                                   icon: "question",
                                                   showCancelButton: true,
                                                   cancelButtonText: 'Voltar',
                                                   confirmButtonText: 'Excluir',
                                                   confirmButtonColor: '#F97316',
                                                   focusCancel: true
                                               }).then((result) => {
                                                   if (result.isConfirmed) {
                                                       document.getElementById(`block-delete<?php echo e($value->id); ?>`).submit();
                                                   }
                                               });
                                           });
                                        </script>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer format-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="registerBlock">
                        <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i> Cadastrar</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de unidades-->
    <div class="modal fade" id="new-unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar unidade</h5>
                    <i class="fa-solid fa-circle-xmark text-danger ms-auto cursor-pointer" data-bs-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="new-unit-form" action="<?php echo e(route('unidades.store')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-12 col-lg-6 col-md-6">
                                    <span class="font-weight-bold modal-label">Número da unidade:</span>
                                    <input type="number" name="unit" class="form-control input-format field-modal-format mt-3 mb-2" id="unit-number">
                                    <span class="text-danger input-format font-weight-bold d-none" id="unit-number-info"><i class="fa-solid fa-circle-info"></i> Selecione a unidade</span>
                                </div>

                                <div class="col-12 col-lg-6 col-md-6">
                                    <span class="font-weight-bold modal-label">Número do bloco:</span>
                                    <select name="block" class="form-control input-format field-modal-format mt-3 mb-2" id="unit">
                                        <option value="selecione" selected disabled>Selecione</option>
                                        <?php $__currentLoopData = $blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($block->number); ?>">Bloco <?php echo e($block->number); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="text-danger input-format font-weight-bold d-none" id="block-info"><i class="fa-solid fa-circle-info"></i> Selecione o bloco</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer format-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="registerUnit">
                        <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i> Cadastrar</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
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

    <?php if($errors->any()): ?>
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .error({
                    message: '<?php echo e($errors->first()); ?>',
                    dismissible: true,
                    duration: 5000
                })
        </script>
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsivity.css')); ?>">
    <script src="<?php echo e(asset('assets/js/resources/new-unit.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\E-Locker\resources\views/Units/unidades.blade.php ENDPATH**/ ?>