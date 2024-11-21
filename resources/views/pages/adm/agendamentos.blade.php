<x-layout titulo="adm">
    <main>
        <div>
            <h6>lucro pendente: R${{$lucrop[0]->lucro}}</h6><br>
            <h6>lucro recebido: R${{$lucroc[0]->lucro}}</h6>
        </div>
    <div class="d-flex pb-2" style="justify-content: space-around">

    <a href="{{URL('/adm/servicos')}}" class="btn btn-primary">servicos</a>
            <a href="{{Route('adm.atendimento')}}" class="btn btn-primary">+ atendimento</a>
            </div>
        <form action="{{Route('historico.completo.data')}}" method="post">
            @csrf
            <div class="d-flex" style="justify-content: space-around">

                <label for="" class="h4">inicial:</label>
                <input type="date" class="form-control w-25" name="ini" id="ini">
                <label for="" class="h4">final:</label>
                <input type="date"  class="form-control w-25" name="end" id="end">
                <div onmousemove="escolher()" class="p-2" onmousemove="escolher()">
                <button type="submit" class="btn btn-secondary btn-sm"  disabled id="btn">Pesquisar</button>
            </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>

                    <th scope="col">data</th>
                    <th scope="col">hora</th>
                    <th scope="col">servico</th>
                    <th scope="col">descricao</th>
                    <th scope="col">status</th>
                </tr>
            </thead>
            @foreach ($result_lista as $item)
            <tbody>

                <tr>
                    <td>{{ $item->data }}</td>
                    <td>{{ $item->hora }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->descricao }}</td>
                    <td>{{ $item->status }}</td>
                    <td><a href="{{ URL('adm/agendamentos/atendimento/edit/' . $item->id_agenda) }}" class="btn btn-primary">edit</a></td>



                </tr>

            </tbody>
            @endforeach
        </table>
    </main>
    <div class="card text-center">

        <div class="d-flex">
            <div class="bg-primary p-2 col-12" style="border-radius: 10px"></div>
        </div>
    </div>
    <script>
        function escolher() {

            const ini = document.getElementById('ini').value;
            const end = document.getElementById('end').value;
            const btn = document.getElementById('btn');

            if (ini>end || end == '') {
                alert('a data final deve ser maior do que a data inicial')
                btn.disabled=true

            }
            else{
                btn.disabled=false
            }


        }
    </script>
</x-layout>
