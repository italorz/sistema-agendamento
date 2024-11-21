<x-layout titulo="servicos">

<main>
@vite(['resources/js/app.js'])
    <div class="container">


        <div class="mx-auto mt-4" style="width: 400px;">
            <h2 class="mt-5">Cadastrar servico</h2>
            <form class="p-2 card shadow-sm" action="{{ route('servicos.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="preco" name="nome" required placeholder="Nome" maxlength="11">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="preco" name="preco" required placeholder="Preço" minlength="2">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
        <h2 class="mt-5">Lista de servicos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>preco</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($servicos as $servico)
                <tr>
                    <td>{{ $servico->id_servico }}</td>
                    <td>{{ $servico->nome }}</td>
                    <td>{{ $servico->preco }}</td>

                    <td>
                        <a href="{{ route('servicos.edit', $servico->id_servico) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('servicos.destroy', $servico->id_servico) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</main>

</x-layout>
