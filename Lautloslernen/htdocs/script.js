
/**
 * Auto Suche
 */

async function suggest(searchInput) {
    const value = searchInput.value

    const data = await fetch('http://localhost:8080/?a=suggest&q=' + value)
    result = await data.json()

    const domElement = document.querySelector('.search .result')
    const markup = `
        <ul>
        ${result.map(item => `
            <li> <a href="http://localhost:8080/?c=car&a=detaill&id=${item.AutoID}">${item.Name}</a></li>
        `).join('')}
        </ul>
    `      
    domElement.innerHTML = markup;
}

/*Filterleiste*/
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }
  
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
  }

  /*Bild Startseite*/
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 10000); // Change image every 2 seconds
}


