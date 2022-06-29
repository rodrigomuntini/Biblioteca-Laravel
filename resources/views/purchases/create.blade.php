@extends('adminlte::page')

@section('content')
    <div class="container w-75">
        <h3>Nova Compra</h3>

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['url' => 'purchases/store']) !!}
            <div class="form-group">
                {!! Form::label('payment_method', 'Forma de Pagamento:') !!}
                {!! Form::text('payment_method', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('total', 'Total:') !!}
                {!! Form::input('number', 'total', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('status', 'Pago:') !!}
                {!! Form::select('status', [true => "Pago", false => "Não Pago"], null, ['class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('client_id', 'Cliente:') !!}
                {!! Form::select(
                    'client_id',
                    \App\Models\Client::orderBy('name')->pluck('name', 'id')->toArray(),
                    null,
                    ['class'=>'form-control', 'required']
                ) !!}
            </div>

            <hr>

            <h4>Livros</h4>
            <div class="input_fields_wrap"></div>
            <br>

            <button type="button" style="float:right" class="add_field_button btn btn-default">Adicionar Livro</button>

            <br>
            <br>

            <hr>

            <div class="form-group">
                {!! Form::submit('Criar Compra', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var wrapper = $('.input_fields_wrap');
            var add_button = $('.add_field_button');
            var x = 0;
        
            $(add_button).click(function(e) {
                x++;

                var newField = '<div><div style="width: 94%; float: left; margin-right: 1%; margin-bottom: 1%;" id="books">{!! Form::select("books[]", \App\Models\Book::orderBy("name")->pluck("name", "id")->toArray(), null, ["class"=>"form-control", "required", "placeholder"=>"Selecione um livro"]) !!}</div><button type="button" class="remove_field btn btn-danger btn-circle" style="margin-bottom: 1%;"><i class="fa fa-times"></button></div>';
                $(wrapper).append(newField);
            });
        
            $(wrapper).on("click", ".remove_field", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            });
        })
    </script>
@stop