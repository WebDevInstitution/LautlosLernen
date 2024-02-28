<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <p>Automarken:</p>
  <form method="post" action="/?c=car&a=filter">
  <label>
        <input type="checkbox" name="brands[]" value="1"> Mercedes Benz
    </label>
    <br>
    <label>
        <input type="checkbox" name="brands[]" value="2"> Audi
    </label>
    <br>
    <label>
        <input type="checkbox" name="brands[]" value="3"> BMW
    </label>
    <br>
    <label>
        <input type="checkbox" name="brands[]" value="4"> Porsche
    </label>
    <br>
    <label>
        <input type="checkbox" name="brands[]" value="5"> Bentley
    </label>
    <br>
    <label>
        <input type="checkbox" name="brands[]" value="6"> Maserati
    </label>
    <br>
    <label>
        <input type="checkbox" name="brands[]" value="7"> Jaguar
    </label>
    <br>
    <label>
        <input type="checkbox" name="brands[]" value="8"> Ferrari
    </label>
    <br>
    <label>
        <input type="checkbox" name="brands[]" value="9"> Volkswagen
    </label>
    <br>
    <p>Preis bis:</p><p id="priceValue">1000000</p>
    <div class="slider"><input name="Preis" type="range" min="1000" max="1000000" value="1000000" oninput="priceValue.innerText = this.value">
    </div> 

    <p>PS:</p><p id="psValue">1000</p>
    <div class="slider"><input name="PS" type="range" min="1" max="1000" value="1000" oninput="psValue.innerText = this.value">
    </div> 
    <p>Sortieren nach:</p>
    <input type="radio" id="br" name="sort" value="MarkenID">
    <label for="br"> Marke</label> <br>
    <input type="radio" id="pr" name="sort" value="Preis">
    <label for="pr"> Preis</label><br>
    <input type="radio" id="ps" name="sort" value="PS">
    <label for="ps"> PS</label> <br>
    <input type="radio" id="na" name="sort" value="Name">
    <label for="na"> Name</label> <br>
        
    <input type="submit" value="Filtern" id="filter"><br>
</form>
</div>

