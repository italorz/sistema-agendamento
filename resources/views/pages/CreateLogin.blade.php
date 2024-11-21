<x-layout titulo="Cadastro">
    @isset($mensagemerro)
    <div class="card p-4" style="background-color: #d98f8f">
        <div style="color:#803b3b">
            {{$mensagemerro}}
        </div>
    </div>
    @endisset
    <main>
    <div class="form-group mx-sm-3 mb-2">
        <form action="{{route('criar.aut')}}" method="post">
            @csrf

                <label for="telefone">Telefone:</label><br>
                <input type="text" name="telefone" id="telefone" placeholder="Numero de telefone" class="form-control mb-2" required><br>
                <label for="telefone">Nome:</label><br>
                <input type="text" name="nome" id="nome" placeholder="Informe nome" class="form-control mb-2" required><br>
                <label for="nome">senha:</label><br>
                <small style="color:#803b3b">
                    regras minimo 8 digitos, maiusculo, minusculo, especial e numerico.<br>

                </small>
                <input type="password" onkeydown="ValidaSenha()" name="senha" placeholder="senha" class="form-control mb-2" id="senha" required><br>
                <label for="nome">Repetir senha (repita a senha informada no campo anterior):</label><br>
                <div class="d-flex">
                    <input type="password" placeholder="senha" name="senha1" class="form-control mb-2" id="senha1" required>
                    <button id="btnSenha" class="btn btn-secondary btn-sm p-1">show</button>
                </div><br>
                <div class="d-flex">
                <button type="submit" class="btn btn-primary" id="btnLogin" disabled>Registrar</button>
                </form>
                <a class="text-white text-decoration-none btn btn-secondary  mx-2"
                        href="{{ Route('pages.login') }}">Login</a></div>


        </div>


    </main>
    <script>
        function ValidaSenha() {
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
            const senha = document.getElementById('senha').value;
            const btnReg = document.getElementById('btnLogin');
            if (passwordRegex.test(senha)) {
                btnReg.disabled = false;
            }
            if (senha.length < 1) {
                btnReg.disabled = true;
            }

        }
    </script>

</x-layout>
