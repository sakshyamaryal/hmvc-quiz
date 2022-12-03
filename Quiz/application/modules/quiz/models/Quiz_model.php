<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quiz_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    public function fetchQuestionAnswers($i)
    {
        $where = array('question_id' => $i);
        $this->db->select('question,option_a,option_b,option_c,option_d,correct_option');
        $this->db->join('quiz_option', 'quiz_questions.id = quiz_option.question_id');
        $data = $this->db->get_where('quiz_questions', $where)->result_array();
        return $data;
    }
    public function fetchPlayerData()
    {

        $data = $this->db->get('quiz_played')->result_array();
        return $data;
    }
    public function insertData($playername, $date, $totalquestions, $attemptedquestions, $correctquestions, $timeconsumed,$selectedoption)
    {
        $getData = $this->db->set('playername', $playername)
            ->set('date', $date)
            ->set('totalquestions', $totalquestions)
            ->set('attemptedquestions', $attemptedquestions)
            ->set('correctquestions', $correctquestions)
            ->set('timeconsumed', $timeconsumed)
            ->set('selectedoption', $selectedoption)
            ->insert('quiz_played');

        if ($getData) {
            return true;
        } else {
            return false;
        }
    }

    public function viewSingleData($name)
    {
        $where = array('playername' => $name);
        $this->db->select('*');
        $data = $this->db->get_where('quiz_played', $where)->result_array();
        return $data;
    }
}
