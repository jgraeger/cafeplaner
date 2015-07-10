<?php echo $this->element('actions',$actions);
?>
 <script>
$(function() {
$( "#datepickerFrom" ).datepicker({ 
	dateFormat: "dd. mm. yy",
	firstDay: 1,
	changeYear: true,
	yearRange: "2008:nnnn",
    maxDate: 0,
    showButtonPanel: false,
    dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
    dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
    monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai',
      'Juni', 'Juli', 'August', 'September', 'Oktober',  'November', 'Dezember'],
    showAnim: 'blind' 
		});
$( "#datepickerTo"   ).datepicker({ 
	dateFormat: "dd. mm. yy",
	firstDay: 1,
	changeYear: true,
	yearRange: "2008:nnnn",
    maxDate: 0,
    showButtonPanel: false,
    dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
    dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
    monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai',
      'Juni', 'Juli', 'August', 'September', 'Oktober',  'November', 'Dezember'],
    showAnim: 'blind'
		});

});
</script>
<?php 
echo "<div id='StatisticIntervalFormDiv' style='display:none;'>";
echo $this->Form->create('Date', array('id' => 'StatisticIntervalForm', 'url' => array('controller' => 'statistic', 'action' => 'interval'), 'type' => 'post'));
echo $this->Form->input('dateFrom', array('label' => array('text' => 'vom'), 'id' => 'datepickerFrom', 'required' => 'required'));
echo $this->Form->input('dateTo', array('label' => array('text' => 'bis zum'), 'id' => 'datepickerTo', 'required' => 'required'));
echo $this->Form->end('Statistik erstellen');
echo "</div>";
?>

<h2><?php echo $pageTitle; ?></h2>

<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered" id="contactlist">
		<tr>
			<th>Name</th>
			<th>Halbe Schichten</th>
			<th>Ganze Schichten</th>
			<th>Gesamt</th>
		</tr>
		<?php 
			foreach($data as $user) {
				echo "<tr>";
				echo "<td>".$user['username'];
				if (!$user['active']) echo " <i>(inaktiv)</i>";
				echo "</td>";
				echo "<td>".$user['H']."</td>";
				echo "<td>".$user['G']."</td>";
				if ($user['ges'] == 0) echo "<td style='color:red;'>0</td>";
				else echo "<td>".$user['ges']."</td>";
				echo "</tr>";
			}
		?>
</table>

</div>
