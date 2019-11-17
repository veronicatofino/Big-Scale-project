@extends('layouts.vue')

@section('content')
<div class="formBox">
    <form method="POST" action="/searchTables"> 
        @csrf
        <div class="ui segment">
            <p class="title" style="color:#000000" >Reservar</p>
            <p>Fecha reserva: </p><input type="date" name="reservationDate" placeholder="DD/MM/AAAA" class="form-control mb-2" required>
            <p>Hora reserva: </p><input type="text" name="reservationHour" placeholder="HH:MM" class="form-control mb-2" required>
            <p>Número de personas: </p><input type= "name" name="availableChairs" placeholder="" class="form-control mb-2" required>
            <div class="buttonHolder" style="text-align:center">
                <button class="ui inverted secondary button" type="submit">Buscar mesa</button>    
            </div>
        </div>
    </form>
</div>
<div class="eventBox" style="text-align:center">
    <p class="title">Eventos del Restaurante</p>
    @foreach ($events as $event)
    <div class="ui yellow raised segment" style="margin-top:-11px; padding: 1rem; text-align:center; width:50%; float:left">
        @foreach ($event as $key=>$value)
            @if($key != '_id' and $key != 'idRestaurant' and $key != '__v' and $key != 'urlImg')
                @if($key == 'date')
                    <?php echo date('d/m/y H:i', strtotime($value)) ?>
                @else
                    <div>
                        <p style="font-size:15px"><?php echo $value ?></p>
                    </div>
                @endif
            @endif
        <div>
            @if($key == 'urlImg')
                <br>
                <img style="width:70%;height:70%;border-radius:3px" src="https://i0.wp.com/newyorkermeetslondon.com/wp-content/uploads/2016/07/Circus-main-promotional-hoop-shot.jpg?fit=1024%2C683&ssl=1">
            @endif</div>
        @endforeach
    </div>
    @endforeach
</div>  
@endsection
