@extends('layouts.vue')

@section('content')
    <div class="formBox" style="padding: 2rem 20rem 2rem 20rem;width: 100%">
        <form method="POST" action="saveDecoration">
            @csrf
            <div class="ui segment" style="text-align:center;width:100%;margin-top:-0.1rem">
                <p class="title" style="color:#000000" >Escoger Decoración</p><br>
                @foreach ($decorations as $decoration)
                    <div class="polaroid" style="margin-top:1rem;margin-bottom:2rem;overflow:hidden;float:left;margin-left:10%">
                    <img class="decor" style="width:100%;height:300px"src="https://drive.google.com/thumbnail?id=1GtAyKDktEuEZV_ksc5UzTpocYpkRPJNU">
		    <div style="text-align:center;display:auto;padding:2rem">
		    <div>
		    <input class="form-control" type="radio" name="decorRadio" style="width:1.5rem;height:1.5rem" value="<?php echo $decoration['_id'] ?>">
		    </div>
		    <div style="text-align:center">
		    @foreach ($decoration as $key=>$value)
                        @if($key != '_id' and $key != 'idRestaurant' and $key != '__v' and $key != 'urlImg')
                            <p style="font-size:20px"><?php echo $value ?></p>
                        @endif
			<!--@if($key == 'urlImg')
			<img class="decor" style="width:100%;height:300px"src="<?php echo $value ?>">
			@endif-->
                    @endforeach
		    </div>
		    </div>
                    <br>
                    </div><br><br><br>
                @endforeach
            <div class="buttonHolder" style="text-align:center">
                <button class="ui inverted secondary button" name="register" type="submit">Continuar</button>    
            </div>
            </div>     
        </form>
    </div>
@endsection