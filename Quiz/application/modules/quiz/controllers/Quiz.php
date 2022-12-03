<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quiz extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->Model('quiz_model');
    }
    public function index()
    {
        $this->load->view('playerName');
    }
    public function admin()
    {
        $this->load->view('adminlogin');
    }
    public function quizTemplate()
    {
        $this->load->view('quizview');
    }

    public function show()
    {
        $increment = $this->input->post('question');
        $data = $this->quiz_model->fetchQuestionAnswers($increment);
        echo json_encode($data);
    }

    public function showData()
    {
        $info = $this->quiz_model->fetchPlayerData();
        $data['info'] = $info;
        $this->load->view('adminview', $data);
        // echo json_encode($data);
    }

    public function viewsingleData()
    {
        $this->load->view('data');
    }

    function savePlayerInfo()
    {
        $checkdata = [];

        $playername = $this->input->post('playername');
        $date = $this->input->post('date');
        $totalquestions = $this->input->post('totalquestions');
        $attemptedquestions = $this->input->post('attemptedquestions');
        $correctquestions = $this->input->post('correctquestions');
        $timeconsumed = $this->input->post('timeconsumed');
        $selectedoption = $this->input->post('selectedoption');
        $navigate = $this->quiz_model->insertData($playername, $date, $totalquestions, $attemptedquestions, $correctquestions, $timeconsumed,$selectedoption);

        if ($navigate) {
            $checkdata = array(
                'status' => 'Welcome'
            );
        } else {
            $checkdata = array(
                'status' => 'failed'
            );
        }

        echo json_encode($checkdata);
    }


    public function singleData()
    {
        $name = $this->input->get('name');
        $info['played'] = $this->quiz_model->viewSingleData($name);
        $this->load->view('singledata', $info);
    }
}
