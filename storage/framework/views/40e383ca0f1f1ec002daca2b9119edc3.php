<?php $__env->startSection('title', 'Novo Registro - Cadastre uma nova entrega.'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <!-- Coluna do título -->
                        <div class="col-md-6 col-12 title-format">
                            <h5 class="mb-0">Nova entrega</h5>
                            <p class="text-sm mb-0">
                                <span class="font-weight-bold">Registre</span> uma nova entrega
                            </p>
                        </div>

                        <div class="col-md-6 col-12 d-flex justify-content-center justify-content-lg-end gap-2 mt-2 mt-md-0">
                            <button class="btn btn-primary" id="register">
                                <span class="button-text"><i class="fa-solid fa-circle-plus icon-format"></i> Registrar entrega</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <div class="container-fluid">
                        <form action="<?php echo e(route('entregas.store')); ?>" method="post" id="new-packet">
                            <?php echo csrf_field(); ?>
                            <div class="row pb-2">
                                <div class="col-12 col-md-4 first-item">
                                    <span class="font-weight-bold modal-label">Recebedor:</span>
                                    <input type="text" name="receiver" value="<?php echo e($user); ?>" class="form-control input-format field-format mt-2" id="receiver">
                                </div>

                                <div class="col-12 col-md-4 mt-3 mt-lg-0">
                                    <span class="font-weight-bold modal-label">Destinatário:</span>
                                    <input type="text" name="recipient" value="<?php echo e(old('recipient')); ?>" class="form-control input-format field-format mt-2" id="recipient">
                                </div>

                                <div class="col-12 col-md-4 mt-3 mt-lg-0">
                                    <span class="font-weight-bold modal-label">Unidade:</span>
                                    <select name="unit" class="form-control input-format field-format mt-1" id="unit">
                                        <option value="selecione" selected disabled>Selecione</option>
                                        <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($unit->number); ?> - BL 0<?php echo e($unit->block); ?>" <?php echo e(old('categoria') == "$unit->number - BL 0 $unit->block" ? 'selected' : ''); ?>><?php echo e($unit->number); ?> - BL 0<?php echo e($unit->block); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="col-12 mt-3">
                                    <span class="font-weight-bold modal-label">Comentários:</span>
                                    <textarea name="comments" value="<?php echo e(old('comments')); ?>" class="form-control mt-2 format-textarea field-format modal-label" rows="5"></textarea>
                                </div>

                                <div class="col-12 col-md-6 mt-3">
                                    <span class="font-weight-bold modal-label">Imagem:</span>
                                    <div id="camera-container" class="mt-2">
                                        <video id="webcam" autoplay playsinline class="input-format field-format w-full max-w-md border rounded"></video>
                                    </div>

                                    <input type="hidden" name="photo" id="photo">

                                    <!-- Pré-visualização -->
                                    <div id="preview-container" class="mt-3 hidden input-format">
                                        <img id="preview" class="max-w-md border rounded preview-format" />
                                    </div>

                                    <div class="input-format mt-3">
                                        <button type="button" id="start-camera" class="btn btn-sm btn-primary">Ativar Câmera</button>
                                        <button type="button" id="capture" class="btn btn-sm btn-success hidden">Capturar</button>
                                        <button type="button" id="retake" class="btn btn-sm btn-warning hidden">Refazer</button>
                                    </div>
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
    <script src="<?php echo e(asset('assets/js/camera/webcam.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/resources/new-packet.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\E-Locker\resources\views/Packets/new-packet.blade.php ENDPATH**/ ?>