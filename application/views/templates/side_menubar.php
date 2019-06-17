<aside class="main-sidebar" style="background-color: #34393a;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" >
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" style="background-color: #34393a; font-size: 15px;" data-widget="tree">
        
            <li id="dashboardMainMenu" class="activar">
                <a href="<?php echo base_url('dashboard')?>">
                    <img class="fa" src="/stock-v2/assets/images/icons/dashboard.png"> 
                    <span style="margin-left: 15px;">Panel de Control</span>
                </a>
            </li>

            <?php if(in_array('createMesas', $user_permission) || in_array('updateMesas', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteMesas', $user_permission)): ?>
                <li id="mesasNav" class="activar">
                    <a href="<?php echo base_url('mesas/') ?>">
                      <img class="fa" src="/stock-v2/assets/images/icons/table.png">
                      <span style="margin-left: 15px;">
                        Mesas del Restaurante
                      </span>
                    </a>
                </li>
            <?php endif;?>


            <?php if($user_permission): ?>
                <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                    <li class="treeview" id="mainUserNav">
                        <a href="#">
                            <img class="fa" src="/stock-v2/assets/images/icons/users.png">
                            <span style="margin-left: 15px;">
                                Usuarios del Sistema
                            </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                          <?php if(in_array('createUser', $user_permission)): ?>
                              <li id="createUserNav">
                                  <a href="<?php echo base_url('users/create') ?>">
                                      <i class="fa fa-circle-o"></i>
                                      Agregar usuario
                                  </a>
                              </li>
                          <?php endif; ?>

                          <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                              <li id="manageUserNav">
                                  <a href="<?php echo base_url('users') ?>">
                                      <i class="fa fa-circle-o"></i>
                                      Administrar usuarios
                                  </a>
                              </li>
                          <?php endif; ?>
                        </ul>
                    </li>
            <?php endif; ?>

          <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
            <li class="treeview" id="mainGroupNav">
              <a href="#">
               <img  class="fa" src="/stock-v2/assets/images/icons/groups.png">
                <span style="margin-left: 15px;">Grupos de Usuarios</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createGroup', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('groups/create') ?>"><i class="fa fa-circle-o"></i> Añadir grupo</a></li>
                <?php endif; ?>
                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupNav"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-circle-o"></i> Administrar grupos</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>


     

          <?php if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
            <li id="categoryNav">
              <a href="<?php echo base_url('category/') ?>">
                <img  class="fa" src="/stock-v2/assets/images/icons/categories.png">
                <span style="margin-left: 15px;">
                  Categorías de Productos
                </span>
              </a>
            </li>
          <?php endif; ?>



          <?php if(in_array('createProduct', $user_permission) || in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
            <li class="treeview" id="mainProductNav">
              <a href="#">
                <img class="fa" src="/stock-v2/assets/images/icons/products.png">
                <span style="margin-left: 15px;">Productos Totales</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createProduct', $user_permission)): ?>
                  <li id="addProductNav"><a href="<?php echo base_url('products/create') ?>"><i class="fa fa-circle-o"></i> Añadir Producto</a></li>
                <?php endif; ?>
                <?php if(in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
                <li id="manageProductNav"><a href="<?php echo base_url('products') ?>"><i class="fa fa-circle-o"></i> Gestionar Productos</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>


          <?php if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
            <li class="treeview" id="mainOrdersNav">
              <a href="#">
                <img  class="fa" src="/stock-v2/assets/images/icons/orders.png">
                <span style="margin-left: 15px;">
                  Pedidos y Ordenes
                </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createOrder', $user_permission)): ?>
                  <li id="addOrderNav"><a href="<?php echo base_url('orders/create') ?>"><i class="fa fa-circle-o"></i>Añadir orden</a></li>
                <?php endif; ?>
                <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                <li id="manageOrdersNav"><a href="<?php echo base_url('orders') ?>"><i class="fa fa-circle-o"></i>Gestionar pedidos</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('viewReports', $user_permission)): ?>
              <li id="reportNav">
                  <a href="<?php echo base_url('reports/') ?>">
                      <img  class="fa" src="/stock-v2/assets/images/icons/reports.png">
                      <span style="margin-left: 15px;">
                          Informes/Reportes
                      </span>
                  </a>
              </li>
          <?php endif; ?>


          <?php if(in_array('updateCompany', $user_permission)): ?>
              <li id="companyNav">
                  <a href="<?php echo base_url('company/') ?>">
                      <img  class="fa" src="/stock-v2/assets/images/icons/restaurant.png">
                      <span style="margin-left: 15px;">
                          Restaurante
                      </span>
                  </a>
              </li>
          <?php endif; ?>

      
        <?php endif; ?>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Aperturar/Cerrar Caja</h4>
      </div>

      <form role="form" action="/stock-v2/application/views/prueba.php" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="brand_name">Monto Inicial</label>
            <input type="number" class="form-control" id="mesas_name" name="monto_ini" placeholder="Monto inicial del día" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="brand_name">Monto Final</label>
            <input type="number" class="form-control" id="mesas_name" name="monto_fin" placeholder="Monto final del día" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="brand_name">ingrese contraseña:</label>
            <label for="active" class="label label-info"><?php $user_id = $this->session->userdata('id');
                                          $user_data = $this->model_users->getUserData($user_id);
                                          $this->data['user_data'] = $user_data;

                                          $user_group = $this->model_users->getUserGroup($user_id);
                                          $this->data['user_group'] = $user_group;echo $user_data['username'];?></label>
            
            <input type="text" disabled="" class="form-control" id="mesas_name" name="active" value="0" placeholder="Contraseña" autocomplete="off">
          </div>
          
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn bg-red">Aperturar Caja</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->