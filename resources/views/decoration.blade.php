@extends('layouts.vue')
@section('content')
<div>
<div class="links">
	<a href="/decoration">Decoración</a>
	<div class="card-body">
		
        <form method="POST" action="confirmation">
            @csrf
<			<input type="hidden" name="FK_idDecoration" value=0 />
			<input type="submit" value="Omitir" />
        </form>

    </div>
</div>
</div>
@endsection-->


