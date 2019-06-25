

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Cancelar Pedidos
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Cancelar</li>
    </ol>

 
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

      <div id="messages"></div>


        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

       

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Por Cobrar</h3>
          </div>
          <div class="form-group">
                   <label for="gross_amount" class="col-sm-12 control-label">Fecha: <?php date_default_timezone_set("America/Lima"); 
                                                                                           echo date("d/m/Y  , h:i a" ) ?></label> 
                </div>
            <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>            
                 <th> no Cuenta  </th>
                 <th> Mesa </th>
                 <th> Usuario </th>
                 <th> Nombre del cliente </th>
                 <th> Fecha y hora </th>
                 <th> Estado de pago </th>
              

                 <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?> -->
                  <th>Acción</th>
                 <?php endif; ?> 
              </tr>
              </thead>

            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if(in_array('deleteOrder', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Eliminar pedido</h4>
      </div>
      <form role="form" action="<?php echo base_url('cancelar/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>¿Realmente quieres eliminar?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>
                                     <!-- FORMULARIO ACTUALIZAR PEDIDO -->

<!--<?php //if(in_array('updateMesas', $user_permission)): ?>-->
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar mesa</h4>
      </div>

         <form role="form" action="<?php echo base_url('cancelar/update') ?>" method="post" id="updateForm">
           <div class="modal-body">
            <div id="messages"></div>

            <div class="form-group">
               
            <p>Se actualizara a estado "EN PREPARACION" </p>
            </div>
            
        

         </div>



        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Aceptar</button>
        </div>
      </form>

      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--<?php //endif; ?>-->








<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#mainCancelarNav").addClass('active');
  $("#mainOrdersNav").addClass('active');
  $("#manageOrdersNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'cancelar/fetchOrdersDataEstado',
    'order': [],
    "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    }
  });

});

// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { order_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}


// actualizar estado Pedido 
function actualizarFunc(id)
{  
  if(id) {
    $("#updateForm").on('submit', function() {
 
      var form = $(this);

   
      // remove the text-danger
      $(".text-danger").remove();
     
      $.ajax({
        url: form.attr('action')  + '/' + id,
        type: form.attr('method'),
        data: form.serialize(),
        //  data: { order_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 
          
          if(response.success === true) {
        
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');
         
            // hide the modal
            $("#editModal").modal('hide');
            $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');
      
          
          } else {
     
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 

            
          }




        }
      }); 
       
      return false;
    });



  }
}



</script>
