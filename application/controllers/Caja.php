<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Caja extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Caja';

		$this->load->model('model_caja');
		$this->load->model('model_users');
	}

	/* 
	* ESTO SOLO REDIRIGE A LA PAGINAcaja 
	*/
	public function index()
	{

			/*if(!in_array('viewCaja', $this->permission)) {
			redirect('dashboard', 'refresh');
		}*/

		$this->render_template('caja/index', $this->data);	
	}	

	/*
* Comprueba si obtiene el ID de caja y recupera la información de caja del 
modelo de caja y devuelve los datos en formato json.
* Esta función se invoca desde la página de visualización.
	*/
	public function fetchCajaDataById($id) 
	{
		if($id) {
			$data = $this->model_caja->getCajaData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
 Obtiene el valor de caja de la tabla de caja a la que se llama
  esta función desde la función ajax de datos
	*/
	public function fetchCajaData()
	{
		$result = array('data' => array());

		$data = $this->model_caja->getCajaData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			//if(in_array('updateCaja', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			//}

			//if(in_array('deleteCaja', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			//}
				

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


	public function update(true)
	{

		/*if(!in_array('updateCaja', $this->permission)) {
			redirect('dashboard', 'refresh');
		}*/

		$response = array();

		if(true) {
			$this->form_validation->set_rules('edit_caja_monto_ini', 'monto_ini', 'trim|required');
			$this->form_validation->set_rules('edit_monto_fin', 'monto_fin', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'active', 'trim|required');



			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		//'monto_ini' => $this->input->post('edit_caja_monto_ini'),
	        		 'active' => $this->input->post('active'),	
	        	);

	        	$update = $this->model_caja->update($data);
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


}