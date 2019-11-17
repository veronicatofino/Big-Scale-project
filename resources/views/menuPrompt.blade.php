@extends('layouts.vue')

@section('content')
<div class="tableBox">
	<div class="ui segment" style="text-align:center">
		<p class="title" style="color:#000000" >¿Desea agregar menú?</p>
		<div class="buttonHolder" style="text-align:center">
			<button onclick="location.href='/menusAvailable'" type="button" class="ui inverted secondary button">Si</button>
			<button onclick="location.href='/skipMenu'" type="button" class="ui inverted secondary button">No</button>
		</div>
	</div>
</div>
@endsection


