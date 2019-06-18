<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'GESTION DE ORDENES';

		$this->load->model('model_mesas');
		$this->load->model('model_orders');
		
		$this->load->model('model_products');
		$this->load->model('model_company');
		$this->load->model('model_users');
	}

	/* 
	* ESTO SOLO REDIRIGE A LA PAGINAmesas 
	*/
	public function index()
	{

			/*if(!in_array('viewMesas', $this->permission)) {
			redirect('dashboard', 'refresh');
		}*/

		$this->render_template('ordenes/index', $this->data);	
	}	

	/*
* Comprueba si obtiene el ID de mesas y recupera la información de mesas del 
modelo de mesas y devuelve los datos en formato json.
* Esta función se invoca desde la página de visualización.
	*/
	public function fetchMesasDataById($id) 
	{
		if($id) {
			$data = $this->model_mesas->getMesasData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
 Obtiene el valor de mesas de la tabla de mesas a la que se llama
  esta función desde la función ajax de datos
	*/
	public function fetchMesasData()
	{
		$result = array('data' => array());

		$data = $this->model_mesas->getMesasData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			//if(in_array('updateMesas', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			//}

			//if(in_array('deleteMesas', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			//}
				

			$status = ($value['active'] == 1) ? '<span class="label label-success">Libre</span>' : '<span class="label label-warning">Ocupado</span>';

			$result['data'][$key] = array(
				$value['name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function fetchMesasName()
	{
		$result = array('data' => array());

		$data = $this->model_mesas->getMesasData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			//if(in_array('updateMesas', $this->permission)) {
				$buttons .= 
				'<button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Añadir Orden </button>';
				//}

			//if(in_array('deleteMesas', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal">Editar Orden </button>';
			//}
		    // $x = $value['name'];
		  
			/*  $nombre =  '<input value="<?php echo $value['name'] ?>"></input>  '  ;  */ 

			$status = ($value['active'] == 1) ? '<span class="label label-success">Libre</span>' : '<span class="label label-warning">Ocupado</span>';

			$result['data'][$key] = array(
			    $value['name'],
				// $nombre,
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


	/*
Comprueba la validación de la forma de mesas y si la validación se realiza 
correctamente, inserta los datos en la base de datos y devuelve los mensajes de
 operación de formato json.
	*/
/*	public function create()
	{
		if(!in_array('createMesas', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();
		$this->form_validation->set_rules('mesas_name', 'Mesas name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('mesas_name'),
        		'active' => $this->input->post('active')
        	);

        	$create = $this->model_mesas->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }	

        echo json_encode($response);
} */

	/*
Comprueba la validación del formulario de mesas y si la validación se realiza
 correctamente, actualiza los datos en la base de datos y devuelve los mensajes 
 de operación de formato json.
	*/
	
	//  public function update($id)
	//  {

		/*if(!in_array('updateMesas', $this->permission)) {
			redirect('dashboard', 'refresh');
		}*/
/*
		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_mesas_name', 'Mesas name', 'trim|required');
			// $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_mesas_name'),
	        		// 'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_mesas->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
} */

	/*
Elimina la información de mesas de la base de datos y devuelve 
los mensajes de operación de formato json
	*/
//	public function remove()
//	{
		/*if(!in_array('deleteMesas', $this->permission)) {
			redirect('dashboard', 'refresh');
}*/ 
/*		
		$mesas_id = $this->input->post('mesas_id');

		$response = array();
		if($mesas_id) {
			$delete = $this->model_mesas->remove($mesas_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
}  */


// ===============================================================================================================

// Si la validación no es válida, entonces se redirige a la página de creación.
// * Si la validación para cada campo de entrada es válida, entonces inserta los datos en la base de datos
// * y almacena el mensaje de operación en los datos flash de sesión y se muestra en la página del grupo de administración

public function create()
{
	if(!in_array('createOrder', $this->permission)) {
		redirect('dashboard', 'refresh');
	}

	$this->data['page_title'] = 'Add Ordennnnnnnnnn';

	$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
	

	if ($this->form_validation->run() == TRUE) {        	
		
		$order_id = $this->model_orders->create();
		
		if($order_id) {
			$this->session->set_flashdata('success', 'Successfully created');
			redirect('ordenes/update/'.$order_id, 'refresh');
		}
		else {
			$this->session->set_flashdata('errors', 'Error occurred!!');
			redirect('ordenes/create/', 'refresh');
		}
	}
	else {
		// false case
		$company = $this->model_company->getCompanyData(1);
		$this->data['company_data'] = $company;
		$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
		$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

		$this->data['products'] = $this->model_products->getActiveProductData();      	

		$this->render_template('ordenes/create', $this->data);
	}	
}


// / *
// * Obtiene el id del producto pasado del método ajax.
// * Comprueba recupera los datos del producto en particular de la identificación del producto
// * y devolver los datos al formato json.
// * /
	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	// * Obtiene toda la información del producto activo de la tabla de productos.
	// * Esta función se utiliza en la página de pedido, para la selección del producto en la tabla.
	// * La respuesta se devuelve en el formato json.
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	
// Obtiene los datos de pedidos de la tabla de pedidos.
// * this function is called from the datatable ajax function

	public function fetchOrdersData()
	{
		$result = array('data' => array());

		$data = $this->model_orders->getOrdersData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_orders->countOrderItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';

			if(in_array('viewOrder', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('ordenes/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('ordenes/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteOrder', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-success">Paid</span>';	
			}
			else {
				$paid_status = '<span class="label label-warning">Not Paid</span>';
			}

			$result['data'][$key] = array(
				$value['bill_no'],
				$value['customer_name'],
				$value['customer_phone'],
				$date_time,
				$count_total_item,
				$value['net_amount'],
				$paid_status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


	/*
	* Si la validación no es válida, se redirige a la página de edición de órdenes.
	* Si la validación es exitosa, entonces actualiza los datos en la base de datos
	* y almacena el mensaje de operación en los datos flash de sesión y se muestra en la página del grupo de administración
	*/
	public function update($id)
	{
		if(!in_array('updateOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Ordennnnnnnn';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_orders->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('ordenes/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('ordenes/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$orders_data = $this->model_orders->getOrdersData($id);

    		$result['order'] = $orders_data;
    		$orders_item = $this->model_orders->getOrdersItemData($orders_data['id']);

    		foreach($orders_item as $k => $v) {
    			$result['order_item'][] = $v;
    		}

    		$this->data['order_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('ordenes/edit', $this->data);
        }
	}




	/*
	
Elimina los datos de la base de datos y devuelve la respuesta al formato json.
	*/
	public function remove()
	{
		if(!in_array('deleteOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$order_id = $this->input->post('order_id');

        $response = array();
        if($order_id) {
            $delete = $this->model_orders->remove($order_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response); 
	}

// 	// * Obtiene la identificación del producto y recupera los datos del pedido.
//     * La lógica de impresión del pedido se realiza aquí. 


public function printDiv($id)
{
	if(!in_array('viewOrder', $this->permission)) {
		redirect('dashboard', 'refresh');
	}
	
	if($id) {
		$order_data = $this->model_orders->getOrdersData($id);
		$orders_items = $this->model_orders->getOrdersItemData($id);
		$company_info = $this->model_company->getCompanyData(1);

		$order_date = date('d/m/Y', $order_data['date_time']);
		$paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

		$html = '<!-- Main content -->
		<!DOCTYPE html>
		<html>
		<head>
		  <meta charset="utf-8">
		  <meta http-equiv="X-UA-Compatible" content="IE=edge">
		  <title>AdminLTE 2 | Invoice</title>
		  <!-- Tell the browser to be responsive to screen width -->
		  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		  <!-- Bootstrap 3.3.7 -->
		  <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
		  <!-- Font Awesome -->
		  <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
		  <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
		</head>
		<body onload="window.print();">
		
		<div class="wrapper">
		  <section class="invoice">
			<!-- title row -->
			<div class="row">
			  <div class="col-xs-12">
				<h2 class="page-header">
				  '.$company_info['company_name'].'
				  <small class="pull-right">Date: '.$order_date.'</small>
				</h2>
			  </div>
			  <!-- /.col -->
			</div>
			<!-- info row -->
			<div class="row invoice-info">
			  
			  <div class="col-sm-4 invoice-col">
				
				<b>Bill ID:</b> '.$order_data['bill_no'].'<br>
				<b>Name:</b> '.$order_data['customer_name'].'<br>
				<b>Address:</b> '.$order_data['customer_address'].' <br />
				<b>Phone:</b> '.$order_data['customer_phone'].'
			  </div>
			  <!-- /.col -->
			</div>
			<!-- /.row -->

			<!-- Table row -->
			<div class="row">
			  <div class="col-xs-12 table-responsive">
				<table class="table table-striped">
				  <thead>
				  <tr>
					<th>Product name</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Amount</th>
				  </tr>
				  </thead>
				  <tbody>'; 

				  foreach ($orders_items as $k => $v) {

					  $product_data = $this->model_products->getProductData($v['product_id']); 
					  
					  $html .= '<tr>
						<td>'.$product_data['name'].'</td>
						<td>'.$v['rate'].'</td>
						<td>'.$v['qty'].'</td>
						<td>'.$v['amount'].'</td>
					  </tr>';
				  }
				  
				  $html .= '</tbody>
				</table>
			  </div>
			  <!-- /.col -->
			</div>
			<!-- /.row -->

			<div class="row">
			  
			  <div class="col-xs-6 pull pull-right">

				<div class="table-responsive">
				  <table class="table">
					<tr>
					  <th style="width:50%">Gross Amount:</th>
					  <td>'.$order_data['gross_amount'].'</td>
					</tr>';

					if($order_data['service_charge'] > 0) {
						$html .= '<tr>
						  <th>Service Charge ('.$order_data['service_charge_rate'].'%)</th>
						  <td>'.$order_data['service_charge'].'</td>
						</tr>';
					}

					if($order_data['vat_charge'] > 0) {
						$html .= '<tr>
						  <th>Vat Charge ('.$order_data['vat_charge_rate'].'%)</th>
						  <td>'.$order_data['vat_charge'].'</td>
						</tr>';
					}
					
					
					$html .=' <tr>
					  <th>Discount:</th>
					  <td>'.$order_data['discount'].'</td>
					</tr>
					<tr>
					  <th>Net Amount:</th>
					  <td>'.$order_data['net_amount'].'</td>
					</tr>
					<tr>
					  <th>Paid Status:</th>
					  <td>'.$paid_status.'</td>
					</tr>
				  </table>
				</div>
			  </div>
			  <!-- /.col -->
			</div>
			<!-- /.row -->
		  </section>
		  <!-- /.content -->
		</div>
	</body>
</html>';

		  echo $html;
	}
}


	


}