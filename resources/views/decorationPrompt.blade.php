@extends('layouts.vue')

@section('content')
<div class="tableBox">
	<div class="ui segment" style="text-align:center">
		<p class="title" style="color:#000000" >¿Desea agregar decoración?</p>
		<div class="buttonHolder" style="text-align:center">
			<button onclick="location.href='/decorationsAvailable'" type="button" class="ui inverted secondary button">Si</button>
			<button onclick="location.href='/skipDecoration'" type="button" class="ui inverted secondary button">No</button>
		</div>
	</div>
</div>
@endsection
