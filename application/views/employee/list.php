<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" />
		<base href="<?php echo base_url(); ?>">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Employee list - jQuery DataTable</title>
		
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<!--  Datatable -->
		<link href="<?php echo base_url();?>/assets/css/jquery.dataTables.css" rel="stylesheet">
		<link href="<?php echo base_url();?>/assets/css/dataTables.fixedHeader.css" rel="stylesheet">
		<link href="<?php echo base_url();?>/assets/css/dataTables.responsive.css" rel="stylesheet">

		<script src="<?php echo base_url();?>/assets/js/jquery.dataTables.js"></script>
		<script src="<?php echo base_url();?>/assets/js/dataTables.fixedHeader.js"></script>
		<script src="<?php echo base_url();?>/assets/js/dataTables.responsive.js"></script>
	</head>
	<body>
		<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">
							Employee List
						</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12" id="empList">
						<table class="display" cellspacing="0" width="100%" id="custom_report_table">
							<thead>
								<tr>
									<th><?php echo lang("emp_id"); ?></th>
									<th><?php echo lang("employee_number"); ?></th>
									<th><?php echo lang("employee_name"); ?></th>
									<th><?php echo lang("employee_joining_date"); ?></th>
									<th><?php echo lang("action"); ?></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			var table;

			$(document).ready(function () {

				var table = $('#custom_report_table').DataTable({
					"dom": '<"top"f>rt<"bottom"ilp>rb<"clear">',
					"responsive": true,
					"bFilter": false,
					"processing": true,
					"serverSide": true,
					"pageLength": 50,
					"columns": [
						{'data': 'employee_id', 'orderable': false},
						{'data': 'employee_number', 'orderable': false},
						{'data': 'employee_name', 'orderable': false},
						{'data': 'employee_joining_date', 'orderable': false, "className": "dt-center"},
						{'data': 'action', 'orderable': false, "className": "dt-center"},
					],
					"ajax": {
						url: getAjaxURL(),
						type: "get",
						error: function () {
							$(".custom_report_table_error").html("");
							$("#custom_report_table").append('<tbody class="custom_report_table_error"><tr><th colspan="5">No data found in the server</th></tr></tbody>');
							$("#custom_report_table_processing").css("display", "none");
						}
					}
				});

				//trigger filter
				
				//$('#btn_filter').click(function () {
					//table.ajax.url(getAjaxURL()).load();
				//});
				
			});

			function getAjaxURL() {
				var ajax_url = '<?php echo base_url(); ?>employee/getEmployeesList';
				// ajax_url = ajax_url + '?PAYCYCLES=' + $('#PAYCYCLES').val();

				return ajax_url;
			}
		</script>
		
		
	</body>
</html>