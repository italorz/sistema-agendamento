<x-layout titulo="agenda-data">
    <main>
        <form action="{{ Route('agenda.servicoconcluido') }}" method="post">
            @csrf
            <div class="d-flex mb-4" style="justify-content: space-between; justify-content: center;">
                <div class="row">
                    <div class="col-12">

                        <label for="" >Selecioane o Cliente:</label><br>
                        <select class="form-control" name="cliente" id="">seleciona servico
                            @foreach ($result as $item)
                                <option name="cliente" class="form-control" value="{{$item->id_usuario}}">{{$item->nome}}; R${{$item->telefone}}</option>
                            @endforeach
                        </select>


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
