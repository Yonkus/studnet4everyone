# 1. Was ist STUDNET4EVERYONE?

Dieses Projekt bietet eine verständliche Anleitung für ein WLan-Setup für die
Studentenwohnheime der Uni Leipzig, welche Internet über das Studnet beziehen.

Das Problem, welches hier gelöst werden soll ist, dass das Studnet normalerweise
nur über einen PC oder ein sonstiges Gerät aktiviert werden kann, welches
dauerhaft laufen muss. Auch beim Einsatz eines Routers muss mindestens ein Gerät
über den Studnet-Client oder über SSH mit dem Studnet verbunden sein.

Das Ziel dieses Projektes ist ein einfaches WLan-Setup, welches keine laufenden
Geräte, wie Handy/PC/... erfordert, sondern diese Aufgabe auf einen Raspberry-PI
auslagert.

Für weitere Informationen siehe das FAQ am Ende.

**!!!Achtung!!!**: ich übernehme keine Verantwortung falls irgendetwas nicht klappt und manche Geräte dann umsonst gekauft wurden. Ich kann aber versuchen bei Problemen zu helfen. Schließlich hat dieses Setup in 3/3 mir bekannten Fällen bisher geklappt.

## 1.1 Notwendige Geräte

Wenn einige der Geräte schon vorhanden sind muss das natürlich nicht neu gekauft
werden.

|Gerät|Modelle|Kosten|Wietere Infos|
|-----|-------|------|------------|
|Router|z.B. `Fritzbox 7490` oder `TP-Link TL-WR841N` oder andere|Unter 50€|Gibt WLan.|
|Raspberry-Pi|Alles ab Modell 3|40€ bis 70€|Kleine grüne Leiterplatte, so groß wie eine Kreditkarte, die als eigenständiger Computer eingesetzt werden kann.|
|Micro-USB-Kabel|Mit Steckdosenanschluss|7€|Ist oft schon beim Raspberry-PI mit dabei.|
|SD-Karte|Micro-SD, z.B. von `SanDisk`|Unter 10€|Mindestens 16GB. Evtl. auch weniger (auf eigene Gefahr)|
|2 LAN-/Ethernet-Kabel|Egal|5€ bis 10€|Eins ist meistens beim Router schon mit drin.|

Damit kommt man letztlich auf ungefähr 100€ wenn man sich beim Kaufen geschickt anstellt und nichts gegen gebrauchtes Zeug hat.

## 1.2 Weitere Notwendigkeiten

- Ein Platz in der Nähe von einer Studnet-Steckdose (diese LAN-Buchse in der Wand) und zwei normalen Steckdosenplätzen, wo der Router und der Raspberry-PI dauerhaft stehen können.
- Ein normaler PC/Laptop für die Einrichtung von Raspberry-PI und dem Router. Egal ob Windows, Linux oder Mac
- Der PC muss einen SD-Karten-Slot oder ein SD-Karten-Lesegerät besitzen. Hier kann die Micro-SD mit einem Adapter (oft in der Verpackung mit enthalten) eingesetzt werden.
- Es sollte vorerst noch die Möglichkeit bestehen normal auf das Studnet-Internet zuzugreifen (z.B. über den Studnet-Client), da der Download von einigen Softwarepaketen notwendig ist.
- Man sollte einen Zettel vom Studentenwohnheim besitzen mit Mieternummer und Passwort für das Studnet drauf.

# 2. Anleitung zur Einrichtung

Dieses Kapitel setzt voraus, dass alle genannten Vorbedingungen erfüllt sind.

**!!!ACHTUNG!!!** Alle Passwörter und vergebene Benuternamen/Hostnamen sollten irgendwo notiert werden.

## 2.1 Betriebssystem auf die SD-Karte schreiben

