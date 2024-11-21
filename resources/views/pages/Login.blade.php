<x-layout titulo="Login">

    @isset($mensagemok)
        <div class="card p-4" style="background-color: #8fd994">
            <div style="color: green">
                {{ $mensagemok }}
            </div>
        </div>
    @endisset

    <main>
        <!-- <div class="card bg-dark">
        <small class="text-white">para teste numero: (99) 9 9999-9999 senha: Qwertyui123@ nao adm <br>
                para teste adm (77) 7 7777-7777 senha: 'mesma senha'</small>
                </div> -->
        <form action="{{ Route('aut.usuario.post') }}" method="post">

            @csrf
            <div class="form-group mx-sm-3 mb-2">
                <label for="telefone">Telefone:</label><br>
                <input type="text" name="telefone" id="telefone" placeholder="Numero de telefone"
                    class="form-control mb-2" required><br>
                <label for="nome">senha:</label><br>
                <input type="password" name="senha" placeholder="senha"class="form-control mb-2" id="senha"
                    required><br>
                <button type="submit" class="btn btn-primary">Login</button>
        </form>
               <a class="text-white text-decoration-none btn btn-secondary"
                        href="{{ Route('criar.usuario.post') }}">Cadastrar</a>


        @isset($loginfalhou)
        <div class="card p-4 mt-2" style="background-color: #d98f8f">
            <div style="color:#803b3b">
                {{ $loginfalhou }}
            </div>
        </div>
    @endisset

    </main>

</x-layout>
