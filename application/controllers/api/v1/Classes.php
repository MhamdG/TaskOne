<?php

require APPPATH . 'libraries/REST_Controller.php';

class Classes extends REST_Controller
{

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_get($id = 0)
    {

        if (!empty($id)) {
            $class = $this->db->get_where("Classes", ['id' => $id])->row_array();
            $students = $this->db->get_where("students", ['class_id' => $id])->row_array();
            $data = ['class' => $class, 'students' => $students];
        } else {
            $data = $this->db->get("Classes")->result();
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_post()
    {

        $input_data = json_decode($this->input->raw_input_stream, true);

        $this->db->insert('Classes', $input_data);


        $this->response(['Classes created successfully.'], REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_put($id)
    {
        $input_data = json_decode($this->input->raw_input_stream, true);
        $this->db->update('Classes', $input_data, array('id' => $id));

        $this->response(['Classes updated successfully.'], REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_delete($id)
    {
        $this->db->delete('Classes', array('id' => $id));

        $this->response(['Classes deleted successfully.'], REST_Controller::HTTP_OK);
    }
}