1. Zuerst muss ein Betriebssystem auf den Raspberry-PI geschrieben werden. Hierzu braucht es die Software [Raspberry Pi Imager](https://www.raspberrypi.com/software/). Um diese zu installieren einfach die exe herunterladen, ausführen und der Installationsanleitung folgen (Installationsort egal).
2. Software öffnen (falls das nicht automatisch passiert).
3. Bei der Option `Raspberry Pi Modell` auf `MODELL WÄHLEN` klicken und das Modell auswählen, welches man gekauft hat (sollte auf der Verpackung oder in der Beschreibung der Bestellung stehen)
4. Bei der Option `Betriebssystem (OS)` auf `OS WÄHLEN` klicken und das neuste verfügbare System namens `Raspberry Pi OS (64-bit)` wählen (das OS ist eigentlich egal aber bestenfalls sollte man hier kein Legacy- oder Windows-artiges System wählen)
5. SD-Karte in den PC einstecken und warten bis diese erkannt wird
6. Bei der Option `SD-Karte` auf `SD-KARTE WÄHLEN` klicken und die eingesteckte SD-Karte auswählen.
7. Beim Klick auf `WEITER` unten rechts kommt ein Dialog `Möchten Sie die vorher festgelegen OS Anpassungen anwenden?`. Hier auf `Einstellungen bearbeiten` klicken. Es öffnet sich ein weiterer Dialog.
8. In dem Dialog unter dem Reiter `Allgemein` sollte die Option `Hostname` angehakt sein und in das Textfeld daneben sollte ein Name eingetragen werden, der im Netzwerk noch nicht vergeben ist. Den Namen kann man prinzipiell beliebig wählen oder ihn auf `raspberrypi` belassen, aber ein eindeutiger, leicht zu merkender Name wie z.B. `pauls-internet` könnte mögliche doppelte Benennungen vermeiden (der Hostname sollte nur aus buchstaben und, wenn gewünscht, Bindestrichen bestehen).
9. Auch in `Allgemein` sollte ein Benutzername und ein Passwort festgelegt werden (Nutzername am besten ohne Leer- und Sonderzeichen). Unter dem Reiter `Dienste` sollte unbedingt die Option `SSH aktivieren` angehakt sein zusammen mit der Option `Passwort zur Authentifizierung verwenden`.
10. Dann auf `Speichern` und alle weiteren Dialoge Bestätigen.
11. Dann wird der Schreibvorgang gestartet, was eine Weile dauern kann.
12. Nach Fertigstellung kann die SD-Karte aus dem PC entfernt werden.

## 2.2 Router einrichten

1. Router an den Strom anschließen.
2. Studnet-Steckdose mit einem LAN-Kabel mit dem Router verbinden (hier nur die separat gekennzeichnete Buchse am Router verwenden).
3. Eine Zeit lang warten bis der Router hochgefahren ist und die WLan-Leuchte an ist (ca. 1 bis 5 Minuten).
4. Für den Fall, dass der Router bereits vorher in Betrieb war (z.B. wenn er gebraucht gekauft wurde) sollte dieser erst auf Werkseinstellungen zurückgesetzt werden. Dafür existieren Anleitungen auf YouTube für die verschiedenen Hersteller.

## 2.3 Raspberry-PI in Betrieb nehmen

1. Mit dem zweiten LAN-Kabel muss nun die Lan-Buchse vom PI mit einem der verbleibenden LAN-Steckplätze im Router verbunden werden.
2. Die Micro-SD-Karte muss nun auf der Unterseite des Raspberry-PIs in den dafür vorgesehenen Steckplatz eingesteckt werden (mit den Kontakten nach oben).
3. Dann kann der Rasberry-PI an den Strom angeschlossen werden (mit dem Micro-USB-Kabel).
4. 2 Minuten warten bis der PI hochgefahren ist.

## 2.4 Das Internet normal anschalten

Um die nötige Software auf dem Raspberry-PI zu installieren benötigt es vorerst noch einmal das normale Internet. Hierzu gibt es Anleitungen im Internet oder auf den Dokumenten, welche beim Einzug mitgegeben wurden. Mit dem aktuellen Setup von PC und Router sollte das ohne Probleme so funktionieren, wie in den Anleitungen.

## 2.5 Zum Raspberry-PI verbinden

Wenn PC, Router und Raspberry-PI nun laufen und das Internet an ist, kann der Raspberry-PI eingerichtet werden.

1. Ein neues Konsolenfenster (CMD auf Windows oder Terminal auf Mac/Linux) auf dem PC öffnen (falls bereits eins für die Studnet-Verbindung offen ist, dieses nicht schließen).
2. Folgenden Befehl eingeben (auf das `@` in der Mitte achten):
   ```
   ssh XXXXX@YYYYY
   ```
   Wobei `XXXXX` durch den Benutzernamen aus Punkt 9 in Abschnitt `2.1` zu ersetzen ist und `YYYYY` durch den Hostnamen aus Punkt 8 in Abschnitt `2.1`.
   Dann `ENTER`
3. Möglicherweise taucht daraufhin eine Abfrage auf. Diese mit `yes` beantworten und mit `ENTER` bestätigen.
4. Es erscheint eine Passwort-Abfrage. Hier das Passwort aus Punkt 9 in Abschnitt `2.1` eingeben. **Achtung**: eingegebene Zeichen werden nicht angezeigt. Das Passwort muss blind eingegeben und mit `ENTER` bestätigt werden.
5. Bei erfolgreicher Passworteingabe ist man nun mit der Konsole des Raspberry-PI verbunden.

## 2.6 Raspberry-PI konfigurieren

In der verbundenen Konsole zum Raspberry-PI sollten nun die folgenden Befehle ausgeführt werden. (**Achtung**: wenn ein Fehler erscheint ähnlich wie `sudo nicht gefunden`, dann das Wort `sudo` einfach aus den Befehlen weglassen).

1. `sudo apt-get -y update`
2. `sudo apt-get -y upgrade`
3. `sudo apt-get install -y nano apache2 php screen sshpass unzip git`

Nun wird mit dem terminalbasierten Texteditor `nano` eine Datei bearbeitet. In dem Textbereich kann man mit den Pfeiltasten navigieren und ganz normal den Text bearbeiten. Die Maus funktioniert hier nicht.

Die Datei wird geöffnet mit dem Befehl:
```
sudo nano /etc/apache2/sites-available/000-default.conf
```

Mit den Pfeiltasten ganz nach unten navigieren bis zu der folgenden Zeile (fast am Ende der Datei):
```
</VirtualHost>
```

Vor diese Zeile müssen nun die folgenden Dinge geschrieben werden, sodass das Ende der Datei so aussieht:
```
    <Directory /var/www/html>
        AllowOverride All
    </Directory>
</VirtualHost>
```

Die Datei muss nun gespeichert und der Editor geschlossen werden mit den folgenden Tastenkombinationen:
1. `STRG+X`
2. `Y`
3. `ENTER`

Falls in der Datei versehentliche Änderungen passiert sind, die nicht mehr umkehrbar sind, dann hilft die Tastenkombination
1. `STRG+X`
2. `N`

, welche die Bearbeitung abbricht ohne zu speichern.

Dann sieht man wieder die normale Kommandozeile in der noch der folgende Befehl auszuführen ist:
```
sudo service apache2 restart
```

Schließlich den folgenden Befehl ausführen:
```
git clone https://github.com/Yonkus/studnet4everyone.git /var/www/html/internet
```

Fast geschafft. Nun muss nur noch die Seite konfiguriert werden mit der das Internet an- und ausgeschaltet wird. Dazu wieder mit dem Texteditor `nano` eine Datei bearbeiten:
```
nano /var/www/html/internet/config.json
```

Der Inhalt der Datei sollte dann so aussehen:
```
{
    "mieternummer": "deine-mieternummer",
    "mieterpasswort": "dein-mieterpasswort",
    "studnethost": "139.18.143.253",
    "adminpasswort": "admin"
}
```

Hier die Platzhalter `deine-mieternummer` und `dein-mieterpasswort` durch die Mieternummer und das Passwort auf dem Zettel vom Studentenwohnheim ersetzen. Es empfiehlt sich das Admin-Passwort von `admin` auf ein selbst gewähltes Passwort zu ändern. Dieses muss dann später beim Ein- und Ausschalten des Internets angegeben werden (also sollte man sich dieses gut merken).

Anschließend den Texteditor wieder mit den drei Schritten `STRG+X`, `Y` und `ENTER` schließen und das Terminal ebenfalls schließen (oder mit dem Kommando `exit` beenden).

## 2.7 Ausprobieren

Nun ist das Setup fertig eingerichtet. Das Internet über den Studnet-Client oder das laufende Terminal kann nun gänzlich beendet und geschlossen werden.

Von nun an kann das Internet nun folgendermaßen angeschaltet werden:
1. WLAN-Router und Raspberry-PI müssen laufen und wie zuvor beschrieben verkabelt sein.
2. Das Handy muss mit dem WLan verbunden sein (auch wenn es eine Warnung gibt, dass kein Internetzugriff besteht)
3. Über den Browser des Handys die folgende URL aufrufen:
   ```
   XXXXX.local/internet/index.php
   ```
   wobei `XXXXX` durch den in Punkt 8 in Abschnitt `2.1` vergebenen Hostnamen ersetzt werden muss
4. Es erscheint eine einfache hässliche Seite mit einem Eingabefeld und einem Button. Das sieht dann etwa so aus:

![aSDASDAS](/screenshot.png)

In das Eingabefeld kommt das Passwort aus der `config.json` (ehemals `admin`) und mit dem Button wird die Eingabe bestätigt. Dann sollte eine Nachricht zu sehen sein, dass das Internet an ist. Sie Seite kann nun geschlossen werden und alle Geräte, die mit dem WLAN verbunden sind haben nun Internetzugang.

Auf diese Weise kann das Internet auch wieder ausgeschaltet werden (also ins WLan einwählen, Seite aufrufen, Passwort eingeben und bestätigen).

# 3. FAQ

### Wozu brauche ich diese Seite?
Mit dieser Seite, welche über alle Geräte erreichbar ist, die mit dem WLan verbunden sind, kann das Internet an- oder ausgeschaltet werden. Wenn mal der Router oder Raspberry-PI ausgeschaltet werden (z.B. wegen Stromausfall) oder das Internet im gesamten Wohnheim ausfällt, dann muss das Internet über diese Seite über den in `2.7` genannten Prozess (neu) gestartet werden. Und evtl. auch mal an- und ausgeschaltet werden bei Internetproblemen.

### Welche Geräte müssen laufen, damit das Internet verfügbar ist?
Nur der Router und der Raspberry-PI. Alle anderen Geräte, wie Handy, Tablet und PC müssen dafür nicht mehr an sein. Nur für das einmalige Anschalten des Internets über die in `2.9` genannte Seite wird eines dieser Geräte benötigt. Selbst die Seite kann nach dem Anmachen geschlossen werden.

### Auf der Seite steht "INTERNET AN". Wie kann ich nun das Internet nutzen?
Verbinde dich mit dem Gerät deiner Art zum WLan, gib das WLan-Passwort ein (nicht das aus der `config.json`, ehemals `admin`. Sondern das Passwort auf der Rückseite des Routers) und fertig.

### Wo bekomme ich die Geräte her?
Den Raspberry-PI bekommt man über Amazon oder gebraucht auch oft auf auf Ebay Kleinanzeigen. Die restlichen Dinge sind mit einem Gang zum Saturn erledigt.

### Mache ich mich mit diesem Setup angreifbar?
Das ist ein Hobby-Projekt und kann eine bequeme Hilfe im Wohnheim-Alltag sein, aber die Sicherheit steht hier nicht an erster Stelle, da das den Setup-Prozess deutlich verlängern wurde. Allerdings bilden sich durch dieses Setup auch keine signifikanten Sicherheitslücken. Das WLan funktioniert so sicher wie jedes andere WLan auch. Allein die Seite zum Ein- und Ausschalten des Internets ist nicht wirklich abgesichert, da diese nicht verschlüsselt ist. Solange aber kein böswilliger Benutzer in dein WLan eingewählt ist (wofür er erstmal den WLan-Key braucht) und deinen unverschlüsselten Netzwerkverkehr mitliest sollte niemand im Stande sein dein Internet unbefugt an- und auszustellen.

### Was wenn etwas nicht funktioniert?
Wende dich an den Informatiker deines Vertrauens und zeig ihm diese Seite oder an die Wohnheimgruppe. Ich, der Ersteller dieses Projektes, und ein paar andere Leute, die dieses Setup auch schon erhalten haben, helfen auch gern bei der Einrichtung.
