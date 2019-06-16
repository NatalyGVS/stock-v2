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
          <a href="#" class="sidebar-toggle navegador" data-toggle="push-menu" role="button">
            <span class="sr-only">Menu navegacion</span>
          </a>
          <di>
            <nav>
                <ul class="nava ul">
                  <li class="licreated"><a class="label-info label abg" href=""><span><?php $user_id = $this->session->userdata('id');
                                          $user_data = $this->model_users->getUserData($user_id);
                                          $this->data['user_data'] = $user_data;

                                          $user_group = $this->model_users->getUserGroup($user_id);
                                          $this->data['user_group'] = $user_group;echo $user_data['username'];?>
                       
                      </span></a>
                      <ul class="ul2">
                        <li><a class="abg2" href=""><label style="margin-left: 5px; font-size: 13px;">Mi perfil</label></a></li>
                        <li><a class="abg2" href=""><label style="margin-left: 5px; font-size: 13px;">Editar datos</label></a></li>
                        <li><a class="abg2" href="<?php echo base_url('auth/logout') ?>"><label style="margin-left: 5px; font-size: 13px;">Cerra Sesión</label></a></li>
                      </ul>
                  </li>
                </ul> 
            </nav>
    </nav>
     <div class="bg-orange" style="font-size: 5px;" align="right"> <label> </label></div>
</header>
  <!-- Left side column. contains the logo and sidebar -->
  