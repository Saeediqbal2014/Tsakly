            <!-- Dashoard_Start -->
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-12">
                            <a class="" style=""></a><span class="Page_Title">Dashboard</span>
                        </div>
                    </div>
                    <!-- secod_Row -->
                    <div class="row pt-3 pb-2">
                        <div class="col-lg-4 Bg_Color">
                            <div class="row">
                                <div class="col-lg-12 text-center D_Box p-4">
                                    <p class="mb-0">
                                        <i class="fas fa-project-diagram " style="font-size:24px "></i>
                                    </p>
                                    <h3 style="color: #6C757D"><?=count($projects);?></h3>
                                    <p style="font-size: 13px">Total Projects</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 Bg_Color">
                            <div class="row">
                                <div class="col-lg-12 text-center D_Box p-4">
                                    <p class="mb-0">
                                        <i class="fas fa-align-justify" style="font-size:24px"></i>
                                    </p>
                                    <h3 style="color: #6C757D">
                                        <?php
                                            $tot_task=0;
                                            if(isset($tasks)){
                                                foreach ($tasks as $v)
                                                {
                                                   $tot_task+=count($v);
                                                } 
                                            }
                                           
                                            echo $tot_task;
                                        ?>
                                            
                                    </h3>
                                    <p style="font-size: 13px">Total Tasks</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 Bg_Color">
                            <div class="row">
                                <div class="col-lg-12 text-center D_Box p-4">
                                    <p class="mb-0">
                                        <i class="fas fa-align-center" style="font-size:24px "></i>
                                    </p>
                                    <h3 style="color: #6C757D">
                                        <?php 
                                            $tot_subtask=0;
                                            if(isset($subtasks)){
                                                foreach ($subtasks as $v)
                                                {
                                                   $tot_subtask+=count($v);
                                                } 
                                            }
                                            
                                            echo $tot_subtask;
                                        ?>
                                    </h3>
                                    <p style="font-size: 13px">Total Subtasks</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Dashboard_End-->
        <div id="overlay" onclick="off()"></div>
   