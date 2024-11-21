<x-layout titulo="agenda-data">
    <main>

        <form action="{{Route('agenda.datahora')}}" method="post">
            @csrf
            <div class="d-flex mb-4" style="justify-content: space-between; justify-content: center;">
                <div class="row">
                    <div class="col-12">
                        <label for="">Selecioane uma data:</label><br>
                        <input min="{{ $hoje }}" name="dataInput" class="form-control" value="{{$diasemana}}" type="date" id="date" required>



                    </div>
                </div>
                <div>
                    <div class="m-4"><br>
                        <button class="btn btn-primary mt-2">>></button>
                    </div>
                </div>
            </div>
        </form>

    </main>
    <div class="card">

        <div class="d-flex">
            <div class="bg-primary p-2 col-4"></div>
        </div>
    </div>
</x-layout>
