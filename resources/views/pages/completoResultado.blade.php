<x-layout titulo="historico">
    <main>


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
            @foreach ($lista as $item)
            <tbody>

                <tr>
                    <td>{{ $item->data }}</td>
                    <td>{{ $item->hora }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->descricao }}</td>
                    <td>{{ $item->status }}</td>
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
