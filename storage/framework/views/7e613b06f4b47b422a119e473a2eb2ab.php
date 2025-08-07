<?php
    $blocks = \App\Models\Block::all();
?>

<div>
    <input type="search" class="form-control mb-2 livewire-input-format" wire:model.live.debounce.150ms="searchTerm">

    <table class="table align-items-center mb-0">
        <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidade</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bloco</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ajustes</th>
        </tr>
        </thead>
        <tbody>
        <!--[if BLOCK]><![endif]--><?php if($units && $units->count() > 0): ?>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?php echo e($unit->number); ?></h6>
                            </div>
                        </div>
                    </td>

                    <td>
                        <h6 class="mb-0 text-sm"><?php echo e($unit->block); ?></h6>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <i class="fa-solid fa-user-pen cursor-pointer maintence-icon" data-bs-toggle="modal" data-bs-target="#edit-unit<?php echo e($unit->id); ?>"></i>

                        <!-- Atualizado com data-* -->
                        <i class="fa-solid fa-trash cursor-pointer text-danger delete-button"
                           data-id="<?php echo e($unit->id); ?>"
                           data-number="<?php echo e($unit->number); ?>"
                           data-block="<?php echo e($unit->block); ?>"></i>
                    </td>
                </tr>

                <!-- Formulário oculto de exclusão -->
                <form id="form-delete-<?php echo e($unit->id); ?>" action="<?php echo e(route('unidades.destroy', $unit->id)); ?>" style="display: none;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                </form>

                <!-- Modal de edição -->
                <div class="modal fade" id="edit-unit<?php echo e($unit->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header d-flex">
                                <h5 class="modal-title" id="exampleModalLongTitle">Editar unidade</h5>
                                <i class="fa-solid fa-circle-xmark text-danger ms-auto cursor-pointer" data-bs-dismiss="modal"></i>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="<?php echo e(route('unidades.update', $unit->id )); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="row">
                                            <div class="col-12 col-lg-6 col-md-6">
                                                <span class="font-weight-bold modal-label">Número da unidade:</span>
                                                <input type="number" name="unit" class="form-control input-format mt-2 field-modal-format" value="<?php echo e($unit->number); ?>">
                                            </div>

                                            <div class="col-12 col-lg-6 col-md-6 mt-3 mt-lg-0">
                                                <span class="font-weight-bold modal-label">Número do bloco:</span>
                                                <select name="block" class="form-control input-format field-modal-format mt-2">
                                                    <option selected disabled>Selecione</option>
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($block->number); ?>" <?php echo e($unit->block == $block->number ? 'selected' : ''); ?>>Bloco <?php echo e($block->number); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer format-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary" id="save<?php echo e($unit->id); ?>">
                                    <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i> Salvar alterações</span>
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spinner no botão salvar -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const btnSave = document.getElementById('save<?php echo e($unit->id); ?>');
                        if (btnSave) {
                            btnSave.addEventListener('click', function () {
                                const text = btnSave.querySelector('.button-text');
                                const spinner = btnSave.querySelector('.spinner-border');
                                text.classList.add('d-none');
                                spinner.classList.remove('d-none');
                            });
                        }
                    });
                </script>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
            <tr>
                <td colspan="4"><p class="text-danger">Sem registros com este nome</p></td>
            </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </tbody>
    </table>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsivity.css')); ?>">
</div>

<!-- Script Global para deletar (Após Livewire atualizar a DOM) -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('delete-button')) {
                const unitId = e.target.getAttribute('data-id');
                const unitNumber = e.target.getAttribute('data-number');
                const unitBlock = e.target.getAttribute('data-block');

                Swal.fire({
                    html: `Deseja excluir a unidade <b>${unitNumber} bloco ${unitBlock}</b>?`,
                    icon: "question",
                    showCancelButton: true,
                    cancelButtonText: 'Voltar',
                    confirmButtonText: 'Excluir',
                    confirmButtonColor: '#F97316',
                    focusCancel: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`form-delete-${unitId}`).submit();
                    }
                });
            }
        });
    });
</script>
<?php /**PATH C:\xampp\htdocs\E-Locker\resources\views/livewire/units.blade.php ENDPATH**/ ?>