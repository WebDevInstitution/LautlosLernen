<img src="Lautloslernen/htdocs/img/LogoLtransparent.png" alt="LautlosLernen Logo" height="300" width="700" />

## Aufbau
Der Code ist nach dem [MVC-Modell](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller) strukturiert. <br>
Das Teachable Machine Model ist [hier](Lautloslernen/htdocs/views/learning/default.php) zu finden.

## Aufsetzen auf der eigenen Maschine
Um das Projekt auf dem eigenen PC richtig verwenden zu können, muss [Docker Desktop](https://www.docker.com/products/docker-desktop/) installiert sein.<br>
Für die Installation müssen die folgenden Schritte ausgeführt werden:<br>
<ins>Unter Windows:</ins><br>
Es muss [das Linux Subsystem for Windows WSL 2](https://learn.microsoft.com/de-de/windows/wsl/install) installiert werden.<br>
Für alle Unix basierten Betriebsysteme ist dies nicht nötig.<br>
<ins>Für alle Betriebssysteme:</ins><br>
Im Verzeichnis `Lautloslernen/` muss das File `docker-compose.yml` über ein Terminal mit ```docker-compose up``` gestartet werden.<br>
Währenddessen muss Docker Desktop gestartet sein.<br>
Der daraus gebaute Container macht den Abruf der Website unter [http://localhost:8080](http://localhost:8080) möglich.<br>
Die Datenbank ist unter dem [http://localhost:8081](http://localhost:8081) zu finden.<br>
Login-Daten dafür sind:
<table>
  <tr>
    <td>Server:</td>
    <td>mariadb</td>
  </tr>
  <tr>
    <td>Benutzername:</td>
    <td>admin</td>
  </tr>
  <tr>
    <td>Passwort:</td>
    <td>wwi2022a</td>
  </tr>
</table>
