<?php $__env->startSection('title'); ?>
    Entrega <?php echo e($packet->id); ?> - Faça a gestão desta entrega.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-md-6 col-12 title-format">
                                <h5 class="mb-0">Entrega nº<?php echo e($packet->id); ?></h5>
                                <?php if($packet->withdrawn_by == null): ?>
                                    <?php if($packet->status == 'Cancelado'): ?>
                                        <p class="text-sm mb-0">
                                            <span class="font-weight-bold"><span class="text-danger"><?php echo e($packet->status); ?></span></span>
                                        </p>
                                    <?php else: ?>
                                        <p class="text-sm mb-0">
                                            <span class="font-weight-bold">Administre</span> esta entrega
                                        </p>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <p class="text-sm mb-0">
                                        <span class="font-weight-bold text-success">Retirado por <?php echo e($packet->withdrawn_by); ?> em <?php echo e($packet->withdrawn_at); ?></span>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <?php if($packet->status != 'Cancelado'): ?>
                                <?php if($packet->withdrawn_by == null ): ?>
                                    <div class="col-md-6 col-12 d-flex justify-content-center justify-content-lg-end gap-2 mt-2 mt-md-0">
                                        <button class="btn btn-primary" id="register">
                                            <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i> Salvar alterações</span>
                                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row pb-2">
                                <div class="col-12 col-lg-4 first-item">
                                    <span class="font-weight-bold modal-label">Recebedor:</span>
                                    <input type="text" value="<?php echo e($packet->received_by); ?>" class="form-control input-format mt-2 cursor-pointer field-format" disabled>
                                </div>

                                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                                    <span class="font-weight-bold modal-label">Destinatário:</span>
                                    <input type="text" value="<?php echo e($packet->owner); ?>" id="owner" class="form-control input-format mt-2 cursor-pointer field-format" disabled>
                                </div>

                                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                                    <span class="font-weight-bold modal-label">Unidade:</span>
                                    <input type="text" value="<?php echo e($packet->unit); ?>" class="form-control input-format mt-2 cursor-pointer field-format" disabled>
                                </div>

                                <div class="col-12 mt-3">
                                    <span class="font-weight-bold modal-label ">Comentários:</span>
                                    <br>
                                    <?php if($packet->comments == null): ?>
                                        <textarea class="form-control input-format field-format mt-3 comments" cols="10" rows="5" disabled>Sem comentários adicionados</textarea>
                                    <?php else: ?>
                                        <textarea class="form-control input-format field-format mt-3 comments" cols="10" rows="5" disabled><?php echo e($packet->comments); ?></textarea>
                                    <?php endif; ?>
                                </div>
                            </div>
                                <form action="<?php echo e(route('entregas.update', $packet->id)); ?>" method="post" id="upd-packet">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="row mt-3 mb-5">
                                        <div class="col-12 col-lg-4">
                                            <span class="font-weight-bold modal-label ">Status:</span>
                                            <select name="status" id="status" class="form-control input-format field-format mt-2" <?php echo e(($packet->status == 'Retirado por terceiros' || $packet->status == 'Retirado pelo destinatário') ? 'disabled' : ''); ?>>
                                                <option value="Cancelado" <?php echo e($packet->status == 'Cancelado' ? 'selected' : ''); ?>>Cancelado</option>
                                                <option value="Aguardando Retirada" <?php echo e($packet->status == 'Aguardando Retirada' ? 'selected' : ''); ?>>Aguardando Retirada</option>
                                                <option value="Retirado por terceiros" <?php echo e($packet->status == 'Retirado por terceiros' ? 'selected' : ''); ?>>Retirado por terceiros</option>
                                                <option value="Retirado pelo destinatário" <?php echo e($packet->status == 'Retirado pelo destinatário' ? 'selected' : ''); ?>>Retirado pelo destinatário</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                                            <span class="font-weight-bold modal-label">Retirado por:</span>
                                            <input type="text" id="recipient" name="withdrawn" value="<?php echo e($packet->withdrawn_by); ?>" <?php echo e($packet->withdrawn_by != null ? 'disabled' : ''); ?> class="form-control input-format mt-2 field-format">
                                        </div>

                                        <?php if($packet->withdrawn_at != null): ?>
                                            <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                                                <span class="font-weight-bold modal-label">Retirado em:</span>
                                                <input type="text" value="<?php echo e($packet->withdrawn_at); ?>" class="form-control input-format mt-2 field-format" disabled>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($packet->signature == null): ?>
                                            <?php if($packet->status != 'Cancelado'): ?>
                                                <div class="col-12 col-lg-6 mt-4">
                                                    <span class="font-weight-bold modal-label">Assinatura:</span>
                                                    <div class="p-2 mt-2">
                                                        <canvas id="signature-pad" class="border rounded bg-white signature-format sign-format"></canvas>
                                                        <br>
                                                        <button type="button" id="clear-signature" class="btn btn-sm btn-secondary signature-format mt-3">Limpar</button>
                                                    </div>
                                                    <input type="hidden" name="signature" id="signature">
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="col-12 col-lg-6 mt-3 mt-lg-4">
                                                <span class="font-weight-bold modal-label">Assinatura do recebedor:</span>
                                                <br>
                                                <img src="<?php echo e(asset($packet->signature)); ?>" class="image-format mt-3 field-format">
                                            </div>
                                        <?php endif; ?>

                                        <div class="col-12 col-lg-6 mt-3 mt-lg-4">
                                            <span class="font-weight-bold modal-label">Imagem:</span>
                                            <br>
                                            <img src="<?php echo e(asset($packet->image)); ?>" class="image-format mt-3">
                                        </div>
                                    </div>
                                </form>
                        </div>
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
    <script src="<?php echo e(asset('assets/js/signature/my-signature.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\E-Locker\resources\views/Packets/packet.blade.php ENDPATH**/ ?>