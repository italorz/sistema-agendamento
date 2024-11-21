<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Termwind\Components\Dd;

use function PHPUnit\Framework\isNull;

class LoginController extends Controller
{

    public function index(Request $request)
    {


        $loginfalhou = $request->session()->get('fail.login');
        $mensagemok = $request->session()->get('mensagem.ok');
        if ($mensagemok) {
            session()->forget('mensagem.erro');
            session()->forget('fail.login');
            return view('pages.login')->with('mensagemok', $mensagemok);
        }
        session()->forget('mensagem.ok');
        return view('pages.login')->with('loginfalhou', $loginfalhou);
    }



    public function aut(Request $request)
    {
        $telefone = $request->input('telefone');
        $usuario = Usuario::where('telefone', $telefone)->first();
        session()->forget('fail.login');
        session()->forget('historico');
        if ($usuario && password_verify($request->input('senha'), $usuario->senha))
        {
            session(['usuario_id' => $usuario->id_usuario]);
            session(['usuario_nome' => $usuario->nome]);
            $request->session()->put('usuario.telefone',$telefone);
            $result = DB::select("
            SELECT
            ag.id_agenda
            FROM agenda ag
            left join usuarios us on us.id_usuario = ag.id_usuario
            where us.telefone = ?
            and ag.data >= DATE_ADD(CURDATE(),INTERVAL 2 DAY)
            and ag.ativo = 's'
            ;
            ", [$telefone]);
            //dd($result);
            if ($result and $usuario->adm != 's') {
                $inicioSemana = Carbon::now()->startOfWeek();
                $finalSemana = Carbon::now()->endOfWeek();
                $diasemana = DB::select("
                SELECT
                AG.data
                FROM
                AGENDA AG
                LEFT JOIN USUARIOS US ON AG.ID_USUARIO = US.ID_USUARIO
                LEFT JOIN HORA H ON H.ID_HORA = AG.ID_HORA
                WHERE US.TELEFONE = ?
                AND AG.DATA >= ?
                AND AG.DATA <= ?
                LIMIT 1
            ", [$telefone, $inicioSemana, $finalSemana]);
                if (!$diasemana) {
                }else{
                if($diasemana[0]->data){
                    session(['diasemana' => $diasemana[0]->data]);
                }
            }
                $request->session()->put('telefone', $usuario['telefone']);
                $request->session()->put('historico', $result);
                return redirect()->route('usuario.historico');
            }

            if ($usuario->adm == 's') {
                $request->session()->put('adm',$usuario->adm );
                return redirect()->Route('adm.agendamentos');
            }
            return redirect()->route('agenda.data');
        } else {
            session()->forget('mensagem.ok');
            $request->session()->put('fail.login', 'Usuario nao encontrado. Numero ou Senha incorretos');
            return redirect()->route('pages.login');
        }
    }
    public function create(Request $request)
    {
        $mensagemerro = $request->session()->get('mensagem.erro');
        return view('pages.CreateLogin')->with('mensagemerro', $mensagemerro);
    }
    public function autCreate(Request $request)
    {
        $request->validate([
            'telefone' => 'required',
            'nome' => 'required',
            'senha' => 'required',
            'senha1' => 'required'
        ]);
        if (strlen($request['senha']) < 6) {
            $request->session()->put('mensagem.erro', 'A quantidade de caracteres presente na senha é menos que 6. Por favor verificar!');
            return redirect()->back();
        }
        if ($request->input('senha') == $request->input('senha1')) {
            Usuario::create([
                'nome' => $request->input('nome'),
                'senha' => bcrypt($request->input('senha')),
                'telefone' => $request->input('telefone')
            ]);
            $request->session()->put('mensagem.ok', 'Usuario cadastrado com sucesso!');
            return redirect()->route('pages.login');
        } else {
            $request->session()->put('mensagem.erro', 'Usuario não cadastrado, por favor verificar a senha informada');
            return redirect()->back();
        }
    }
    public function historico(Request $request)
    {
        session()->forget('fail.login');
        $usuTelefone=$request->session()->get('usuario.telefone');
        $lista = DB::select("
            SELECT
            ag.id_agenda,
            ag.data,
            h.hora as hora,
            se.nome,
            us.adm,
            ag.descricao
            FROM agenda ag
            left join hora h on h.id_hora=ag.id_hora
            left join servicos se on se.id_servico = ag.id_servico
            left join usuarios us on us.id_usuario = ag.id_usuario
            where us.telefone = ?
            and ag.data >= DATE_ADD(CURDATE(),INTERVAL 2 DAY)
            and ag.ativo = 's'
            ;
            ", [$usuTelefone]);
        foreach ($lista as $item) {
            if (isset($item->data)) {
                $item->data = Carbon::parse($item->data)->format('d/m/Y');
            }
        }
        return view('pages.historico')->with('lista', $lista);
    }
    public function completo(Request $request)
    {
        $ustelefone = $request->session()->get('telefone');
        $completo = DB::select("
    SELECT
    ag.id_agenda,
    ag.data,
    h.hora AS hora,
    se.nome,
    us.adm,
    ag.descricao,
    CASE WHEN ag.ativo = 's'
    THEN 'pendente'
    ELSE 'concluido' END AS status
    FROM agenda ag
    LEFT JOIN hora h ON h.id_hora = ag.id_hora
    LEFT JOIN servicos se ON se.id_servico = ag.id_servico
    LEFT JOIN usuarios us ON us.id_usuario = ag.id_usuario
    WHERE us.telefone = :telefone

    ", [
            ':telefone' => $ustelefone
        ]);

        foreach ($completo as $item) {
            if (isset($item->data)) {
                $item->data = Carbon::parse($item->data)->format('d/m/Y');
            }
        }


        return view('pages.completo')->with('lista', $completo);
    }



    public function historicodata(Request $request)
    {

        $request->session()->put('ini', $request->input('ini'));
        $request->session()->put('end', $request->input('end'));
        return redirect()->route("historico.completo.resultado");
    }
    public function historicoresultado(Request $request)
    {
        $ini = Carbon::parse($request->session()->get('ini'))->format('Y-m-d');
        $fim = Carbon::parse($request->session()->get('end'))->format('Y-m-d');


        $filtro = DB::select("
    SELECT
    ag.id_agenda,
    ag.data,
    h.hora AS hora,
    se.nome,
    us.adm,
    ag.descricao,
    CASE WHEN ag.ativo = 's'
    THEN 'pendente'
    ELSE 'concluido' END AS status
    FROM agenda ag
    LEFT JOIN hora h ON h.id_hora = ag.id_hora
    LEFT JOIN servicos se ON se.id_servico = ag.id_servico
    LEFT JOIN usuarios us ON us.id_usuario = ag.id_usuario
    where ag.data <= :fim
    AND ag.data >= :ini


    ", [

            ':fim' => $fim,
            ':ini'=>$ini]);
            foreach ($filtro as $item) {
                if (isset($item->data)) {
                    $item->data=  Carbon::parse($item->data)->format('d/m/Y');
                }
            }
            $validaadm=$request->session()->get('adm');

            // if ($validaadm=='s') {
            //     $request->session()->put('filtro',$filtro);
            //     return redirect()->route('adm.agendamentos');
            // }
            return view('pages.completoResultado')->with('lista',$filtro);
    }
}
