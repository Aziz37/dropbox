<!DOCTYPE html>
<html>
	<head>
		<script src="//code.jquery.com/jquery-1.12.3.js"></script>
		<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
	</head>
	<body>
		<table class="table" id="table">
		    <thead>
		        <tr>
		            <th class="text-center">#</th>
		            <th class="text-center">Name</th>
		            <th class="text-center">Email</th>
		            <th class="text-center">Department</th>
		            <th class="text-center">Created At</th>
		            <th class="text-center">Updated At</th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr>
		            <td></td>
		            <td></td>
		            <td></td>
		            <td></td>
		            <td></td>
		            <td></td>
		        </tr>
		    </tbody>
		</table>

		<script>
		  $(document).ready(function() {
		    	$('#table').DataTable();
			});
		 </script>
	</body>
</html>