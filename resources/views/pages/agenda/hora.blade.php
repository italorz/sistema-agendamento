<x-layout titulo="agenda-data">
    <main>
        <form action="{{ Route('agenda.horaservico') }}" method="post">
            @csrf
            <div class="d-flex mb-4" style="justify-content: space-between; justify-content: center;">
                <div class="row">
                    <div class="col-12">
                        <label for="" >Selecioane o horario:</label><br>
                        <select name="hora" id="" class="form-control">seleciona o horario
                            @foreach ($result as $item)
                                <option name='hora' value="{{$item->id_hora}}">{{$item->hora}}</option>
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
            <div class="bg-primary p-2 col-6"></div>
        </div>
    </div>
</x-layout>
