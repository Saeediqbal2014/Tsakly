<html>  
 <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
      <title>Login</title>  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />  
 </head>  
 <body>  
      <div class="container m-auto"> 
           <br /><br /><br />
            <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center"><img src="<?php echo base_url('asset/img/logo.png')?>" width="40%"></div>
                    <div class="col-md-4"></div>
            </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" style="background-color:#1d6077;border-radius:10px;border:4px solid #4fd1fe;">
                <br><br>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <h3 class="text-white">Login</h3>
                    </div>
                    <div class="col-md-1"></div>
                </div>    
               <form method="post" action="<?php echo base_url(); ?>Login/login_validation">  
                    <div class="row">
                        <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group">  
                                    <?php  
                                          echo '<label class="text-danger">'.$this->session->flashdata("error").'</label>';  
                                     ?>
                                     <br>
                                     <label class="text-white">Enter Email</label>  
                                     <input type="email" name="email" class="form-control form-control-sm" placeholder="Enter your email here..."/>  
                                     <span class="text-danger"><?=form_error('email');?></span>                 
                                </div>
                            </div> 
                        <div class="col-md-1"></div>     
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group">  
                                     <label class="text-white">Enter Password</label>  
                                     <input type="password" name="password" class="form-control form-control-sm" placeholder="Enter your password here..."/>  
                                     <span class="text-danger"><?=form_error('password');?></span>  
                                </div>
                            </div> 
                        <div class="col-md-1"></div>     
                    </div> 
                    <div class="row">
                        <div class="col-md-1"></div>
                            <div class="col-md-10 text-right">
                                <div class="form-group">  
                                     <input type="submit" name="insert" value="Login" class="btn btn-success" />  
                                </div>
                            </div>
                        <div class="col-md-1"></div>        
                    </div>
               </form>
            </div> 
            <div class="col-md-3"></div>
        </div>   
      </div>  
 </body>  
 </html> 