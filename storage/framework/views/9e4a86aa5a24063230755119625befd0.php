<div>
    <input type="search" class="form-control mb-2" wire:model.live.debounce.150ms="searchTerm">

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="ps-2 text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidade</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Destinatário</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recebimento</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recebido por</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
            </tr>
            </thead>
            <tbody>
            <!--[if BLOCK]><![endif]--><?php if($packets && $packets->count() > 0): ?>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $packets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $packet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="ps-2 align-middle">
                            <h6 class="text-sm"><a href="<?php echo e(route('entregas.show', $packet->id)); ?>">#<?php echo e($packet->id); ?></a></h6>
                        </td>
                        <td class="align-middle">
                            <h6 class="text-sm"><a href="<?php echo e(route('entregas.show', $packet->id)); ?>"><?php echo e($packet->unit); ?></a></h6>
                        </td>
                        <td class="align-middle">
                            <h6 class="text-sm"><a href="<?php echo e(route('entregas.show', $packet->id)); ?>"><?php echo e($packet->owner); ?></a></h6>
                        </td>
                        <td class="text-center align-middle">
                            <h6 class="text-sm"><a href="<?php echo e(route('entregas.show', $packet->id)); ?>"><?php echo e($packet->received_at); ?></a></h6>
                        </td>
                        <td class="text-center align-middle">
                            <h6 class="text-sm"><a href="<?php echo e(route('entregas.show', $packet->id)); ?>"><?php echo e($packet->received_by); ?></a></h6>
                        </td>
                        <td class="text-center align-middle">
                            <h6 class="text-sm
                        <?php if($packet->status == 'Aguardando Retirada'): ?>
                            text-primary
                        <?php elseif($packet->status == 'Cancelado'): ?>
                            text-danger
                        <?php else: ?>
                            text-success
                        <?php endif; ?>
                        ">
                                <?php echo e($packet->status); ?>

                            </h6>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            <?php else: ?>
                <tr>
                    <td class="text-danger">Sem registros com este nome</td>
                </tr>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>
</div>


<?php /**PATH C:\xampp\htdocs\E-Locker\resources\views/livewire/packets.blade.php ENDPATH**/ ?>