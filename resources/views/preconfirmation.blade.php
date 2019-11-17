@extends('layouts.vue')

@section('content')
<div class="formBox" style="padding: 2rem 20rem 2rem 20rem;width: 100%">
    <form method="POST" action="completeReservation"> 
        @csrf
        <div class="ui segment" style="padding: 1rem 5rem 2rem 5rem; margin-top:2rem; margin-top: -0.1rem">
            <p class="title" style="color:#000000; margin-top:1.5rem" >Completar Reserva</p>
            <p>Persona a cargo: </p><input type="text" name="personInCharge" placeholder="" class="form-control mb-2">
            <p>Tipo de reserva: </p>
            <select name="reservationType" class="custom-select" id="sel1">
                <option value="Privada">Privada</option>
                <option value="Pública">Pública</option>
            </select>
            <!--<p>Tipo de reserva: </p><input type="text" name="reservationType" placeholder="" class="form-control mb-2">-->
            <p>Tarjeta de crédito: </p><input type= "text" name="cardNumber" placeholder="" class="form-control mb-2">
            <p>Comentario: </p><input type= "text" name="comments" placeholder="" class="form-control mb-2">

            
            <div class="buttonHolder" style="text-align:center">
                <button class="ui inverted secondary button" type="submit">Continuar</button>    
            </div>
        </div>
    </form>
</div>
@endsection
