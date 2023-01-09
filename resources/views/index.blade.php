@extends('_partials/index')

@section('container')
    <h1 class="text-center">Todo's</h1>
    @if(session('success'))
        <div class="alert alert-success alert-dismissable margin5">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                {{ session('success') }}
            </ul>
        </div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger alert-dismissable margin5">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Errors:</strong> Please check below for errors
            <ul>
                {{ session('danger') }}
            </ul>
        </div>
    @endif
    @if ($data == '[]')
    <div class="alert alert-warning alert-dismissable margin5 text-center">
        <ul>
            Não há nada a ser listado
        </ul>
    </div>
    @endif
    {{-- shadow p-3 mb-5 bg-white rounded --}}
    <div class="card-shadow">
    @foreach($data as $dados)
        
        <div class="card-header mt-3 bg-{{$dados['expires_at']  <= date('Y-m-d') && $dados['done'] == 0 ? 'danger' : 'primary'}}">
            {{ $dados['title'] }}
            <small>{{$dados['expires_at'] <= date('Y-m-d') && $dados['done'] == 0 ? '- Vencida' : ''}}</small>
        </div>
        <div class="card-body">
            {{ $dados['description'] }}
            <hr>
            <h6>Vencimento: <input type="date" name="" id="" value="{{ $dados['expires_at'] }}" readonly></h6>
        </div>
        <div class="card-footer form-inline">
            <form action="/done/{{$dados['id']}}" method="post" class="mr-2">
                @method('PUT')
                @csrf
                <input type="hidden" name="done" id="" value={{$dados['done']}} >
                <button type="submit" title="{{$dados['done'] == 0 ? 'Feita' : 'Pendente'}}" class="btn btn-{{@$dados['done'] == 1 ? 'success' : 'danger'}} ">{{$dados['done'] == 1 ? 'Feita' : 'Pendente'}}</button>
            </form>
            <form action="/update/{{$dados['id']}}" method="post" class="mr-2">
                @method('PUT')
                @csrf
                <a href="/todo-form-update/{{ $dados['id'] }}" type="submit" title="Excluir" id="btn-excluir" class="btn btn-primary">Editar</a>
            </form>
            <form action="/delete/{{$dados['id']}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" title="Excluir" id="btn-excluir" class="btn btn-danger">Excluir</button>
            </form>
        </div>
    @endforeach
    </div>

@endsection
