<?php
class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');  // Load the model
    }

    public function create()
    {
        $this->load->view('includes/header');
        $this->load->view('user/add_user');
        $this->load->view('includes/footer');
    }
    
    public function store()
    {
        //data array holds the user infor submitted thru the form
        $data = array(
            'name'    => isset($_POST['username']) ? $_POST['username'] : null, //if the form fields are set, assign values
            'email'   => isset($_POST['email']) ? $_POST['email'] : null,
            'mobile'  => isset($_POST['mobile']) ? $_POST['mobile'] : null,
            'address' => isset($_POST['address']) ? $_POST['address'] : null
        );
    
        // Insert user data
        $inserted_id = $this->User_model->insert_user($data); //return id of the newly inserted user (true or false)
    
        if ($inserted_id) { //if the id is true
            // Get the newly added user data
            $new_user = array_merge($data, ['id' => $inserted_id]); //create new user array and merge it with data

            echo json_encode(['status' => 'success', 'message' => 'User added successfully!', 'data' => $new_user]);//success jason response to front end
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add user.']);
        }
    }

    

    public function delete($id)
    {
        // Logic to delete the user with the given ID
        $this->User_model->delete_user($id); // Call the model to perform deletion

        // Set a flashdata message
        $this->session->set_flashdata('message', 'Customer deleted successfully.');

        // Redirect
        redirect(base_url('user/index'));
    }

    public function edit($id)
    {
        // Fetch the user data based on ID
        $data['user'] = $this->User_model->get_user_by_id($id);
        
        // Load the edit user view and pass the user data
        $this->load->view('includes/header');
        $this->load->view('user/edit_user', $data);
        $this->load->view('includes/footer');
    }

    public function update($id)
    {
        $data = array(
            'name'    => $_POST['username'],
            'email'   => $_POST['email'],
            'mobile'  => $_POST['mobile'],
            'address' => $_POST['address']
        );

        // Call the model function to update the user
        $this->User_model->update_user($id, $data);
        $this->session->set_flashdata('message', 'Customer updated successfully.');

        // Redirect to the user list
        redirect(base_url('user/index'));
    }

    public function index()
    {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('includes/header');
        $this->load->view('user/list', $data);
        $this->load->view('includes/footer');
    }
}


