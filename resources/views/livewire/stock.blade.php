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
                            <span class="text-primary cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit-item{{$item->id}}" title="Editar dados cadastrais"><i class="fa-solid fa-pen-to-square"></i></span>
                            <span class="text-danger cursor-pointer" id="delete{{ $item->id }}" title="Deletar item" style="margin-left: 10px !important;"><i class="fa-solid fa-trash"></i></span>
                        </td>
                    </tr>

                    <form id="form-delete-{{ $item->id }}" action="{{ route('estoque.destroy', $item->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <script>
                        const btnAlert{{ $item->id }} = document.querySelector('#delete{{ $item->id }}');
                        btnAlert{{ $item->id }}.addEventListener('click', function () {
                            Swal.fire({
                                html: `Deseja excluir o item <b>{{ $item->name }}</b>?`,
                                icon: "question",
                                showCancelButton: true,
                                cancelButtonText: 'Voltar',
                                confirmButtonText: 'Excluir',
                                confirmButtonColor: '#F97316',
                                focusCancel: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('form-delete-{{ $item->id }}').submit();
                                }
                            });
                        });
                    </script>

                    <!-- Modal de edição de item-->
                    <div class="modal fade" id="edit-item{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Editar item</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('estoque.update', $item->id) }}" id="edit-itemForm{{$item->id}}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        @METHOD('PUT')
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-center mb-4">
                                                <img src="{{ asset($item->image) }}" class="imgEdit-format">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="format-label">Nome</label>
                                                <input type="text" class="form-control text-black" name="name" id="edit-name" value="{{ $item->name }}" autocomplete="off">
                                            </div>
                                            <div class="col-12 col-md-6 mt-3 mt-md-0">
                                                <label class="format-label">Quantidade</label>
                                                <input type="number" class="form-control text-black" name="quantity" id="edit-quantity" value="{{ $item->quantity }}" autocomplete="off">
                                            </div>

                                            <div class="col-12 col-md-6 mt-3">
                                                <label class="format-label">Nº de série</label>
                                                <input type="text" class="form-control text-black" name="serialNumber" value="<?= $item->serialNumber != 'Não se aplica' ? $item->serialNumber : '' ?>" autocomplete="off">
                                            </div>

                                            <div class="col-12 col-md-6 mt-3">
                                                <label class="format-label">Imagem</label>
                                                <input type="file" class="form-control" name="image" accept="image/*">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark modal-format"  data-bs-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn btn-primary modal-format" id="editItem{{$item->id}}">
                                        <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i> Salvar alterações</span>
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('editItem{{$item->id}}').addEventListener('click', function () {
                            const button = this;
                            const text = button.querySelector('.button-text');
                            const spinner = button.querySelector('.spinner-border');
                            const form = document.getElementById('edit-itemForm{{$item->id}}');

                            const name = document.getElementById('edit-name').value;
                            const quantity = document.getElementById('edit-quantity').value;

                            if (name == ''){
                                message = 'Preencha corretamente o nome do item';
                                playNotif(message);
                            }else if(quantity == ''){
                                message = 'Insira a quantidade deste item em estoque';
                                playNotif(message);
                            }else{
                                text.classList.add('d-none');
                                spinner.classList.remove('d-none');
                                form.submit();
                            }
                        });
                    </script>
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
