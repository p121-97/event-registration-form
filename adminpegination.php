<?php
    include_once "header.php";
	include_once("db.php");
	
	$showRecordPerPage = 5;
	if(isset($_GET['page']) && !empty($_GET['page'])){
		$currentPage = $_GET['page'];
	}else{
		$currentPage = 1;
	}
	$startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
	$totalSQL = "SELECT * FROM member";
	$allmemResult = mysqli_query($conn, $totalSQL);
	$totalmembers = mysqli_num_rows($allmemResult);
	$lastPage = ceil($totalmembers/$showRecordPerPage);
	$firstPage = 1;
	$nextPage = $currentPage + 1;
	$previousPage = $currentPage - 1;
	$userSQL = "SELECT first_name,last_name,display_name,phone_number,email
	FROM `member` LIMIT $startFrom, $showRecordPerPage";
	$userResult = mysqli_query($conn, $userSQL);		
	?>
	
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

</head>
<body>

<div class="jumbotron">
	<div class="alert alert-success" role="alert">
		<?php echo "Users list"  ?>

 <table id="editableTable" class="table ">


	<thead> 


		<tr> 
		
			<th>First Name</th> 
			<th>Last Name</th>
			<th>display name</th> 
      <th>Phone Number</th>
      <th>email</th>
	 
		</tr> 
	</thead> 
	<tbody> 
		
		<?php 
		while($mem = mysqli_fetch_assoc($userResult)){
		?>
		<tr> 
		<th scope="row"><?php echo $mem['first_name']; ?></th> 
		<td><?php echo $mem['last_name']; ?></td> 
		<td><?php echo $mem['display_name']; ?></td> 
        <td><?php echo $mem['phone_number']; ?></td> 
        <td><?php echo $mem['email']; ?></td> 
		<td>
		<a class='btn btn-promary btn-sm' href="/"> Edit</a>
		<a class='btn btn-promary btn-sm' href="/"> Delete</a>
		</td>

			</tr> 
		<?php } ?>


		<div class="btn-group pull-right">
	<button type="button" class="btn btn-primary btn" > Export </button>
</div>
	</tbody> 
	</table>

  <nav aria-label="Page navigation">
	  <ul class="pagination">
	  <?php if($currentPage != $firstPage) { ?>
		<li class="page-item">
		  <a class="page-link" href="?page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous">
			<span aria-hidden="true">First</span>			
		  </a>
		</li>
		<?php } ?>
		<?php if($currentPage >= 2) { ?>
			<li class="page-item"><a class="page-link" href="?page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a></li>
		<?php } ?>
		<li class="page-item active"><a class="page-link" href="?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a></li>
		<?php if($currentPage != $lastPage) { ?>
			<li class="page-item"><a class="page-link" href="?page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a></li>
			<li class="page-item">
			  <a class="page-link" href="?page=<?php echo $lastPage ?>" aria-label="Next">
				<span aria-hidden="true">Last</span>
        </a>
			</li>
		<?php } ?>
	  </ul>
	</nav>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="tableExport/tableExport.js"></script>
<script type="text/javascript" src="tableExport/jquery.base64.js"></script>
<script src="js/export.js"></script>
<script src="js/edittable.js"></script>
<script src="js/exporttable.js"></script>



		</body>
		</html> 							
<?php
include_once "footer.php";
?>