@extends('layouts.vue')

@section('content')
<div class="tableBox">
	<div class="ui segment" style="text-align:center;padding:2rem">
        <form method="POST" action="confirmation">
            @csrf 
            <p class="title" style="color:#000000; margin-top:1.5rem" >Información de la Reserva</p>
            <p>Fecha: <?php echo $data['reservationDate'] ?> </p>
            <p>Hora:  <?php echo $data['reservationHour']?> </p>
            <p>Número de personas: <?php echo $data['availableChairs']?> </p>
            <p>Tarjeta de crédito: <?php echo $data['cardNumber']?> </p>
            <input class="ui inverted secondary button" type="submit" value="Continuar">
        </form>
    </div>
</div>
@endsection