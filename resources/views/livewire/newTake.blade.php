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
                            <span class="text-primary cursor-pointer font-weight-bold addToTake"
                                  data-item-id="{{ $item->id }}"
                                  data-item-quantity="{{ $item->quantity }}"
                                  data-item-name="{{ $item->name }}"
                                  title="Adicionar à lista">
                                <i class="fa-solid fa-circle-plus"></i>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addToTakeButtons = document.querySelectorAll('.addToTake');

            addToTakeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Obtém os dados do HTML
                    const itemId = this.getAttribute('data-item-id');
                    const itemQuantity = this.getAttribute('data-item-quantity');
                    const itemName = this.getAttribute('data-item-name'); // <--- Captura o nome aqui

                    const data = {
                        take_id: 1, // Exemplo de ID da retirada
                        item: itemName, // <--- Envia o nome em vez do ID
                        quantity: itemQuantity,
                        condominium: 'Condomínio Exemplo',
                    };

                    fetch('{{ route('take-add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(data)
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Falha ao adicionar o item. Status: ' + response.status);
                            }
                            return response.json();
                        })
                        .then(data => {
                            const notyf = new Notyf({
                                position: {
                                    x: 'right',
                                    y: 'top',
                                }
                            });

                            notyf
                                .success({
                                    message: data.message,
                                    dismissible: true,
                                    duration: 5000
                                });
                        })
                        .catch(error => {
                            console.error('Erro:', error.message);
                            alert('Erro ao adicionar o item: ' + error.message);
                        });
                });
            });
        });
    </script>
</div>
