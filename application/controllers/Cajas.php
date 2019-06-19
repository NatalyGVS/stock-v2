<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cajas extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Cajas';

		$this->load->model('model_cajas');
		$this->load->model('model_users');
	}

	/* 
	* ESTO SOLO REDIRIGE A LA PAGINAcajas 
	*/
	public function index()
	{

			/*if(!in_array('viewCajas', $this->permission)) {
			redirect('dashboard', 'refresh');
		}*/

		$this->render_template('cajas/index', $this->data);	
	}	

	/*
* Comprueba si obtiene el ID de cajas y recupera la información de cajas del 
modelo de cajas y devuelve los datos en formato json.
* Esta función se invoca desde la página de visualización.
	*/
	public function fetchCajasDataById($id) 
	{
		if($id) {
			$data = $this->model_cajas->getCajasData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
 Obtiene el valor de cajas de la tabla de cajas a la que se llama
  esta función desde la función ajax de datos
	*/
	public function fetchCajasData()
	{
		$result = array('data' => array());

		$data = $this->model_cajas->getCajasData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if($value['active'] == 1) {
				$buttons .= '<button type="button" class="btn btn-default bg-gray" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal" style="width:35%;">CERRAR CAJA</button>';
			}else{
				$buttons .= '<button type="button" class="btn btn-default bg-blue" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal" style="width:35%;">APERTURAR CAJA</button>';
			}

			$status = ($value['active'] == 1) ? '<button type="button" style="width:40%;" class="btn btn-default bg-orange" disabled>APERTURADO</button>' : '<button style="width:40%;" type="button" class="btn btn-default bg-black" disabled>CERRADO</button>';

			$result['data'][$key] = array(
				$value['name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
Comprueba la validación de la forma de cajas y si la validación se realiza 
correctamente, inserta los datos en la base de datos y devuelve los mensajes de
 operación de formato json.
	*/
	public function create()
	{
		/*if(!in_array('createCajas', $this->permission)) {
			redirect('dashboard', 'refresh');
		}*/

		$response = array();
     /////////////////////////////////////////////////////////////////////////////////////////
		$this->form_validation->set_rules('cajas_name', 'Cajas name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('cajas_name'),
        		'active' => $this->input->post('active')
        	);

        	$create = $this->model_cajas->create($data);
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
	}

	/*
Comprueba la validación del formulario de cajas y si la validación se realiza
 correctamente, actualiza los datos en la base de datos y devuelve los mensajes 
 de operación de formato json.
	*/
	public function update($id)
	{

		/*if(!in_array('updateCajas', $this->permission)) {
			redirect('dashboard', 'refresh');
		}*/

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_cajas_name', 'Cajas name', 'trim|required');
		 	$this->form_validation->set_rules('edit_cajas_active', 'Cajas active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_cajas_name'),
	        		'active' => $this->input->post('edit_cajas_active'),	
	        	);

	        	$update = $this->model_cajas->update($data, $id);
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

	/*
Elimina la información de cajas de la base de datos y devuelve 
los mensajes de operación de formato json
	*/
	public function remove()
	{
		/*if(!in_array('deleteCajas', $this->permission)) {
			redirect('dashboard', 'refresh');
		}*/
		
		$cajas_id = $this->input->post('cajas_id');

		$response = array();
		if($cajas_id) {
			$delete = $this->model_cajas->remove($cajas_id);
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
	}

}