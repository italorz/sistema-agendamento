<?php

namespace App\Http\Controllers;

use App\Models\servico;
use Illuminate\Http\Request;

class servicoController extends Controller
{
    public function index()
    {
        $servicos = servico::all();
        return view('pages.adm.servico', compact('servicos'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'preco' => 'required',

        ]);

        servico::create($request->all());
        return redirect()->route('pages.adm.servico');

    }

    public function edit($id)
    {
        $servico = servico::findOrFail($id);
        return view("pages.adm.servicosedit", compact('servico'));
    }


    public function update(Request $request, $id)
    {
        $servico = servico::findOrFail($id);


        $validatedData = $request->validate([
            'nome' => 'required',
            'preco' => 'required',

        ]);


        $servico->update($validatedData);


        return redirect()->route('pages.adm.servico');
    }

    public function destroy($id)
{
    $servico = servico::findOrFail($id);

    $servico->delete();

    return redirect()->route('pages.adm.servico');

}


}
