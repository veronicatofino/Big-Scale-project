@extends('layouts.vue')

@section('content')
<div class="tableBox">
    <form method="POST" action="selectTable">
         @csrf
         <div class="ui segment" style="text-align:center;margin-top:-0.1rem">
            <p class="title" style="color:#000000" >Encontramos una mesa para ti!</p>
            <ul style="padding:0">
                <li style="list-style-type: none"><p>Mesa # <?= $table; ?></p></li>
            </ul>
            <div class="buttonHolder" style="text-align:center">
                <button class="ui inverted secondary button" type="submit" value="Cancelar">Cancelar</button> 
                <button class="ui inverted secondary button" type="submit" value="Atras">Atrás</button>
                <button class="ui inverted secondary button" type="submit" value="Continuar">Seguir</button> 
            </div>
        </div>
    </form>
</div>
@endsection