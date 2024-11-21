<x-layout titulo="agenda-data">
    <main>
        <form action="{{ Route('agenda.servicoconcluido') }}" method="post">
            @csrf
            <div class="d-flex mb-4" style="justify-content: space-between; justify-content: center;">
                <div class="row">
                    <div class="col-12">

                        <label for="" >Selecioane o tipo de serviço:</label><br>
                        <select class="form-control" name="servico" id="">seleciona servico
                            @foreach ($result as $item)
                                <option name='servico' class="form-control" value="{{$item->id_servico}}">{{$item->nome}}; R${{$item->preco}}</option>
                            @endforeach
                        </select>
                        <label for="">Descrição:</label>
                        <input type="text" name="descricao" class="form-control h-50 mb-4">


                    </div>
                </div>
                <div>
                    <div class="m-4"><br>
                        <button class="btn btn-primary mt-2">>></button>
                    </div>
                </div>
            </div>
        </form>

    </main>
    <div class="card">

        <div class="d-flex">
            <div class="bg-primary p-2 col-10"></div>
        </div>
    </div>
</x-layout>
