<header class="main-header">
    <!-- Logo -->
    <a class="logo" style="background: #34393a;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>La Reserva</b></span>
      
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background: #34393a">
      <!-- Sidebar toggle button-->
      <div>
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Menu navegacion</span>
      </a>
      <div align="right">
       <div class="label bg-green" style="font-size: 15px; position: absolute; top: 20%; right: 1%; margin: 5px 0 0 0px; padding-top: 5px; height: 50%"> 
          <a href="<?php echo base_url('users/profile/') ?>" style="color:#ffffff">
              <span><?php $user_id = $this->session->userdata('id');
                                  $user_data = $this->model_users->getUserData($user_id);
                                  $this->data['user_data'] = $user_data;

                                  $user_group = $this->model_users->getUserGroup($user_id);
                                  $this->data['user_group'] = $user_group;echo $user_data['username'];?>
                <i class="fa fa-users"></i> 
              </span>
            </a>
          </div>
     </div>
     </div>

    </nav>
     <div class="bg-orange" style="font-size: 5px;" align="right"> <label> </label></div>
</header>
  <!-- Left side column. contains the logo and sidebar -->
  