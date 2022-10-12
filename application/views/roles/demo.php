  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
  <style>
  	.grr{
      	background-color:#1CC88A!important;
 	}
  	.rdd{
      	background-color:red!important;
  	}
  	.on{
	  	color:whitesmoke!important;
	  	/*font-size: 100px;*/
	  	transform: translateX(27px)!important;
	  	transition: 0.9s ease-in-out!important;
	  	cursor: pointer!important;
  	}
  	.off{
	  	color: whitesmoke!important;
	  	transform: translateX(0px)!important;
	  	transition: 0.9s ease-in-out!important;
	  	cursor: pointer!important;
 	}
	.on:hover{transition: 0.9s ease-in-out!important;}
	.off:hover{transition: 0.9s ease-in-out!important;}
	.chn{background-color: red ;border: none;width: 60%;border-radius: 30px!important;}

  	input[name='label[]']
	{
	 	border:none!important;
		background:none!important;
	}
	input[name='label[]']:focus{
	  	outline: none!important;
	}

</style>
<!-- Invite_User_Start -->
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a><span class="Page_Title">Create Role</span>
                        </div>
                        <div class="col-lg-6">
                             <a href="<?=base_url('roles'); ?>" class="btn user_invait_btn float-right">+ All Roles</a>
                        </div>
                    </div>
                    <!-- secod_Row_Start -->
                    <form action="<?=base_url('roles/add')?>" method="post" id="validate_form"> 
	                    <div class="row pt-5">
		                    <div class="col-lg-10 m-auto card pt-3 pb-3" style="border:none">
		                        <div class="row">
			                      	<div class="col-lg-10 m-auto">
				                        <div class="form-group">
				                          <label>Role Name</label>
				                          <input type="text" class="form-control form-control-sm" name="roll_name" required data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters." >
				                          <span><?=form_error('category');?></span>  
				                        </div>
				                    </div>
			                    </div>
			                    <div class="row">
			                      	<div class="col-lg-10 m-auto">
				                        <table class="table">
				                        	<tr>
				                        		<th>Name</th>
				                        		<th>Show</th>
				                        		<th>Add</th>
				                        		<th>Edit</th>
				                        		<th>Delete</th>
				                        		<th>Parent Show</th>
				                        	</tr>
				                        	<tr>
												<td>Categories</td>	
												<td width="19%">
													<input type="text" name="label[]" value="cat_show" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="cat_add" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="cat_edit" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="cat_del" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td>-</td>
											</tr>	
											<tr>
												<td>Users</td>	
												<td width="19%">
													<input type="text" name="label[]" value="users_show" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="users_add" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="users_edit" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="users_del" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td>-</td>
											</tr>	
											<tr>
												<td>Projects</td>	
												<td width="19%">
													<input type="text" name="label[]" value="proj_show" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="proj_add" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="proj_edit" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="proj_del" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="proj_p_show" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
											</tr>
											<tr>
												<td>Tasks</td>
												<td width="19%">
													<input type="text" name="label[]" value="task_show" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="task_add" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="task_edit" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="task_del" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="task_p_show" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
											</tr>
											<tr>
												<td>Subtasks</td>	
												<td width="19%">
													<input type="text" name="label[]" value="subtask_show" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="subtask_add" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="subtask_edit" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="subtask_del" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="subtask_p_show" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
											</tr>
										</table>
										<table class="table">
											<tr>
				                        		<th>Name</th>
				                        		<th>Show</th>
				                        		<th>Add</th>
				                        		<th>Edit</th>
				                        		<th>Delete</th>
				                        		<th>Parent Show</th>
				                        	</tr>	
											<tr>
												<td>Reports</td>	
												<td width="19%">
													<input type="text" name="label[]" value="rep_show" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="rep_add" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="rep_edit" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="rep_del" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td>-</td>
											</tr>
											<tr>
												<td>Leaves</td>	
												<td width="19%">
													<input type="text" name="label[]" value="leave_show" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="leave_add" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="leave_edit" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
													<input type="text" name="label[]" value="leave_del" hidden>
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td>-</td>
											</tr>	
											<tr>
												<td><input type="text" name="label[]" value="Roles" readonly></td>	
												<td width="19%">
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
												<td width="19%">
												    <div class="chn rdd">
								                        <div class="deal off" data="">
								                            <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
								                        </div>
								                    </div>
								                    <div class="ranking">
												        <input type="text" name="rank[]" value="0" hidden/>
												     </div>
												</td>
											</tr>			
				                        </table>
				                    </div>
			                    </div>
			                    <div class="row pt-4">
			                      <div class="col-lg-10 m-auto">
			                        <input type="submit" name="submit" value="Add" class="btn user_invait_btn">
			                      </div>
			                    </div>
		                    </div>
	                    </div>
                    </form>
                    <!-- secod_Row_End -->
                </div>
            </div>
            <!--Invite_User_End-->
<script type="text/javascript">
	
	$('.deal').on('click',function(){
			var id=$(this).attr('data');
		    if($(this).hasClass("on"))
            {
              $(this).removeClass("on");
              $(this).addClass("off");
              $(this).closest(".chn").removeClass("grr");
              $(this).closest(".chn").addClass("rdd");
           	  var deal='0';
            }
            else
            {
              $(this).removeClass("off");
              $(this).addClass("on");
              $(this).closest('.chn').removeClass("rdd");
              $(this).closest('.chn').addClass("grr");
              var deal='1';
            }
            $(this).closest("td").find("input[name='rank[]']").val(deal);
		});
</script>