<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cancelar extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		$this->data['page_title'] = 'cancelar';
		$this->load->model('model_mesas');
		$this->load->model('model_orders');
		$this->load->model('model_products');
		$this->load->model('model_company');
		$this->load->model('model_users');
	}
	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{   $this->data['mesas'] = $this->model_mesas->getActiveMesas(); 
		
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->data['page_title'] = 'Manage cancelar';
		$this->render_template('cancelar/index', $this->data);		
	}


	public function fetchOrdersDataEstado()
	{   

		$result = array('data' => array());
		$data = $this->model_orders->getOrdersData3();
		// $data = $this->model_orders->getOrdersData_NotPago_Despachado();
		foreach ($data as $key => $value) {
			
			date_default_timezone_set("America/Lima");   
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);
			$date_time = $date . ' ' . $time;
			// button
			$buttons = '';
			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('cancelar/updateEs/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('viewOrder', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('orders/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			// if(in_array('deleteOrder', $this->permission)) {
			// 	$buttons .= ' <button type="button" class="btn btn-default" onclick="viewProductsFunc('.$value['id'].')" data-toggle="modal" data-target="#viewModal"><i class="fa "></i></button>';
			// }

			if(in_array('deleteOrder', $this->permission)) {
				// $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-success">Pagado</span>';	
			}
			else {
				if ($value['paid_status'] == 2){
					$paid_status = '<span class="label label-warning">No Pagado</span>';
				}else{
					$paid_status = '<span class="label label-danger">ERROR</span>';
				}	

			}


            $mesa = $this->model_mesas->getMesasData_PyO($value['id_mesa']) ;
			$usuario = $this->model_users->getUserData($value['user_id']) ;

			$result['data'][$key] = array(
				$value['bill_no'],
				$mesa['name'],
				$usuario['username'],
				$value['customer_name'],
				$date_time,
				$paid_status ,
				$buttons
			);
		} // /foreach
		$this->data['mesas'] = $this->model_mesas->getActiveMesas(); 
		echo json_encode($result);
	}

	
	
	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{
		if(!in_array('createOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->data['page_title'] = 'Estado Pedido';
		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$order_id = $this->model_orders->create();
        	
        	if($order_id) {
				$this->session->set_flashdata('success', 'Successfully created');
				redirect('cancelar', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('cancelar/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company; 
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;
			$this->data['products'] = $this->model_products->getActiveProductData();   
			$this->data['mesas'] = $this->model_mesas->getActiveMesas();   	
            $this->render_template('cancelar/create', $this->data);
        }	
	}




	/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
	*/
	public function getProductValueById()
	{   $product_id = $this->input->post('product_id');
		
		if($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the order page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}
	public function getTableMesaRow()
	{
		$mesas = $this->model_mesas->getActiveMesas();
		echo json_encode($mesas);
		// $mesas = $this->model_mesas->getActiveCategory();
		// echo json_encode($mesas);
	}
	/*
	* If the validation is not valid, then it redirects to the edit cancelar page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/

	 public function updateEs($id)
	 {    
	 	if(!in_array('updateOrder', $this->permission)) {
             redirect('dashboard', 'refresh');
         }
	 	if(!$id) {
	 		redirect('dashboard', 'refresh');
	 	}
	 	$this->data['page_title'] = 'Update Es';
	 	 $this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
         if ($this->form_validation->run() == TRUE) {        	

        	// $update = $this->model_orders->update($id);
            $updateEs = $this->model_orders->updateCancelar($id);
        	
         	if($updateEs == true) {
         		$this->session->set_flashdata('success', 'Successfully updated');
         		redirect('cancelar', 'refresh');
         	}
         	else {
         		$this->session->set_flashdata('errors', 'Error occurred!!');
         		redirect('cancelar/updateEs/'.$id, 'refresh');
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
	 		$this->data['products'] =  $this->model_products->getActiveProductData();   
             $this->render_template('cancelar/edit', $this->data);
         }
	 }


/*

	public function update($id)
	{

		// if(!in_array('updateMesas', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		if($id) {
			// $this->form_validation->set_rules('edit_mesas_name', 'Mesas name', 'trim|required');
			// $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			// $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		// 'name' => $this->input->post('edit_mesas_name'),
	        		'estado_orden' => 1	,
	        	);

	        	$update = $this->model_orders->updateEstado($data, $id);
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
	}
*/
	
	/*
	* It removes the data from the database
	* and it returns the response into the json format
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
	}
