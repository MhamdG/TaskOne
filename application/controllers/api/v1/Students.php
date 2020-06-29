<?php

require APPPATH . 'libraries/REST_Controller.php';

class Students extends REST_Controller
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
            $data = $this->db->get_where("students", ['id' => $id])->row_array();
        } else {
            $data = $this->db->get("students")->result();
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
        $this->db->insert('students', $input_data);

        $this->response(['students created successfully.'], REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_put($id)
    {
        $input_data = json_decode($this->input->raw_input_stream, true);

        $this->db->update('students', $input_data, array('id' => $id));

        $this->response(['students updated successfully.'], REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_delete($id)
    {
        $this->db->delete('students', array('id' => $id));

        $this->response(['students deleted successfully.'], REST_Controller::HTTP_OK);
    }
}
