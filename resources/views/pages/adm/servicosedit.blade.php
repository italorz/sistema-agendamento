<x-layout titulo="servicos">

<main>
@vite(['resources/js/app.js'])
    <div class="container">
        <h1 class="mt-5">Editar servico</h1>
        <form action="{{ route('servicos.update', $servico->id_servico) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="nome" name="nome" required placeholder="Nome" maxlength="11" value="{{ $servico->nome }}">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="number" class="form-control" id="preco" name="preco" required placeholder="preço" minlength="2" value="{{ $servico->preco }}">
                    </div>
                </div>


            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</main>
</x-layout>
