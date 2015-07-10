<?php echo $this->element('actions',array(
	'actions' => $actions));
?>
<h2><?php echo 'Datenbank-Verwaltung'; ?></h2>

<p>
Hier können Sie die Datenbank des Cafeteria-Plans verwalten.
</p>
<p>
Grundsätzlich ist es leider immer möglich, dass Daten aufgrund eines technischen Defekts
teilweise oder auch komplett verloren gehen können.<br />
Daher wird empfohlen, dass Sie in regelmäßigen Abständen (z. B. jeden Monat)
eine Sicherung des Plans vorzunehmen.<br />
Um eine Sicherung durchzuführen, klicken Sie in der Seitenleiste auf "Sicherung durchführen"
und speichern Sie die Sicherungsdatei auf Ihrem Computer.<br />
Gesichert werden dabei vorhandenen sämtliche Daten (Benutzer, Plan, Spalten, Änderungsliste).
</p>
<p>
Um den Zustand des Plans zu einem früheren Punkt wiederherzustellen,
wählen Sie bitte die entsprechende Sicherungsdatei aus und klicken auf "Wiederherstellen".
Bitte beachten Sie, dass dabei auch Benutzerdaten wie Passwörter zurückgesetzt werden. 
</p>

<br />
<?php include('import.ctp'); ?>

</div>