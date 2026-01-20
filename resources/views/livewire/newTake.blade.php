<div>
    <input type="search"
           class="form-control mb-4"
           wire:model.live.debounce.150ms="searchTerm"
           placeholder="Buscar item...">

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Número de série</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($stock as $item)
                <tr data-item-name="{{ $item->name }}">
                    <td>#{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="item-quantity">{{ $item->quantity }}</td>
                    <td>{{ $item->serialNumber }}</td>
                    <td>
                        <img src="{{ asset($item->image) }}" class="img-stock-list-format">
                    </td>
                    <td>
                        <!-- BOTÃO ADICIONAR -->
                        <span class="takeAction text-primary cursor-pointer"
                              data-action="add"
                              data-item-name="{{ $item->name }}"
                              title="Adicionar">
                            <i class="fa-solid fa-circle-plus fa-lg"></i>
                        </span>

                        <!-- BOTÃO REMOVER -->
                        <span class="takeAction text-danger cursor-pointer ms-2"
                              data-action="remove"
                              data-item-name="{{ $item->name }}"
                              title="Remover">
                            <i class="fa-solid fa-circle-minus fa-lg"></i>
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Seleciona todos os botões
            document.querySelectorAll('.takeAction').forEach(button => {

                button.addEventListener('click', async function () {

                    const row = this.closest('tr');
                    const quantityCell = row.querySelector('.item-quantity');

                    const payload = {
                        action: this.dataset.action, // add | remove
                        item: this.dataset.itemName
                    };

                    try {
                        const response = await fetch('{{ route('take-add') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(payload)
                        });

                        if (!response.ok) throw new Error('Erro na requisição');

                        const data = await response.json();

                        // Atualiza quantidade visualmente
                        let currentQty = parseInt(quantityCell.textContent);
                        if (payload.action === 'add') {
                            quantityCell.textContent = currentQty + 1;
                        } else {
                            quantityCell.textContent = Math.max(currentQty - 1, 0);
                        }

                        // Atualiza Livewire
                        Livewire.dispatch('itemAdded');

                        // Notificação
                        new Notyf({ position: { x: 'right', y: 'top' } }).success(data.message);

                    } catch (error) {
                        console.error(error);
                        alert('Erro ao executar ação: ' + error.message);
                    }

                });

            });

        });
    </script>
</div>
