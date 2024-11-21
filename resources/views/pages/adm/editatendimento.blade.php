<x-layout titulo="adm">
    <main>

        <form action="{{ route('adm.agendamento.update', $find[0]->id_agenda) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="col-12">
                @foreach ($find as $atend)

                    <input value="{{$atend->data}}" name="data" class="form-control" type="date" id="date" required>

                    <label for="hora">Selecione o horário:</label><br>
                    <select name="hora" id="hora" class="form-control" required>
                        <option value="{{ $atend->id_hora }}">{{ $atend->hora }}</option>
                        @foreach ($result_hora as $itemh)
                            <option value="{{ $itemh->id_hora }}">{{ $itemh->hora }}</option>
                        @endforeach
                    </select>

                    <label for="servico">Selecione o tipo de serviço:</label><br>
                    <select class="form-control" name="servico" id="servico" required>
                        <option value="{{ $atend->id_servico }}">{{ $atend->nome }}</option>
                        @foreach ($result_servico as $itemse)
                            <option value="{{ $itemse->id_servico }}">{{ $itemse->nome }}; R${{ $itemse->preco }}</option>
                        @endforeach
                    </select>

                    <label for="descricao">Descrição:</label>
                    <input type="text" name="descricao" value="{{$atend->descricao}}" class="form-control h-50 mb-4" required>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                @endforeach
            </div>
        </form>
    </main>
</x-layout>
