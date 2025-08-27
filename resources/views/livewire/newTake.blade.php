<div>
    <input type="search" class="form-control mb-4" wire:model.live.debounce.150ms="searchTerm">

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="ps-2 text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>

                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Quantidade</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Número de série</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Imagem</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Adicionar</th>
            </tr>
            </thead>
            <tbody>
            @if($stock && $stock->count() > 0)
                @foreach($stock as $item)
                    <tr>
                        <td class="ps-2 align-middle">
                            <h6 class="text-sm cursor-pointer">#{{ $item->id }}</h6>
                        </td>
                        <td class="align-middle">
                            <h6 class="text-sm cursor-pointer">{{ $item->name }}</h6>
                        </td>
                        <td class="align-middle">
                            @if($item->quantity < 3 && $item->quantity >= 1)
                                <h6 class="text-sm text-warning cursor-pointer"><?= $item->quantity == 1  ?  $item->quantity . ' unidade' :  $item->quantity . ' unidades' ?></h6>
                            @elseif($item->quantity == 0)
                                <h6 class="text-sm text-danger cursor-pointer"><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> &nbsp;Em falta</h6>
                            @else
                                <h6 class="text-sm cursor-pointer"><?= $item->quantity == 1  ?  $item->quantity . ' unidade' :  $item->quantity . ' unidades' ?></h6>
                            @endif
                        </td>

                        <td class="align-middle">
                            <h6 class="text-sm cursor-pointer">{{ $item->serialNumber }}</h6>
                        </td>

                        <td class="align-middle">
                            <img src="{{ asset($item->image) }}" class="img-stock-list-format cursor-pointer">
                        </td>

                        <td class="align-middle">
                            <span class="text-primary cursor-pointer font-weight-bold" data-bs-toggle="modal" data-bs-target="#edit-item{{$item->id}}" title="Adicionar à lista">
                                <i class="fa-solid fa-circle-plus addToTake"></i>
                            </span>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4"><p class="text-danger">Sem registros com este nome</p></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
