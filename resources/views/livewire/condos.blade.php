<div>
    <input type="search" class="form-control mb-4" wire:model.live.debounce.150ms="searchTerm">

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="ps-2 text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>

                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Localização</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ações</th>
            </tr>
            </thead>
            <tbody>
            @if($condos && $condos->count() > 0)
                @foreach($condos as $condo)
                    <tr>
                        <td class="ps-2 align-middle">
                            <h6 class="text-sm"><a href="{{ route('condominios.show', $condo->id) }}">#{{ $condo->id }}</a></h6>
                        </td>
                        <td class="align-middle">
                            <h6 class="text-sm"><a href="{{ route('condominios.show', $condo->id) }}">{{ $condo->name }}</a></h6>
                        </td>
                        <td class="align-middle">
                            <h6 class="text-sm"><a href="{{ route('condominios.show', $condo->id) }}">{{ $condo->location }}</a></h6>
                        </td>

                        <td class="align-middle">
                            <span class="text-primary cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit-condo{{$condo->id}}" title="Editar dados cadastrais"><i class="fa-solid fa-pen-to-square"></i></span>
                            <span class="text-danger cursor-pointer" title="Deletar condomínio" style="margin-left: 10px !important;"><i class="fa-solid fa-trash"></i></span>
                        </td>
                    </tr>


                    <!-- Modal de edição de condomínio-->
    <div class="modal fade" id="edit-condo{{$condo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Novo condomínio</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('condominios.update', $condo->id) }}" id="condosForm" method="post">
                        @csrf
                        @METHOD('PATCH')
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label class="format-label">Nome</label>
                                <input type="text" class="form-control text-black" name="name" id="edit-c-name" value="{{ $condo->name }}" autocomplete="off">
                            </div>
                            <div class="col-12 col-md-6 mt-3 mt-md-0">
                                <label class="format-label">Localização</label>
                                <input type="text" class="form-control text-black" name="edit-c-city" value="{{ $condo->location }}" id="city" autocomplete="off">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark modal-format"  data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary modal-format" id="editCondo">
                        <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i> Salvar alterações</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
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




