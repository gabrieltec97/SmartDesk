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
                <tr data-item-name="{{ $item->name }}" data-stock-quantity="{{ $item->quantity }}">
                    <td>#{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
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

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const takeItems = {};
            const notyf = new Notyf({ position: { x: 'right', y: 'top' } });

            document.querySelectorAll('.takeAction').forEach(button => {

                button.addEventListener('click', async function () {

                    const row = this.closest('tr');
                    const itemName = this.dataset.itemName;
                    const stockQuantity = parseInt(row.dataset.stockQuantity);
                    const action = this.dataset.action;

                    if (!takeItems[itemName]) takeItems[itemName] = 0;

                    // valida limites
                    if (action === 'add' && takeItems[itemName] >= stockQuantity) {
                        notyf.error('Quantidade máxima em estoque atingida!');
                        return;
                    }
                    if (action === 'remove' && takeItems[itemName] <= 0) {
                        return;
                    }

                    try {
                        const response = await fetch('{{ route('take-add') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ action, item: itemName })
                        });

                        if (!response.ok) throw new Error('Erro na requisição');

                        const data = await response.json();

                        // atualiza quantidade local
                        if (action === 'add') takeItems[itemName]++;
                        if (action === 'remove') takeItems[itemName]--;

                        // Notificação
                        notyf.success(data.message);

                        // Dispara evento Livewire
                        Livewire.dispatch('itemAdded');

                    } catch (error) {
                        console.error(error);
                        notyf.error('Erro ao executar ação: ' + error.message);
                    }
                });
            });
        });
    </script>
</div>
