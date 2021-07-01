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
            cursor: pointer;
        }

        .card:hover{
            border: 2px solid black;
            background-color : rgba(255, 0, 0, 0.2);
            color: white;
        }

        .message{
            width: 100%;
            margin:auto;
        }

        #sortable{ width: 100%;}
        #sortable li {margin: 0 auto; padding: 1px; float: left;}
</style>
@endsection

@section('content')

    <div class="background">

        <div class="row">
            <div class="message">
                @if (session('alert'))
                    <div id="alert" class="alert alert-success">
                        {{ session('alert') }} <i class="fa fa-times" aria-hidden="true" onclick="$('#alert').hide()" style="float:right;"></i>
                    </div>
                @endif
        
                @if (session('error'))
                    <div id="warning" class="alert alert-danger">
                        {{ session('error') }} <i class="fa fa-times" aria-hidden="true" onclick="$('#warning').hide()" style="float:right;"></i>
                    </div>
                @endif
            </div>
        </div>

        <div class="modal fade" id="detailModal" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Details</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ url('Admin') }}" method="POST">
                    {{ CSRF_Field() }}
                    <div class="modal-body">
                        <input hidden id="id" name="id">
                        <label>Text</label>
                        <input class="form-control" name="text" id="text">
                        <label>Font Size</label>
                        <input type="text" class="form-control" id="font-size" name="style[font-size]">
                        <label>Color</label>
                        <input type="text" class="colorpicker form-control" id="color" name="style[color]">
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-success"">Confirm</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                <form>
              </div>
            </div>
        </div>

        <div class="row boxes">
            <div id="sortable">
            @foreach($boxes as $box)
                <li class="card" style="{{$box->style}}" data-details="{{$box}}" onclick="openModal(this)">
                    <input hidden name="sequence[]" value="{{$box->id}}">
                    {{$box->text}}
                </li>
                @endforeach
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(function(){
        $( "#sortable" ).sortable({
            update: function(event, ui) {
                updateSequence();
            }
        });

        $('.colorpicker').pickAColor()
    });

    function updateSequence(){
        var seq = $('input[name="sequence[]"]').map(function(){return $(this).val();}).get();
        console.log(seq);
        $.ajax({
            url: "{{url('updateSequence')}}",
            data: {seq : seq, '_token' : "{{csrf_token()}}"},
            method: "POST",
            success: function(response){

            }
        });
    }

    function openModal(ele){
        var data = $(ele).data('details');
        
        $.each(data,function(idx,val){
            if(idx == "style" && val){
                getStyle(val);
            }
            $(`#${idx}`).val(val);
        });

        $('#detailModal').modal('show');
    }

    function getStyle(val)
    {
        var types = val.split(';');
        $.each(types,function(idx,val){
            var id = val.split(":")[0];
            var value = val.split(":")[1];
            $(`input[id="${id}"]`).val(value);
        });
    }
</script>
@endsection
