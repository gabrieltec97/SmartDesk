<div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Item</th>
                <th>Quantidade</th>
            </tr>
            </thead>
            <tbody>
            @forelse($takeItems as $item)
                <tr>
                    <td>{{ $item->item }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-danger">Nenhum equipamento adicionado</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
