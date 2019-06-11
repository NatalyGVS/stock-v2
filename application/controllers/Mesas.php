<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mesas extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Mesas';

		$this->load->model('model_mesas');
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

		$this->render_template('mesas/index', $this->data);	
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
				

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
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
	public function create()
	{
		/*if(!in_array('createMesas', $this->permission)) {
			redirect('dashboard', 'refresh');
		}*/

		$response = array();
     /////////////////////////////////////////////////////////////////////////////////////////
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
	}

	/*
Comprueba la validación del formulario de mesas y si la validación se realiza
 correctamente, actualiza los datos en la base de datos y devuelve los mensajes 
 de operación de formato json.
	*/
	public function update($id)
	{

		/*if(!in_array('updateMesas', $this->permission)) {
			redirect('dashboard', 'refresh');
		}*/

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
	}

	/*
Elimina la información de mesas de la base de datos y devuelve 
los mensajes de operación de formato json
	*/
	public function remove()
	{
		/*if(!in_array('deleteMesas', $this->permission)) {
			redirect('dashboard', 'refresh');
		}*/
		
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
	}

}