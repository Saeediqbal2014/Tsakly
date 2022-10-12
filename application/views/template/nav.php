<style type="text/css">
    .dropdown-menu {
        width: 300px !important;
    }
</style>

<div class="wrapper">

    <!-- Sidebar  -->
    <nav id="sidebar" class="Bg_Color">
        <div class="sidebar-header Font_Color">
            <!-- <span class="mb-0 mt-0"> -->
            <a class="Logo_Full ">
                <img class="m-auto" src="<?= base_url('asset/img/logo-full.png'); ?>" width="50%" style="">
            </a>
            <!-- </span> -->
            <!-- <b> -->
            <a class="Logo">

                <img src="<?= base_url('asset/img/logo.png'); ?>" width="50%" style="">
            </a>
            <!-- </b> -->
        </div>

        <ul class="list-unstyled components Font_Color">
            <li class="active">
                <a href="<?= base_url('Dashboard'); ?>">
                    <div>
                        <i class="fas fa-home Nav_Icon"></i>
                        <?php //echo $this->session->userdata('user'); 
                        ?>
                        <span>Dashboard</span>
                    </div>
                </a>
                <!--   <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul> -->
            </li>
            <?php
            if ($this->session->userdata('user') == 1 || $this->session->userdata('tran_show') == 1 || $this->session->userdata('group_show') == 1 || $this->session->userdata('subgroup_show') == 1) {
            ?>
                <li>
                    <a href="#accounts_menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div>
                            <i class="fas fa-id-card-alt Nav_Icon"></i>
                            <span class="">Accounts</span>
                        </div>
                    </a>
                    <ul class="collapse list-unstyled" id="accounts_menu">
                        <?php
                        if ($this->session->userdata('user') == 1 || $this->session->userdata('group_show') == 1) {
                        ?>
                            <li>
                                <a href="<?= base_url('Groups') ?>">Groups</a>
                            </li>

                        <?php }
                        if ($this->session->userdata('user') == 1 || $this->session->userdata('subgroup_show') == 1) {
                        ?>
                            <li>
                                <a href="<?= base_url('Groups/subgroup') ?>">Sub Groups</a>
                            </li>
                        <?php }
                        if ($this->session->userdata('user') == 1 || $this->session->userdata('tran_show') == 1) {
                        ?>
                            <li>
                                <a href="<?= base_url('Transactions') ?>">Transactions</a>
                            </li>
                        <?php }
                        ?>
                    </ul>
                </li>
            <?php
            }
            if ($this->session->userdata('user') == 1 || $this->session->userdata('cat_create') == 1 || $this->session->userdata('cat_show') == 1) {
            ?>
                <li>
                    <a href="<?= base_url('categories'); ?>">
                        <i class="fas fa-certificate Nav_Icon "></i>
                        <span class="">Category</span>
                    </a>
                </li>
            <?php
            }
            if ($this->session->userdata('user') == 1 || $this->session->userdata('user_create') == 1 || $this->session->userdata('user_show') == 1) {
            ?>
                <li>
                    <a href="<?= base_url('users'); ?>">
                        <i class="fas fa-users Nav_Icon"></i>
                        <span>User</span>
                    </a>
                </li>
            <?php
            }
            if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_create') == 1 || $this->session->userdata('proj_show') == 1 || $this->session->userdata('proj_p_show') == 1) {
            ?>
                <li>
                    <a href="<?= base_url('projects') ?>">
                        <i class="fas fa-project-diagram Nav_Icon"></i>
                        <span>Projects</span>
                    </a>
                    <!-- Drop down -->
                    <!--  <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy Nav_Icon"></i>
                        <span>Users</span>
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul> -->
                </li>
            <?php }
            if ($this->session->userdata('user') == 1 || $this->session->userdata('quot_create') == 1 || $this->session->userdata('quot_show') == 1 || $this->session->userdata('quot_p_show') == 1) {
            ?>
                <li>
                    <a href="<?= base_url('quotation') ?>">
                        <i class="fas fa-project-diagram Nav_Icon"></i>
                        <span>Quotation</span>
                    </a>

                </li>
            <?php } ?>
            <!--  <li>
                    <a href="#">
                        <i class="fas fa-image Nav_Icon"></i>
                        <span>Clients</span>
                    </a>
                </li> -->
            <li>

                <!-- Drop down -->
                <a href="#calendarSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-calendar-alt Nav_Icon"></i>
                    <span>Calendar</span>
                </a>
                <ul class="collapse list-unstyled" id="calendarSubmenu">
                    <!-- <li>
                        <a href="<= base_url('reports') ?>">Old</a>
                    </li> -->
                    <li>
                        <a href="<?= base_url('events_calendar'); ?>">Events</a>
                    </li>
                    <li>
                        <a href="<?= base_url('tasks_calendar'); ?>">Task</a>
                    </li>
                    <li>
                        <a href="<?= base_url('subtasks_calendar'); ?>">Subtask</a>
                    </li>

                </ul>
            </li>
            <?php if ($this->session->userdata('task_show') == 1) { ?>
                <li>
                    <a href="<?= base_url('tasks'); ?>">
                        <i style="margin-left: 11px;" class="fas fa-project-diagram "></i>
                        <span style="margin-left: 15px;">Tasks</span>
                    </a>
                </li>
            <?php } ?>


            <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('report_show') == 1 || $this->session->userdata('report_p_show') == 1 || $this->session->userdata('report_create') == 1 || $this->session->userdata('report_wh') == 1 || $this->session->userdata('report_search') == 1) { ?>
                <li>

                    <!-- Drop down -->
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-sticky-note Nav_Icon"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <!-- <li>
                            <a href="<= base_url('reports') ?>">Old</a>
                        </li> -->
                        <li>
                            <a href="<?= base_url('reports/project_reports') ?>">Project Report</a>
                        </li>
                        <li>
                            <a href="<?= base_url('reports/task_reports') ?>">Task Report</a>
                        </li>
                        <li>
                            <a href="<?= base_url('reports/transaction') ?>">

                                Transaction Report
                            </a>
                        </li>

                    </ul>
                </li>
            <?php }
            if ($this->session->userdata('user') == 1 || $this->session->userdata('leave_show') == 1 || $this->session->userdata('leave_p_show') == 1 || $this->session->userdata('leave_add') == 1 || $this->session->userdata('leave_r_show') == 1) {
            ?>
                <!-- Drop down -->
                <li>
                    <a href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-american-sign-language-interpreting Nav_Icon"></i>
                        <span>Leave</span>
                    </a>
                    <ul class="collapse list-unstyled" id="leaveSubmenu">
                        <?php
                        if ($this->session->userdata('user') == 1 || $this->session->userdata('leave_add') == 1) {
                        ?>
                            <li>
                                <a href="<?= base_url('leave/take_leave') ?>">Take Leave</a>
                            </li>
                        <?php
                        }
                        if ($this->session->userdata('user') == 1 || $this->session->userdata('leave_show') == 1 || $this->session->userdata('leave_p_show') == 1 || $this->session->userdata('leave_r_show') == 1) {
                        ?>
                            <li>
                                <a href="<?= base_url('leave') ?>">Leaves</a>
                            </li>
                        <?php } ?>

                    </ul>
                </li>

            <?php
            }
            if ($this->session->userdata('user') == 1) { ?>
                <li>
                    <a href="<?= base_url('roles'); ?>">
                        <i class="fas fa-users-cog Nav_Icon"></i>
                        <span>Roles</span>
                    </a>
                </li>
                <!-- <php }
                if ($this->session->userdata('user') == 1 || $this->session->userdata('attendance_show') == 1 || $this->session->userdata('attendance_p_show') == 1) { ?>
                 <li>
                     <a href="<= base_url('Attendance'); ?>">
                         <i class="fas fa-calendar-alt Nav_Icon"></i>
                         <span>Attendance</span>
                     </a>
                 </li>
             ?php } ?> -->
            <?php }

            if ($this->session->userdata('user') == 1 || $this->session->userdata('log_show') == 1 || $this->session->userdata('attendance_p_show') == 1) { ?>
                <li>
                    <a href="<?= base_url('Logs'); ?>">
                        <i class="fas fa-calendar-alt Nav_Icon"></i>
                        <span>Logs</span>
                    </a>
                </li>
            <?php }
            if ($this->session->userdata('user') == 1 || $this->session->userdata('user') != 1) {
            ?>
                <li>
                    <a href="#posmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-american-sign-language-interpreting Nav_Icon"></i>
                        <span>Pos</span>
                    </a>
                    <ul class="collapse list-unstyled" id="posmenu">
                        <?php if ($this->session->userdata('user') == 1) { ?>
                            <li>
                                <a href="<?= base_url('pos/categories'); ?>">
                                    Categories
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('pos/products'); ?>">
                                    Products
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url('pos/total-sell'); ?>">
                                    Total Sell
                                </a>
                            </li>

                            <!-- <li>
                                <a href="<?= base_url('pos/products'); ?>">
                                    Report
                                </a>
                            </li> -->
                        <?php } ?>

                        <?php if ($this->session->userdata('user') != 1) { ?>
                            <li>
                                <a href="<?= base_url('pos/purchase'); ?>">
                                    Purchase
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('pos/my-purchase'); ?>">
                                    My Purchase
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>

            <?php } ?>
        </ul>

        <!-- <ul class="list-unstyled CTAs">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
            </ul> -->
    </nav>

    <!-- /////////////////////////////////////////////// -->


    <!-- /////////////////////////////////////////////// -->

    <!-- Page Content  -->

    <!-- Top_Nav_Bar_Start -->


    <div id="content" class="Content_Bg_Color">
        <nav class="navbar navbar-expand-lg navbar-light Bg_Color Top_Nav">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info" style="background-color: transparent;border: none;box-shadow: none">
                    <i class="fas fa-bars Side_Nav_Btn"></i>

                    <!-- <span>Toggle Sidebar</span> -->
                </button>
                <div class="btn-group ml-auto">

                    <h1 class="noti">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class=" dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell Page_Title_Color mr-2" style="font-size: 23px"></i>
                                    <span class="noti_count tot_length" style="top:32%;left:28%;">
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <form class="accordion p-2" id="accordionExample">
                                        <?php if ($this->session->userdata('user') == 1) { ?>
                                            <div>
                                                <a class="nav-link Hover_Pointer" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <i class="fas fa-user mr-1" style="font-size: 13px"></i>
                                                    <span class="Saeed">New subtasks</span>
                                                    <span class="noti_count cord_length" style="top: 20%;right:0%">
                                                    </span>
                                                </a>
                                                <div id="collapseOne" class="collapse pl-3 cord" aria-labelledby="headingOne" data-parent="#accordionExample">

                                                </div>
                                            </div>
                                        <?php }
                                        if ($this->session->userdata('user') == 1 || $this->session->userdata('birthday_notify') == 1) { ?>
                                            <div>
                                                <a class="nav-link Hover_Pointer" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <i class="fas fa-user-friends mr-1" style="font-size:13px"></i>
                                                    <span class="Saeed">Birthdays</span>
                                                    <span class="noti_count birth_length" style="top: 20%;right:0%">
                                                    </span>
                                                </a>
                                                <div id="collapseTwo" class="collapse px-3 birth" aria-labelledby="headingTwo" data-parent="#accordionExample">

                                                </div>
                                            </div>
                                        <?php }
                                        if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_notify') == 1) { ?>
                                            <div>
                                                <a class="nav-link Hover_Pointer" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <i class="fas fa-users mr-1"></i>
                                                    <span class="Saeed">Projects</span>
                                                    <span class="noti_count proj_length" style="top: 20%;right:0%"></span>
                                                </a>
                                                <div id="collapseThree" class="collapse px-3 proj" aria-labelledby="headingThree" data-parent="#accordionExample">

                                                </div>
                                            </div>
                                        <?php }
                                        if ($this->session->userdata('user') == 1 || $this->session->userdata('task_notify') == 1) { ?>
                                            <div>
                                                <a class="nav-link Hover_Pointer" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    <i class="fas fa-users mr-1"></i>
                                                    <span class="Saeed">Tasks</span>
                                                    <span class="noti_count task_length" style="top: 20%;right:0%"></span>
                                                </a>
                                                <div id="collapseFour" class="collapse px-3 tasks" aria-labelledby="headingFour" data-parent="#accordionExample">

                                                </div>
                                            </div>
                                        <?php }
                                        if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_notify') == 1) { ?>
                                            <div>
                                                <a class="nav-link Hover_Pointer" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                    <i class="fas fa-users mr-1"></i>
                                                    <span class="Saeed">Subtasks</span>
                                                    <span class="noti_count subtask_length" style="top: 20%;right:0%"></span>
                                                </a>
                                                <div id="collapseFive" class="collapse px-3 subtasks" aria-labelledby="headingFive" data-parent="#accordionExample">
                                                </div>
                                            </div>
                                        <?php }
                                        if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_notify_') == 1) { ?>
                                            <div>
                                                <a class="nav-link Hover_Pointer" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                    <i class="fas fa-users mr-1"></i>
                                                    <span class="Saeed">Users</span>
                                                    <span class="noti_count user_length" style="top: 20%;right:0%"></span>
                                                </a>
                                                <div id="collapseSix" class="collapse px-3 users" aria-labelledby="headingSix" data-parent="#accordionExample">
                                                </div>
                                            </div>
                                        <?php }
                                        if ($this->session->userdata('subtask_notify_') == 1) { ?>
                                            <div>
                                                <a class="nav-link Hover_Pointer" data-toggle="collapse" data-target="#collapse111" aria-expanded="false" aria-controls="collapse111">
                                                    <i class="fas fa-users mr-1"></i>
                                                    <span class="Saeed">subtasks(rejected by admin)</span>
                                                    <span class="noti_count subradtoc" style="top: 20%;right:0%"></span>
                                                </a>
                                                <div id="collapse111" class="collapse px-3 subradtoc_val" aria-labelledby="heading111" data-parent="#accordionExample">
                                                </div>
                                            </div>

                                            <?php }
                                        if ($this->session->userdata('status') == 'user_active') {
                                            if ($this->session->userdata('subtask_notify_') == 0) { ?>
                                                <div>
                                                    <a class="nav-link Hover_Pointer" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                                        <i class="fas fa-users mr-1"></i>
                                                        <span class="Saeed">subtaassfassks(approved by admin)</span>
                                                        <span class="noti_count subaad" style="top: 20%;right:0%"></span>
                                                    </a>
                                                    <div id="collapse7" class="collapse px-3 subaad_val" aria-labelledby="heading7" data-parent="#accordionExample">
                                                    </div>
                                                </div>
                                                <div>
                                                    <a class="nav-link Hover_Pointer" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                                        <i class="fas fa-users mr-1"></i>
                                                        <span class="Saeed">subtasks(rejected by admin)</span>
                                                        <span class="noti_count subrad" style="top: 20%;right:0%"></span>
                                                    </a>
                                                    <div id="collapse8" class="collapse px-3 subrad_val" aria-labelledby="heading8" data-parent="#accordionExample">
                                                    </div>
                                                </div>
                                                <div>
                                                    <a class="nav-link Hover_Pointer" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                                        <i class="fas fa-users mr-1"></i>
                                                        <span class="Saeed">subtasks(approved by management)</span>
                                                        <span class="noti_count subacod" style="top: 20%;right:0%"></span>
                                                    </a>
                                                    <div id="collapse9" class="collapse px-3 subacod_val" aria-labelledby="heading9" data-parent="#accordionExample">
                                                    </div>
                                                </div>
                                                <div>
                                                    <a class="nav-link Hover_Pointer" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                                        <i class="fas fa-users mr-1"></i>
                                                        <span class="Saeed">subtasks(rejected by management)</span>
                                                        <span class="noti_count subrcod" style="top: 20%;right:0%"></span>
                                                    </a>
                                                    <div id="collapse10" class="collapse px-3 subrcod_val" aria-labelledby="heading10" data-parent="#accordionExample">
                                                    </div>
                                                </div>
                                                <div>
                                                    <a class="nav-link Hover_Pointer" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                                        <i class="fas fa-users mr-1"></i>
                                                        <span class="Saeed">subtasks(assigned to me)</span>
                                                        <span class="noti_count subtasks_u" style="top: 20%;right:0%"></span>
                                                    </a>
                                                    <div id="collapse11" class="collapse px-3 subtasks_u_val" aria-labelledby="heading11" data-parent="#accordionExample">
                                                    </div>
                                                </div>
                                            <?php }
                                        }
                                        if ($this->session->userdata('user') == 1 || $this->session->userdata('leave_notify') == 1) { ?>
                                            <div>
                                                <a class=" text-secondary ml-2 Hover_Pointer lll">
                                                    <i class="fas fa-users mr-1"></i>
                                                    <span style="font-size:13px!important;">Total Leaves Requests</span>
                                                    <span class="noti_count leaves" style="top: 89%;right:3%"></span>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </form>
                                </div>
                            </li>
                        </ul> <!--  -->
                    </h1>
                </div><!--  -->

                <!--Right_Drop_Down Start  -->
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle Right_Togel_Btton_Drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent;border: none;box-shadow: none;">
                        <div class="Right_Togel_Btton">
                            <?php
                            $userimg = $this->session->userdata('img');
                            if ($userimg == null) {
                                $img = base_url('uploads/users/default.png');
                            } else {
                                $img = base_url('uploads/users/' . $userimg);
                            } ?>
                            <img class="img-fluid rounded-circle" src="<?= $img ?>" width="30px">
                            <a class="Right_Togel_Btton_Txt pl-1 pr-3">Hi,<?= $this->session->userdata('name'); ?></a>
                        </div>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right p-1">
                        <!--  <button class="dropdown-item Right_Togel_Drop_Item_1 btn-lg btn-block pt-0" 
                            type="button">
                                <div class="">
                                    <a class="Right_Togel_Drop_Item_1_Sub_1 pr-1">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a class="Right_Togel_Drop_Item_1_Sub_2 pr-1"
                                    data-toggle="tooltip" data-placement="bottom" title="Rajodiya">
                                    Rajodiya
                                </a>
                                <a class="Right_Togel_Drop_Item_1_Sub_3 text-white">Owner</a>
                                 <a class="Right_Togel_Drop_Item_1_Sub_1 float-right mt-2">
                                    <i class="fas fa-pencil-alt" style="color: #4FD1FE;"></i>
                                </a>
                                </div>
                            </button> -->

                        <!--   <button class="dropdown-item Right_Togel_Drop_Item_2 btn-lg btn-block pt-0" 
                            type="button">
                                <div class="">
                                    <a class="Right_Togel_Drop_Item_1_Sub_1 pr-1">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a class="Right_Togel_Drop_Item_1_Sub_2 pr-1"
                                    data-toggle="tooltip" data-placement="bottom" title="Rajodiya">
                                    Rajodiya
                                </a>
                                <a class="Right_Togel_Drop_Item_1_Sub_3 text-white">Owner</a>
                                 <a class="Right_Togel_Drop_Item_1_Sub_4 float-right mt-2">
                                    <i class="fas fa-pencil-alt" style="color: #4FD1FE;"></i>
                                </a>
                                </div>
                            </button> -->
                        <!-- <hr class="mb-2"> -->
                        <!--  <button class="dropdown-item Right_Togel_Drop_Item_3 btn-lg btn-block pt-0" type="button">
                                <div>
                                    <a class="Right_Togel_Drop_Item_3_Sub_1 pr-1">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a class="Right_Togel_Drop_Item_3_Sub_2">
                                        Create New Workspace
                                    </a>
                                </div>
                            </button>
                            <button class="dropdown-item Right_Togel_Drop_Item_4 btn-lg btn-block pt-0" type="button">
                                <div>
                                    <a class="Right_Togel_Drop_Item_4_Sub_1 pr-1">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a class="Right_Togel_Drop_Item_4_Sub_2">
                                        Remove Me From This Workspace
                                    </a>
                                </div>
                            </button> -->
                        <button class="dropdown-item Right_Togel_Drop_Item_5 btn-lg btn-block pt-0" type="button">
                            <div>
                                <a class="Right_Togel_Drop_Item_5_Sub_1 pr-1">
                                    <i class="fas fa-user-circle"></i>
                                </a>
                                <a href="<?= base_url('Profile/profile') ?>" class="Right_Togel_Drop_Item_5_Sub_2 text-dark">
                                    My Accont
                                </a>
                            </div>
                        </button>
                        <hr class="mb-1">
                        <button class="dropdown-item Right_Togel_Drop_Item_6 btn-lg btn-block pt-0" type="button">
                            <div>
                                <a class="Right_Togel_Drop_Item_6_Sub_1 pr-1">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                                <a class="Right_Togel_Drop_Item_6_Sub_2" href="<?= base_url('Login/logout') ?>">
                                    Logout
                                </a>
                            </div>
                        </button>
                    </div>
                </div>
                <!--Right_Drop_Down End  -->
            </div>
        </nav>

        <!--Top_Nav_Bar_End-->
        <script type="text/javascript">
            $(function() {

                $.ajax({
                    url: '<?= base_url('dashboard/notifications') ?>',
                    method: 'Post',
                    dataType: 'json',
                    success: function(data) {

                        var leng = data.length;
                        if (leng == '') {
                            leng = '0';
                        }

                        if (leng != 0) {

                        }
                        var i;
                        var html = '';
                        for (i = 0; i < data.length; i++) {
                            html += '<div class="pt-2 pb-2 Right_Togel_Btton_Drop Hover_Pointer" style="font-size: 11px!important">' +
                                '<a href="<?= base_url('projects/subtask_view/') ?>' + data[i].project_subtask_id + '/' + data[i].project_id + '" class="notif" data="' + data[i].noti_id + '">' +
                                '<i class="fas fa-caret-right mr-2"></i>' + data[i].subtask_title + '</a>' +
                                '</div>';
                        }

                        $('.cord_length').text(leng);
                        $('.cord').html(html);
                        $('#user_tasks').html(html);

                        $('.notif').click(function() {
                            var id = $(this).attr('data');
                            $.ajax({
                                url: '<?= base_url('dashboard/remove_notifications') ?>',
                                method: 'Post',
                                data: {
                                    id: id
                                }
                            });
                        });
                    }
                });
                $.ajax({
                    url: '<?= base_url('dashboard/birthday') ?>',
                    method: 'Post',
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        var leng = data.length;
                        if (leng == '') {
                            leng = '0';
                        }
                        var i;
                        var html = '';
                        for (i = 0; i < data.length; i++) {
                            html += '<div class="pt-2 pb-2 Right_Togel_Btton_Drop Hover_Pointer" style="font-size: 11px!important">' +
                                '<a href="#">' +
                                '<i class="fas fa-caret-right mr-2"></i>' + data[i].name + '</a>' +
                                '<a class="float-right">' +
                                '<i class="fas fa-clock mr-2"></i>' + data[i].dob + '</a>';
                            '</div>';
                        }

                        $('.birth_length').text(leng);
                        $('.birth').html(html);
                    }
                });
                $.ajax({
                    url: '<?= base_url('Dashboard/project_alert') ?>',
                    method: 'Post',
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        var leng = data.length;
                        if (leng == '') {
                            leng = '0';
                        }
                        var i;
                        var html = '';
                        for (i = 0; i < data.length; i++) {
                            html += '<div class="pt-2 pb-2 Right_Togel_Btton_Drop Hover_Pointer" style="font-size: 11px!important">' +
                                '<a href="<?= base_url('projects/view_details/') ?>' + data[i].project_id + '">' +
                                '<i class="fas fa-caret-right mr-2"></i>' + data[i].project_name + '</a>' +
                                '<a class="float-right">' +
                                '<i class="fas fa-clock mr-2"></i>' + data[i].end_date + '</a>';
                            '</div>';
                        }

                        $('.proj_length').text(leng);
                        $('.proj').html(html);
                    }
                });
                $.ajax({
                    url: '<?= base_url('dashboard/task_alert') ?>',
                    method: 'Post',
                    dataType: 'json',
                    success: function(data) {
                        var leng = data.length;
                        if (leng == '') {
                            leng = '0';
                        }
                        var i;
                        var html = '';
                        for (i = 0; i < leng; i++) {
                            html += '<div class="pt-2 pb-2 Right_Togel_Btton_Drop Hover_Pointer" style="font-size: 11px!important">' +
                                '<a href="<?= base_url('projects/task_view/') ?>' + data[i].task_id + '">' +
                                '<i class="fas fa-caret-right mr-2"></i>' + data[i].task_name + '</a>' +
                                '<a class="float-right">' +
                                '<i class="fas fa-clock mr-2"></i>' + data[i].task_end_date + '</a>';
                            '</div>';
                        }

                        $('.task_length').text(leng);
                        $('.tasks').html(html);
                    }
                });

                $.ajax({
                    url: '<?= base_url('dashboard/notifications') ?>',
                    method: 'Post',
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        var leng = data.length;
                        if (leng == '') {
                            leng = '0';
                        }
                        var i;
                        var html = '';
                        for (i = 0; i < leng; i++) {
                            html += '<div class="pt-2 pb-2 Right_Togel_Btton_Drop Hover_Pointer" style="font-size: 11px!important">' +
                                '<a href="<?= base_url('projects/subtask_view/') ?>' + data[i].subtask_id + '/' + data[i].project_id + '">' +
                                '<a href="<?= base_url('projects/subtask_view/') ?>' + data[i].project_subtask_id + '/' + data[i].project_id + '">' +

                                '<i class="fas fa-caret-right mr-2"></i>' + data[i].subtask_title + '</a>' +
                                '<a class="float-right">' +
                                '<i class="fas fa-clock mr-2"></i>' + data[i].subtask_due_date + '</a>';
                            '</div>';
                        }

                        $('.subtask_length').text(leng);
                        $('.subtasks').html(html);
                    }
                });

                $.ajax({
                    url: '<?= base_url('dashboard/users_alert') ?>',
                    method: 'Post',
                    dataType: 'json',
                    success: function(data) {
                        var leng = data.length;
                        if (leng == '') {
                            leng = '0';
                        }
                        var i;
                        var html = '';
                        for (i = 0; i < leng; i++) {
                            html += '<div class="pt-2 pb-2 Right_Togel_Btton_Drop Hover_Pointer" style="font-size: 11px!important">' +
                                '<a href="<?= base_url('projects/subtask_view/') ?>' + data[i].project_subtask_id + '/' + data[i].project_id + '">' +
                                '<i class="fas fa-caret-right mr-2"></i>The (' + data[i].subtask_title + ') subtask has been completed by (' + data[i].subtask_status_by_name + ')</a>' +
                                '<a class="float-right">' +
                                '</div>';
                        }

                        $('.user_length').text(leng);
                        $('.users').html(html);
                    }
                });

                $.ajax({
                    url: '<?= base_url('dashboard/user_alert_by_authors') ?>',
                    method: 'Post',
                    dataType: 'json',
                    success: function(data) {
                        var data1 = data.codr;
                        var data2 = data.adr;
                        var data3 = data.coda;
                        var data4 = data.ada;
                        var leng1 = data.codr.length;
                        var leng2 = data.adr.length;
                        var leng3 = data.coda.length;
                        var leng4 = data.ada.length;
                        var i;
                        var html1 = '';
                        var html2 = '';
                        var html3 = '';
                        var html4 = '';
                        if (leng1 == '') {
                            leng1 = '0';
                        }
                        if (leng2 == '') {
                            leng2 = '0';
                        }
                        if (leng3 == '') {
                            leng3 = '0';
                        }
                        if (leng4 == '') {
                            leng4 = '0';
                        }
                        for (i = 0; i < leng4; i++) {
                            html1 += '<div class="pt-2 pb-2 Right_Togel_Btton_Drop Hover_Pointer" style="font-size: 11px!important">' +
                                '<a href="<?= base_url('projects/subtask_view/') ?>' + data4[i].project_subtask_id + '/' + data4[i].project_id + '" class="usta" data="' + data4[i].project_subtask_id + '">' +
                                '<i class="fas fa-caret-right mr-2"></i>The (' + data4[i].subtask_title + ') subtask has been approved by admin</a>' +
                                '<a class="float-right">' +
                                '</div>';
                        }

                        $('.subaad').text(leng4);
                        $('.subaad_val').html(html1);

                        for (i = 0; i < leng2; i++) {
                            html2 += '<div class="pt-2 pb-2 Right_Togel_Btton_Drop Hover_Pointer" style="font-size: 11px!important">' +
                                '<a href="<?= base_url('projects/subtask_view/') ?>' + data2[i].project_subtask_id + '/' + data2[i].project_id + '" class="ustr" data="' + data2[i].project_subtask_id + '">' +
                                '<i class="fas fa-caret-right mr-2"></i>The (' + data2[i].subtask_title + ') subtask has been rejected by admin</a>' +
                                '<a class="float-right">' +
                                '</div>';
                        }

                        $('.subrad').text(leng2);
                        $('.subrad_val').html(html2);

                        for (i = 0; i < leng3; i++) {
                            html3 += '<div class="pt-2 pb-2 Right_Togel_Btton_Drop Hover_Pointer" style="font-size: 11px!important">' +
                                '<a href="<?= base_url('projects/subtask_view/') ?>' + data3[i].project_subtask_id + '/' + data3[i].project_id + '" class="usta" data="' + data3[i].project_subtask_id + '">' +
                                '<i class="fas fa-caret-right mr-2"></i>The (' + data3[i].subtask_title + ') subtask has been approved by (' + data3[i].subtask_status_by_name + ')</a>' +
                                '<a class="float-right">' +
                                '</div>';
                        }

                        $('.subacod').text(leng3);
                        $('.subacod_val').html(html3);

                        for (i = 0; i < leng1; i++) {
                            html4 += '<div class="pt-2 pb-2 Right_Togel_Btton_Drop Hover_Pointer" style="font-size: 11px!important">' +
                                '<a href="<?= base_url('projects/subtask_view/') ?>' + data1[i].project_subtask_id + '/' + data1[i].project_id + '" class="ustr" data="' + data1[i].project_subtask_id + '">' +
                                '<i class="fas fa-caret-right mr-2"></i>The (' + data1[i].subtask_title + ') subtask has been rejected by (' + data1[i].subtask_status_by_name + ')</a>' +
                                '<a class="float-right">' +
                                '</div>';
                        }

                        $('.subrcod').text(leng1);
                        $('.subrcod_val').html(html4);

                        $('.ustr').click(function() {
                            var id = $(this).attr('data');
                            $.ajax({
                                url: '<?= base_url('dashboard/change_rejected_status_by_user') ?>',
                                method: 'Post',
                                data: {
                                    id: id
                                }
                            });
                        });

                        $('.usta').click(function() {
                            var id = $(this).attr('data');
                            $.ajax({
                                url: '<?= base_url('dashboard/change_approved_status_by_user') ?>',
                                method: 'Post',
                                data: {
                                    id: id
                                }
                            });
                        });
                    }
                });

                $.ajax({
                    url: '<?= base_url('dashboard/new_subtask_assign_to_user') ?>',
                    method: 'Post',
                    dataType: 'json',
                    success: function(data) {
                        var leng = data.length;
                        if (leng == '') {
                            leng = '0';
                        }
                        var i;
                        var html = '';
                        for (i = 0; i < leng; i++) {
                            html += '<div class="pt-2 pb-2 Right_Togel_Btton_Drop Hover_Pointer" style="font-size: 11px!important">' +
                                '<a href="<?= base_url('projects/subtask_view/') ?>' + data[i].project_subtask_id + '/' + data[i].project_id + '" class="latest_subtask" data="' + data[i].project_subtask_id + '">' +
                                '<i class="fas fa-caret-right mr-2"></i>The New (' + data[i].subtask_title + ') subtask has assigned to you</a>' +
                                '<a class="float-right">' +
                                '</div>';
                        }

                        $('.subtasks_u').text(leng);
                        $('.subtasks_u_val').html(html);

                        $('.latest_subtask').click(function() {
                            var id = $(this).attr('data');
                            $.ajax({
                                url: '<?= base_url('dashboard/change_status_of_new_subtask_assign_to_user') ?>',
                                method: 'Post',
                                data: {
                                    id: id
                                }
                            });
                        });
                    }
                });

                $.ajax({
                    url: '<?= base_url('dashboard/user_alert_by_admin') ?>',
                    method: 'Post',
                    dataType: 'json',
                    success: function(data) {
                        var leng = data.length;
                        if (leng == '') {
                            leng = '0';
                        }
                        var i;
                        var html = '';
                        for (i = 0; i < leng; i++) {
                            html += '<div class="pt-2 pb-2 Right_Togel_Btton_Drop Hover_Pointer" style="font-size: 11px!important">' +
                                '<a href="<?= base_url('projects/subtask_view/') ?>' + data[i].project_subtask_id + '/' + data[i].project_id + '" class="cstr" data="' + data[i].project_subtask_id + '">' +
                                '<i class="fas fa-caret-right mr-2"></i>The (' + data[i].subtask_title + ') subtask has been rejected by admin</a>' +
                                '<a class="float-right">' +
                                '</div>';
                        }

                        $('.subradtoc').text(leng);
                        $('.subradtoc_val').html(html);

                        $('.cstr').click(function() {
                            var id = $(this).attr('data');
                            $.ajax({
                                url: '<?= base_url('dashboard/change_rejected_status_by_coordinator') ?>',
                                method: 'Post',
                                data: {
                                    id: id
                                }
                            });
                        });
                    }
                });

                $.ajax({
                    url: '<?= base_url('dashboard/leave_alert') ?>',
                    method: 'Post',
                    dataType: 'json',
                    success: function(data) {
                        var leng = data.length;
                        if (leng == '') {
                            leng = '0';
                        }
                        if (leng > 0) {
                            $('.lll').prop('href', '<?= base_url('leave/index/1') ?>');
                        }
                        $('.leaves').text(leng);
                    }
                });


                $.ajax({
                    url: '<?= base_url('dashboard/total_alert') ?>',
                    method: 'Post',
                    dataType: 'json',
                    success: function(data) {
                        var leng = data.total_not;
                        if (leng == '') {
                            leng = '0';
                        }

                        $('.tot_length').text(leng);

                    }
                });
            });
        </script>