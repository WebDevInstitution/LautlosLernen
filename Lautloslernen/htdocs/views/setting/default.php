<?php
// Hier wird der HTML-Teil der Seite dargestellt
if($_SESSION['isLoggin']==true){
?>
<h1>Datenbank auf Urspungswert zurücksetzen</h1>

<form action="/?c=setting&a=dbreset" method="post" onsubmit = "showDBResetMessage()">
    <input type="submit" value="DB zurücksetzten"><br><br>
</form>

<script>
function showDBResetMessage() {
    // Zeige eine Nachricht an, dass das Auto gelöscht wurde
    window.alert('Die Datenbank wurde zurückgesetzt!');
    return false;
}
</script>

<h1>Auto mit ID Löschen</h1>
<div style="position: relative;
            left: 0;
            width: 300px;
            padding: 10px;">
<form action="/?c=setting&a=loescheAutoMitID" method="post" onsubmit = "showDeletionMessage()" style="width: 80%; margin: auto;">
<fieldset>    
    <label for="name">Auto ID:</label>
    <input type="number" name="autoid" required><br><br>
    <input type="submit" value="Auto löschen"><br><br>
</fieldset>
</form></div>

<script>
function showDeletionMessage() {

    // Zeige eine Nachricht an, dass das Auto gelöscht wurde
    window.alert('Das Auto wurde gelöscht!');

}
</script>


<h1>Neues Auto hinzufügen</h1>
<div style="position: relative;
            left: 0;
            width: 300px;
            padding: 10px;">
<form action="/?c=setting&a=addcar" method="post" onsubmit="return showAddCarMessage()" style="width: 80%; margin: auto;">
    <fieldset>
        <legend>Autoinformationen</legend>
        <div style="display: flex; flex-direction: column;">
            <label for="markenID">MarkenID:</label>
            <select name="markenID" required>
                <option value="1">Mercedes Benz</option>
                <option value="2">Audi</option>
                <option value="3">BMW</option>
                <option value="4">Porsche</option>
                <option value="5">Bentley</option>
                <option value="6">Maserati</option>
                <option value="7">Jaguar</option>
                <option value="8">Ferrari</option>
                <option value="9">Volkswagen</option>
            </select>
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <label for="ps">PS:</label>
            <input type="number" name="ps" required>
            <label for="preis">Preis:</label>
            <input type="number" name="preis" required>
            <label for="vorbesitzer">Vorbesitzer:</label>
            <input type="number" name="vorbesitzer" required>
            <label for="erstzulassung">Erstzulassung:</label>
            <input type="date" name="erstzulassung" required>
            <label for="tsn">TSN:</label>
            <input type="text" name="tsn" required>
            <label for="fahrzeugklasse">Fahrzeugklasse:</label>
            <input type="text" name="fahrzeugklasse" required>
            <label for="typ">Typ:</label>
            <input type="text" name="typ" required>
            <label for="variante">Variante:</label>
            <input type="text" name="variante" required>
            <label for="version">Version:</label>
            <input type="text" name="version" required>
            <label for="bezeichnung_der_fahrzeugklasse">Bezeichnung der Fahrzeugklasse:</label>
            <input type="text" name="bezeichnung_der_fahrzeugklasse" required>
            <label for="artdesaufbaus">Aufbau:</label>
            <input type = "text" name="artdesaufbaus" required>
            <label for="schadstoffklasse">Schadstoffklasse:</label>
            <input type="text" name="schadstoffklasse" required>
            <label for="emissionsklasse">Emissionsklasse:</label>
            <input type="text" name="emissionsklasse" required>
            <label for="kraftstoffart">Kraftstoffart:</label>
            <select name="kraftstoffart" required>
                <option value="Benzin">Benzin</option>
                <option value="Diesel">Diesel</option>
                <option value="Elektro">Elektro</option>
            </select>
            <label for="verbrauch_innerorts">Verbrauch innerorts:</label>
            <input type="number" step="0.01" name="verbrauch_innerorts" min="0" required>
            <label for="verbrauch_ausserorts">Verbrauch außerorts:</label>
            <input type="number" step="0.01" name="verbrauch_ausserorts" min="0" required>
            <label for="verbrauch_kombiniert">Verbrauch kombiniert:</label>
            <input type="number" step="0.01" name="verbrauch_kombiniert"  min="0"required>
            <label for="CO2_Emission_kombiniert">CO2-Emission kombiniert:</label>
            <input type="number" name="CO2_Emission_kombiniert"  min="0" required>
            <label for="sehrschnellWLTP">Sehr schnell WLTP:</label>
            <input type="number" step="0.01" name="sehrschnellWLTP" min="0" required>
            <label for="schnellWLTP">Schnell WLTP:</label>
            <input type="number" step="0.01" name="schnellWLTP" min="0" required>
            <label for="langsamWLTP">Langsam WLTP:</label>
            <input type="number" step="0.01" name="langsamWLTP" min="0" required>
            <label for="CO2_Emission_kombiniert_WLTP">CO2-Emission kombiniert WLTP:</label>
            <input type="number" name="CO2_Emission_kombiniert_WLTP" min="0" required>
            <label for="bild">Bild:</label>
            <input type="text" name="bild" required>
        </div>
        <input type="submit" value="Auto hinzufügen">
    </fieldset>
</form></div>


<script>
function showAddCarMessage() {

    // Zeige eine Nachricht an, dass das Auto gelöscht wurde
    window.alert('Das Auto wurde hinzugefügt!');

}
</script>



<?php } else{ echo('Sie haben keine Berechtigung für diese Seite! Bitte melden sie sich an.');} ?>