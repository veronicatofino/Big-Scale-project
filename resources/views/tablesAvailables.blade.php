<!DOCTYPE html>
    <div class="card-body">
        <form method="POST" action="selectTable">
            @csrf
            <input type="radio" name="FK_idTable" value=1> Mesa 1<br>
            <input type="radio" name="FK_idTable" value=2> Mesa 2<br>
            <input type="radio" name="FK_idTable" value=3> Mesa 3<br>  
            <input type="submit" value="Continuar">
        </form>
    </div>