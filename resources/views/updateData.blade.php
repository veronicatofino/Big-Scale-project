<!DOCTYPE html>
    <div class="card-body">
        <form method="POST" action="/updateReservation">
            @csrf
                <!--<p>id Reserva: </p><input type="number" name="idReservation" placeholder="" class="form-control mb-2">-->
                <p>A nombre de: </p><input type= "text" name="personInCharge" placeholder="" class="form-control mb-2">
                <p>Tipo reserva:</p><input type="number" name="typeReservation" placeholder="" class="form-control mb-2">
                <p>comentarios: </p><input type= "text" name="comments" placeholder="" class="form-control mb-2">
                <ul>
                <li><?= $data; ?></li>
                </ul>
                <div class="buttonHolder" style="text-align:center">
                <button type="submit">Actualizar</button>    
                </div>
        </form>
    </div>