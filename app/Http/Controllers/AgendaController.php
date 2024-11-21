<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\servico;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    public function data(Request $request)
    {
        $validaAdm = $request->session()->get('adm');
        $diasemana = session('diasemana');
        $hoje = Carbon::today()->format('Y-m-d');



        $nomeUsuario = $request->session()->get('nome.usuario');

        // Retorna a view com os dados
        return view('pages.agenda.data')->with('hoje', $hoje)->with('diasemana', $diasemana);
    }

    public function datahora(Request $request)
    {
        $request->validate([
            'dataInput' => 'required'
        ]);
        $request->session()->put('dataform', $request->input('dataInput'));
        return redirect()->route('agenda.hora');
    }

    public function hora(Request $request)
    {

        $data = $request->session()->get('dataform');

        $data = Carbon::parse($data)->format('Y-m-d');
        $result = DB::select(
            "
            SELECT
            id_hora,
            hora
            FROM hora
            where id_hora
            not in (
            SELECT
            id_hora
            FROM agenda where data = ?
            )
            ",
            [$data]
        );


        return view('pages.agenda.hora')->with('result', $result);
    }

    public function horaservico(Request $request)
    {
        $request->validate([
            'hora' => 'required'
        ]);

        $request->session()->put('horaform', $request->input('hora'));

        return redirect()->route('agenda.servico');
    }
    public function servico(Request $request)
    {
        $result = servico::all();

        return view('pages.agenda.servico')->with('result', $result);
    }
    public function servicoconcluido(Request $request)
    {
        $servicoForm=$request->input('servico');
        $ativo = 's';
        $dataForm = $request->session()->get('dataform');
        $horaForm = $request->session()->get('horaform');

        $usuarioForm = session('usuario_id');
        $descricaoForm = $request->input('descricao');

        Agenda::create([
            'id_usuario' => $usuarioForm,
            'data' => $dataForm,
            'id_hora' => $horaForm,
            'id_servico' => $servicoForm,
            'descricao' => $descricaoForm,
            'ativo' => $ativo

        ]);


        return redirect()->route("agenda.concluido");
    }
    public function concluido(){
        session()->flush();
        return view('pages.agenda.concluido');
    }

}
