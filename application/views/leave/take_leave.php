<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/error.css'); ?>" type="text/css">
<!-- Add_Report_Start -->
<div class="pr-4 pl-4 Edit_Project_Form">
	<div class="container">
		<div class="row pt-1 pb-2">
			<div class="col-lg-6">
				<a class="" style=""></a><span class="Page_Title">Take Leave</span>
			</div>
			<div class="col-lg-6">
				<a href="<?= base_url('leave'); ?>" class="btn user_invait_btn btn-sm float-right">+ Back to Leaves</a>
			</div>
		</div>
		<?php if ($this->session->flashdata("errorrleave")) { ?>
			<div class="alert alert-primary alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?= $this->session->flashdata("errorrleave") ?>
			</div>
		<?php } ?>
		<!-- secod_Row_Start -->
		<form action="<?= base_url('leave/take_new_leave') ?>" method="post" id="validate_form">
			<div class="row pt-3">
				<div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">

					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>From Date</label>
								<input type="text" class="form-control form-control-sm datepicker" name="from_date" required placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY" />
								<span><?= form_error('startDate') ?></span>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>To Date</label>
								<input type="text" class="form-control form-control-sm datepicker" name="to_date" required placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY" />
								<span><?= form_error('startDate') ?></span>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Number of leave days</label>
								<input type="number" class="form-control form-control-sm" name="leave_days" required data-parsley-trigger="keyup" data-parsley-type="number" data-parsley-required-message="Write your number of leave days here">
								<span><?= form_error('startDate') ?></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Leave Type</label>
								<select name="type" id="" class="form-control">
									<option value="with_pay">With Pay</option>
									<option value="without_pay">Without Pay</option>
								</select>
							</div>
						</div>
					</div>
					<!-- add -->
					<div class="row pt-4 ">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Reason of leave</label>
								<textarea class="form-control" name="reason" required data-parsley-required-message="Type your reason here."></textarea>
								<span><?= form_error('editor1[]') ?></span>
							</div>
						</div>
					</div>
					<!-- add -->
					<div class="row pt-4">

						<div class="col-lg-12 text-right">
							<input type="submit" name="submit" value="submit" class="btn user_invait_btn btn-sm" id="TL">
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- secod_Row_End -->
	</div>
</div>
<!--Add_Report_End-->
<script type="text/javascript">
	$('input[name=to_date],input[name=from_date]').change(function() {

		var from = $('input[name=from_date]').datepicker('getDate');
		var to = $('input[name=to_date]').datepicker('getDate');
		var oneDay = 24 * 60 * 60 * 1000;
		var diffDays = Math.abs((from.getTime() - to.getTime()) / (oneDay));
		var r = diffDays + 1;
		$('input[name=leave_days]').val(r);

	});
</script>