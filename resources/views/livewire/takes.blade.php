<div>
    <input type="search" class="form-control mb-4" wire:model.live.debounce.150ms="searchTerm">

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="ps-2 text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Condomínio</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Responsável</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Técnico</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Data</th>
            </tr>
            </thead>
            <tbody>
            @if($take && $take->count() > 0)
                @foreach($take as $item)
                    <tr>
                        <td class="ps-2 align-middle">
                            <h6 class="text-sm cursor-pointer">#{{ $item->id }}</h6>
                        </td>
                        <td class="align-middle">
                            <h6 class="text-sm cursor-pointer">{{ $item->status }}</h6>
                        </td>
                        <td class="align-middle">
                            <h6 class="text-sm cursor-pointer">{{ $item->condominium }}</h6>
                        </td>

                        <td class="align-middle">
                            @foreach ($users as $user)
                                @if ($user->id == $item->responsible)
                                    <h6 class="text-sm cursor-pointer">{{ $user->name }} {{ $user->surname}}</h6>
                                @endif
                            @endforeach
                        </td>

                        <td class="align-middle">
                            <h6 class="text-sm cursor-pointer">{{ $item->technical }}</h6>
                        </td>

                        <td class="align-middle">
                            <h6 class="text-sm cursor-pointer">{{ $item->created_at }}</h6>
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
