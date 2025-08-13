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
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ações</th>
            </tr>
            </thead>
            <tbody>
            @if($stock && $stock->count() > 0)
                @foreach($stock as $item)
                    <tr>
                        <td class="ps-2 align-middle">
                            <h6 class="text-sm"><a href="{{ route('condominios.show', $item->id) }}">#{{ $item->id }}</a></h6>
                        </td>
                        <td class="align-middle">
                            <h6 class="text-sm"><a href="{{ route('condominios.show', $item->id) }}">{{ $item->name }}</a></h6>
                        </td>
                        <td class="align-middle">
                            <h6 class="text-sm"><a href="{{ route('condominios.show', $item->id) }}">{{ $item->quantity }}</a></h6>
                        </td>

                        <td class="align-middle">
                            <h6 class="text-sm"><a href="{{ route('condominios.show', $item->id) }}">{{ $item->serialNumber }}</a></h6>
                        </td>

                        <td class="align-middle">
                            <img src="{{ asset($item->image) }}" class="img-stock-list-format">
                        </td>

                        <td class="align-middle">
                            <span class="text-primary cursor-pointer" title="Editar dados cadastrais"><i class="fa-solid fa-pen-to-square"></i></span>
                            <span class="text-danger cursor-pointer" title="Deletar condomínio" style="margin-left: 10px !important;"><i class="fa-solid fa-trash"></i></span>
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
