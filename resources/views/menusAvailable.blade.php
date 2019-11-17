<!DOCTYPE html>
    <div class="card-body">
        <form method="POST" action="saveMenu">
            @csrf
            <input type="checkbox" name="menus[]" value=1> Menú 1<br>
            <input type="checkbox" name="menus[]" value=2> Menú 2<br>
            <input type="checkbox" name="menus[]" value=3> Menú 3<br>  
            <input type="submit" value="Continuar">
        </form>
    </div>