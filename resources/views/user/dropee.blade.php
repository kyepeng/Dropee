@extends('layout.layout')

@section('css')
<style type="text/css">
        .help-block
        {
            color: red;
        }

        .background
        {
           background-image: url('{{asset('images/waterfall2.jpg')}}');
           -webkit-background-size: cover;
           -moz-background-size: cover;
           -o-background-size: cover;
           background-size: cover;
           width: 100%;
           height : 100%;
           overflow-x : hidden;
        }

        .boxes{
            margin-top : 20vh;
            margin-left : 18vw;
            width: 70%;
        }

        .card{
            text-align : center;
            border-radius : 15px;
            width : 15vw;
            height : 15vh;
            vertical-align: middle;
            line-height: 15vh;
            opacity: 0.9;
        }
</style>
@endsection

@section('content')

    <div class="background">
        <div class="row boxes">

            @foreach($boxes as $box)
            <div class="card" style="{{$box->style}}">
                {{$box->text}}
            </div>
            @endforeach
        </div>
    </div>

@endsection