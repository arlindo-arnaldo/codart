@extends('admin.layouts.pages')
@section('title','Adicionar novo utilizador')

@section('page-title','Deletar utilizador')
@section('content')  
    <div>
        <p>Você está prestes a deletar o utilizador <strong> {{$user->name}} </strong> </p>
        <p>Atribuir os artigos deste utilizador para : </p>
        <form action="{{route('admin.users.confirm-delete-user', $user->id)}}" method="post">
            @csrf
            <div class="form-group">
                <select name="user">
                    @foreach (\App\Models\User::where('id', '!=', $user->id)->get() as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" value="Deletar" class="btn btn-danger btn-sm"> 
            </div>
        </form>
    </div>
@endsection

