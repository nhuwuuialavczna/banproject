@extends('menu')
@section('NoiDung')
    <p>- {{$getOne->matailieu}}</p>
    <p>- {{$getOne->tentailieu}}</p>

    @foreach($listCungLoai as $project)
        <p>{{$project->tentailieu}}</p>
    @endforeach

    {{--<p>- {{$listCungLoai}}</p>--}}
@endsection