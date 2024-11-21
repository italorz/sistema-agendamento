<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\hora;
use App\Models\servico;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class AdmController extends Controller
{
    public function agendamentos()
    {
        $result_lista = DB::select("
        SELECT
            ag.id_agenda,
            us.nome,
            ag.data,
            h.hora as hora,
            se.nome,
            ag.descricao,
            CASE WHEN ag.ativo = 's'
            THEN 'pendente'
            ELSE 'concluido' END AS status
            FROM agenda ag
            left join hora h on h.id_hora=ag.id_hora
            left join servicos se on se.id_servico = ag.id_servico
            left join usuarios us on us.id_usuario= ag.id_usuario
        ");
        $lucrop=DB::select("
        SELECT
        sum(se.preco) as lucro
        FROM agenda ag
        left join hora h on h.id_hora=ag.id_hora
        left join servicos se on se.id_servico = ag.id_servico
        left join usuarios us on us.id_usuario= ag.id_usuario
        where ag.ativo = 's'
        ");
        $lucroc=DB::select("
        SELECT
        sum(se.preco) as lucro
        FROM agenda ag
        left join hora h on h.id_hora=ag.id_hora
        left join servicos se on se.id_servico = ag.id_servico
        left join usuarios us on us.id_usuario= ag.id_usuario
        where ag.ativo <> 's'
        ");


        foreach ($result_lista as $item) {
            if (isset($item->data)) {
                $item->data=  Carbon::parse($item->data)->format('d/m/Y');
            }
        }
        return
            view('pages.adm.agendamentos')
            ->with('result_lista', $result_lista)
            ->with('lucrop',$lucrop)
            ->with('lucroc',$lucroc);
    }
    public function agendamentosResult(Request $request){
        $result=$request->session()->get('filtro');
        return view('agendamentosResultado')->with('lista',$result);
    }

    public function create(){
        $result_hora=DB::select("select * from hora");
        $result_usuario=Usuario::all();
        $result_servico=servico::all();

        $hoje=Carbon::now()->format('Y-m-d');

        return view("pages.adm.atendimento")
        ->with('hoje',$hoje)
        ->with('result_hora',$result_hora)
        ->with('result_usuario',$result_usuario)
        ->with('result_servico',$result_servico);
    }
    public function post(Request $request){
        $servicoForm=$request->input('servico');
        $ativo = 's';
        $dataForm = $request->input('data');
        $horaForm = $request->input('hora');
        $usuarioForm =$request->input('cliente');
        $descricaoForm = $request->input('descricao');

        Agenda::create([
            'id_usuario' => $usuarioForm,
            'data' => $dataForm,
            'id_hora' => $horaForm,
            'id_servico' => $servicoForm,
            'descricao' => $descricaoForm,
            'ativo' => $ativo

        ]);
        return redirect()->route('adm.agendamentos');
    }
    public function edit(int $id=null){
        $result_hora=DB::select("select * from hora");
        $result_usuario=Usuario::all();
        $result_servico=servico::all();
        $find= DB::select("
        SELECT
            ag.id_agenda,
            us.nome,
            ag.data,
            ag.id_hora,
            h.hora as hora,
            se.id_servico,
            se.nome,
            ag.descricao,
            CASE WHEN ag.ativo = 's'
            THEN 'pendente'
            ELSE 'concluido' END AS status
            FROM agenda ag
            left join hora h on h.id_hora=ag.id_hora
            left join servicos se on se.id_servico = ag.id_servico
            left join usuarios us on us.id_usuario= ag.id_usuario
            where ag.id_agenda = ?
        ",[$id]);

        return view("pages.adm.editatendimento")
        ->with('find',$find)

        ->with('result_hora',$result_hora)
        ->with('result_usuario',$result_usuario)
        ->with('result_servico',$result_servico);
    }
    public function update(Request $request, $id)
{   //dd($request->hora);
    $agendamento = DB::update("
    update agenda set data = ?,
     id_hora = ?, id_servico = ?,
      descricao = ? where id_agenda = ?",
    [$request->data,$request->hora,$request->servico,$request->descricao,$id]);
    $validaadm=session('usuario_id');
    $adm=DB::select("select adm from usuarios where id_usuario= ?",[$validaadm]);

    if ($adm[0]->adm=='s') {
        return redirect()->route('historico.completo.resultado');
    }


    return redirect()->route("usuario.historico");
}




}
