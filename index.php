<?php 
// session_start(); // No longer needed if login isn't required

include "DB_connection.php";
include "app/Model/Task.php";
include "app/Model/User.php";

// Define dummy values (or hardcode "admin" to show admin dashboard)
$role = "admin"; // or "employee"
$user_id = 1;    // example user ID if needed for tasks

if ($role == "admin") {
    $todaydue_task = count_tasks_due_today($conn);
    $overdue_task = count_tasks_overdue($conn);
    $nodeadline_task = count_tasks_NoDeadline($conn);
    $num_task = count_tasks($conn);
    $num_users = count_users($conn);
    $pending = count_pending_tasks($conn);
    $in_progress = count_in_progress_tasks($conn);
    $completed = count_completed_tasks($conn);
} else {
    $num_my_task = count_my_tasks($conn, $user_id);
    $overdue_task = count_my_tasks_overdue($conn, $user_id);
    $nodeadline_task = count_my_tasks_NoDeadline($conn, $user_id);
    $pending = count_my_pending_tasks($conn, $user_id);
    $in_progress = count_my_in_progress_tasks($conn, $user_id);
    $completed = count_my_completed_tasks($conn, $user_id);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
			<?php if ($role == "admin") { ?>
				<div class="dashboard">
					<div class="dashboard-item"><i class="fa fa-users"></i><span><?=$num_users?> Employee</span></div>
					<div class="dashboard-item"><i class="fa fa-tasks"></i><span><?=$num_task?> All Tasks</span></div>
					<div class="dashboard-item"><i class="fa fa-window-close-o"></i><span><?=$overdue_task?> Overdue</span></div>
					<div class="dashboard-item"><i class="fa fa-clock-o"></i><span><?=$nodeadline_task?> No Deadline</span></div>
					<div class="dashboard-item"><i class="fa fa-exclamation-triangle"></i><span><?=$todaydue_task?> Due Today</span></div>
					<div class="dashboard-item"><i class="fa fa-bell"></i><span><?=$overdue_task?> Notifications</span></div>
					<div class="dashboard-item"><i class="fa fa-square-o"></i><span><?=$pending?> Pending</span></div>
					<div class="dashboard-item"><i class="fa fa-spinner"></i><span><?=$in_progress?> In progress</span></div>
					<div class="dashboard-item"><i class="fa fa-check-square-o"></i><span><?=$completed?> Completed</span></div>
				</div>
			<?php } else { ?>
				<div class="dashboard">
					<div class="dashboard-item"><i class="fa fa-tasks"></i><span><?=$num_my_task?> My Tasks</span></div>
					<div class="dashboard-item"><i class="fa fa-window-close-o"></i><span><?=$overdue_task?> Overdue</span></div>
					<div class="dashboard-item"><i class="fa fa-clock-o"></i><span><?=$nodeadline_task?> No Deadline</span></div>
					<div class="dashboard-item"><i class="fa fa-square-o"></i><span><?=$pending?> Pending</span></div>
					<div class="dashboard-item"><i class="fa fa-spinner"></i><span><?=$in_progress?> In progress</span></div>
					<div class="dashboard-item"><i class="fa fa-check-square-o"></i><span><?=$completed?> Completed</span></div>
				</div>
			<?php } ?>
		</section>
	</div>
	<script type="text/javascript">
		var active = document.querySelector("#navList li:nth-child(1)");
		active.classList.add("active");
	</script>
</body>
</html>
