<x-layout titulo="historico">
    <main>



        <table class="table table-striped">
            <div class="d-flex" style="justify-content: space-between">
                <h6>Historico:</h6>
            <small>caso o seu atendimento não consta na relação favor contatar o whatsapp: (14) 9 9999-9999</small>
            <a href="{{Route('agenda.data')}}" class="btn btn-primary">+ atendimento</a>
            </div>
            <thead>
                <tr>

                    <th scope="col">data</th>
                    <th scope="col">hora</th>
                    <th scope="col">servico</th>
                    <th scope="col">descricao</th>
                    <th scope="col">edit</th>
                </tr>
            </thead>
            @foreach ($lista as $item)
            <tbody>

                    <tr>
                        <td>{{ $item->data }}</td>
                        <td>{{ $item->hora }}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->descricao }}</td>
                        <td><a href="{{ URL('adm/agendamentos/atendimento/edit/' . $item->id_agenda) }}" class="btn btn-primary">edit</a></td>
                        </td>
                    </tr>

            </tbody>
            @endforeach
        </table>
    </main>
    <div class="card text-center">
        <a href="{{Route('historico.completo')}}">Historico Completo</a>
        <div class="d-flex">
            <div class="bg-primary p-2 col-12" style="border-radius: 10px"></div>
        </div>
    </div>
</x-layout>
