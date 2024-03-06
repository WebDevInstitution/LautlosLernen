<img src="Lautloslernen/htdocs/img/LogoLtransparent.png" alt="LautlosLernen Logo" height="300" width="700" />

### Gruppenmitglieder
<table>
  <tr>
    <th>Name</th>
    <th>Kürzel</th>
  </tr>
  <tr>
    <td>Tim Buckenthien</td>
    <td>wi22162</td>
  </tr>
  <tr>
    <td>Leni Grohmann</td>
    <td>wi22020</td>
  </tr>
  <tr>
    <td>Mia Holzkamp</td>
    <td>wi22160</td>
  </tr>
  <tr>
    <td>Kai Keppler</td>
    <td>wi22234</td>
  </tr>
  <tr>
    <td>Edona Lokaj</td>
    <td>wi22108</td>
  </tr>
</table>

## Aufbau
Der Code ist nach dem [MVC-Modell](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller) strukturiert. <br>
Das Teachable Machine Model ist [hier](Lautloslernen/htdocs/views/learning/default.php) zu finden.

## Aufsetzen auf der eigenen Maschine
Um das Projekt auf dem eigenen PC richtig verwenden zu können, muss [Docker Desktop](https://www.docker.com/products/docker-desktop/) installiert sein.<br>
Für Windows muss außerdem [das Linux Subsystem for Windows WSL 2](https://learn.microsoft.com/de-de/windows/wsl/install) installiert sein. Unter MacOS oder Linux ist dies nicht nötig.<br>
Im Verzeichnis `Lautloslernen/docker-compose.yml` muss das File `docker-compose.yml` mit ```docker-compose up``` gestartet werden.<br>
Der daraus gebaute Container macht den Abruf der Website unter [http://localhost:8080](http://localhost:8080) möglich.<br>
Die Datenbank ist unter dem Port 8081 zu finden.<br>
<br>
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


## Interessante Stellen
// TODO: Interessante Codesnippets o.ä. verlinken.
