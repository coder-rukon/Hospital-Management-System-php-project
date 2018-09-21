
<?php 
if($appoinments): 
	foreach ($appoinments as $key => $appoinment):
	$cssClass = "alert-success";
	if($appoinment->status == "pending")
		$cssClass = "alert-success";
	$doctor = get_doctors(array('id' => $appoinment->doctor_id));
	$schedule = get_schedule(array('id' => $appoinment->schedule_id));
	if(!isset($doctor[0]) || !isset($schedule[0]))
		continue;
	$doctor = $doctor[0];
	$schedule = $schedule[0];

?>
	<div class="alert <?php echo $cssClass; ?> alert-dismissible fade in" role="alert">
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="profile_img">
					<div id="crop-avatar">
						<img class="img-responsive avatar-view" src="<?php echo $doctor->picture; ?>" alt="Avatar" title="Change the avatar">
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-8">
				<table class="table">
					<tr>
						<td><strong>Doctor Name:</strong></td>
						<td><?php echo $doctor->name; ?></td>
					</tr>
					<tr>
						<td><strong>Depertment:</strong></td>
						<td><?php echo get_department(array("id" =>$doctor->department))[0]->name; ?></td>
					</tr>
					<tr>
						<td><strong>Doctor Email:</strong></td>
						<td><?php echo $doctor->email; ?></td>
					</tr>
					<tr>
						<td><strong>Date:</strong></td>
						<td><?php echo $appoinment->date; ?></td>
					</tr>
					<tr>
						<td><strong>Time:</strong></td>
						<td><?php echo $schedule->start_time.' - '.$schedule->end_time; ?></td>
					</tr>
					<tr>
						<td><strong>Serial No:</strong></td>
						<td><?php echo $appoinment->serial_no; ?></td>
					</tr>
					<tr>
						<td><strong>Appoinment id:</strong></td>
						<td><?php echo $appoinment->id; ?></td>
					</tr>
					<tr>
						<td><strong>Details/Patient message</strong></td>
						<td><?php echo $appoinment->details; ?></td>
					</tr>
					<tr>
						<td><strong>Prescription</strong></td>
						<td><?php echo $appoinment->prescription; ?></td>
					</tr>
				</table>
				<a href="<?php echo base_url().'page/appoinmentsDelete/'.$appoinment->id; ?>" class="btn btn-danger">Delete Appoinment</a>
			</div>

		</div>
	</div>
<?php 
	endforeach;
else:
?>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
	</button>
	<strong>No Appoinment found</strong>
</div>
<?php
endif; 
?>