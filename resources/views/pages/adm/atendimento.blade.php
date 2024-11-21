<x-layout titulo="adm">
    <main>


        <form action="{{ Route('adm.agendamento.post') }}" method="post">
            @csrf
            <div class="col-12">
                <input min="{{ $hoje }}" name="data" class="form-control" type="date" id="date" required>


                <label for="hora">Selecione o horário:</label><br>
                <select name="hora" id="hora" class="form-control" required>
                    @foreach ($result_hora as $itemh)
                        <option value="{{ $itemh->id_hora }}">{{ $itemh->hora }}</option> <!-- id_hora como value -->
                    @endforeach
                </select>



                <label for="">Selecioane o tipo de serviço:</label><br>
                <select class="form-control" name="servico" id="">seleciona servico
                    @foreach ($result_servico as $itemse)
                        <option name='servico' class="form-control" value="{{ $itemse->id_servico }}">
                            {{ $itemse->nome }}; R${{ $itemse->preco }}</option>
                    @endforeach
                </select>
                    <label for="">Selecioane o cliente:</label><br>
                <select class="form-control" name="cliente" id="">seleciona cliente
                    @foreach ($result_usuario as $itemus)
                        <option name='servico' class="form-control" value="{{ $itemus->id_usuario }}">
                            {{ $itemus->nome }}; {{ $itemus->telefone }}</option>
                    @endforeach
                </select>
                <label for="">Descrição:</label>
                <input type="text" name="descricao" class="form-control h-50 mb-4">

                <button type="submit" class="btn btn-primary">Enviar</button>

            </div>

</x-layout>
