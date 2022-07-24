<?php

/** 
 * @Author: arniuzGlobalAsia
 * @Date: 2022-07-22 00:42:55 
 * @Desc: Your website type is the Fast access Information System
 * @Quality: Premium 
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {

            $view['title'] = 'Home';
            $view['pageName'] = 'home';
            $this->load->view('index', $view);
        }
    }

    function user($param = '', $id = '')
    {
        if (empty($param)) {
            ob_start();
            $this->load->view('pages/user');
            $html = ob_get_clean();
            echo json_encode(array('html' => $html, 'title' => 'Users'));
        } else if ($param == 'getAllData') {
            $dt = $this->Model_user->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = encrypt($row->userid);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->full_name . '</div>';
                $th3    = '<div class="text-center">' . $row->nick_name . '</div>';
                $th4    = '<div class="text-center">' . $row->initial . '</div>';
                $th5    = '<div class="text-center">' . $row->NIP . '</div>';
                $th6    = '<div class="text-center">' . $row->email . '</div>';
                $th7    = '<div class="text-center">' . $row->address . '</div>';
                $th8    = '<div class="text-center">' . $row->phone_number . '</div>';
                $th9    = '<div class="text-center">' . $row->picture . '</div>';
                $th10   = '<div class="text-center" style="width:100px;">' . (get_btn_group('underMaintenance()', 'underMaintenance()', 'underMaintenance()')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("full_name", "Full Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("nick_name", "Nick Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("initial", "Initial", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("NIP", "NIP", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("email", "Email", "trim|required", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed!'));
            $this->form_validation->set_rules("address", "Address", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("phone_number", "Phone Number", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));

            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'full_name'                => htmlspecialchars($this->input->post('full_name')),
                    'nick_name'                => htmlspecialchars($this->input->post('nick_name')),
                    'initial'                => htmlspecialchars($this->input->post('initial')),
                    'NIP'                => htmlspecialchars($this->input->post('NIP')),
                    'email'                => htmlspecialchars($this->input->post('email')),
                    'address'                => htmlspecialchars($this->input->post('address')),
                    'phone_number'                => htmlspecialchars($this->input->post('phone_number')),

                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_user->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' Add data Tracer Study Program Study', $this->session->userdata('id')));
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        }
    }

    function userRole($param = '', $id = '')
    {
        if (empty($param)) {
        } else if ($param == 'getAllData') {
            $dt = $this->Model_user_role->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = encrypt($row->user_role_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->role . '</div>';
                $th3    = '<div class="text-center">' . $row->description . '</div>';
                $th4   = '<div class="text-center" style="width:100px;">' . (get_btn_group('underMaintenance()', 'underMaintenance()', 'underMaintenance()')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("role", "Role", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("description", "Description", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));

            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'role'                => htmlspecialchars($this->input->post('role')),
                    'description'                => htmlspecialchars($this->input->post('description')),

                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_user_role->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' Add data Tracer Study Program Study', $this->session->userdata('id')));
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        }
    }

    function configuration($param = '', $id = '')
    {
        if (empty($param)) {
            ob_start();
            $this->load->view('pages/configuration');
            $html = ob_get_clean();
            echo json_encode(array('html' => $html, 'title' => 'Users'));
        } else if ($param == 'getAllData') {
            $dt = $this->Model_user->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = encrypt($row->userid);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->full_name . '</div>';
                $th3    = '<div class="text-center">' . $row->nick_name . '</div>';
                $th4    = '<div class="text-center">' . $row->initial . '</div>';
                $th5    = '<div class="text-center">' . $row->NIP . '</div>';
                $th6    = '<div class="text-center">' . $row->email . '</div>';
                $th7    = '<div class="text-center">' . $row->address . '</div>';
                $th8    = '<div class="text-center">' . $row->phone_number . '</div>';
                $th9   = '<div class="text-center" style="width:100px;">' . (get_btn_group('underMaintenance()', 'underMaintenance()', 'underMaintenance()')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("full_name", "Full Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("nick_name", "Nick Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("initial", "Initial", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("NIP", "NIP", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("email", "Email", "trim|required", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed!'));
            $this->form_validation->set_rules("address", "Address", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("phone_number", "Phone Number", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));

            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'full_name'                => htmlspecialchars($this->input->post('full_name')),
                    'nick_name'                => htmlspecialchars($this->input->post('nick_name')),
                    'initial'                => htmlspecialchars($this->input->post('initial')),
                    'NIP'                => htmlspecialchars($this->input->post('NIP')),
                    'email'                => htmlspecialchars($this->input->post('email')),
                    'address'                => htmlspecialchars($this->input->post('address')),
                    'phone_number'                => htmlspecialchars($this->input->post('phone_number')),

                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_user->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' Add data Tracer Study Program Study', $this->session->userdata('id')));
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        }
    }

    function assessment($param = '', $id = '')
    {
        if (empty($param)) {
            ob_start();
            $this->load->view('pages/assessmentSchedule');
            $html = ob_get_clean();
            echo json_encode(array('html' => $html, 'title' => 'Users'));
        } else if ($param == 'getDataAssessment') {
            $dt = $this->Model_assessment->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = encrypt($row->assessment_schedule_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->title_prodi . '</div>';
                $th3    = '<div class="text-center">' . $row->accreditation_prodi . '</div>';
                $th4    = '<div class="text-center">' . $row->year_prodi . '</div>';
                $th5    = '<div class="text-center">' . $row->period . '</div>';
                $th6    = '<div class="text-center">' . $row->start . '</div>';
                $th7    = '<div class="text-center">' . $row->end . '</div>';
                $th8    = '<div class="text-center">' . $row->team . '</div>';
                $th9   = '<div class="text-center" style="width:100px;">' . (get_btn_group('underMaintenance()', 'underMaintenance()', 'underMaintenance()')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'getDataProdi') {
            $dt = $this->Model_assessment->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = encrypt($row->assessment_schedule_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->title . '</div>';
                $th3    = '<div class="text-center">' . $row->abbreviation . '</div>';
                $th4    = '<div class="text-center">' . $row->accreditation . '</div>';
                $th5    = '<div class="text-center">' . $row->year . '</div>';
                $th6    = '<div class="text-center">' . $row->kaprodi_name . '</div>';
                $th7   = '<div class="text-center" style="width:100px;">' . (get_btn_group('underMaintenance()', 'underMaintenance()', 'underMaintenance()')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'getDataProdiLecturer') {
            $dt = $this->Model_assessment->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = encrypt($row->assessment_schedule_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->title . '</div>';
                $th3    = '<div class="text-center">' . $row->abbreviation . '</div>';
                $th4    = '<div class="text-center">' . $row->accreditation . '</div>';
                $th5    = '<div class="text-center">' . $row->year . '</div>';
                $th6    = '<div class="text-center">' . $row->kaprodi_name . '</div>';
                $th7   = '<div class="text-center" style="width:100px;">' . (get_btn_group('underMaintenance()', 'underMaintenance()', 'underMaintenance()')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("full_name", "Full Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("nick_name", "Nick Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("initial", "Initial", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("NIP", "NIP", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("email", "Email", "trim|required", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed!'));
            $this->form_validation->set_rules("address", "Address", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("phone_number", "Phone Number", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));

            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'full_name'                => htmlspecialchars($this->input->post('full_name')),
                    'nick_name'                => htmlspecialchars($this->input->post('nick_name')),
                    'initial'                => htmlspecialchars($this->input->post('initial')),
                    'NIP'                => htmlspecialchars($this->input->post('NIP')),
                    'email'                => htmlspecialchars($this->input->post('email')),
                    'address'                => htmlspecialchars($this->input->post('address')),
                    'phone_number'                => htmlspecialchars($this->input->post('phone_number')),

                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_user->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' Add data Tracer Study Program Study', $this->session->userdata('id')));
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        }
    }

    function systemLogs($param = '', $id = '')
    {
        if (empty($param)) {
            ob_start();
            $this->load->view('pages/assessmentSchedule');
            $html = ob_get_clean();
            echo json_encode(array('html' => $html, 'title' => 'Users'));
        } else if ($param == 'getAllData') {
            $dt = $this->Model_user->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = encrypt($row->userid);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->full_name . '</div>';
                $th3    = '<div class="text-center">' . $row->nick_name . '</div>';
                $th4    = '<div class="text-center">' . $row->initial . '</div>';
                $th5    = '<div class="text-center">' . $row->NIP . '</div>';
                $th6    = '<div class="text-center">' . $row->email . '</div>';
                $th7    = '<div class="text-center">' . $row->address . '</div>';
                $th8    = '<div class="text-center">' . $row->phone_number . '</div>';
                $th9   = '<div class="text-center" style="width:100px;">' . (get_btn_group('underMaintenance()', 'underMaintenance()', 'underMaintenance()')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("full_name", "Full Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("nick_name", "Nick Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("initial", "Initial", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("NIP", "NIP", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("email", "Email", "trim|required", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed!'));
            $this->form_validation->set_rules("address", "Address", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("phone_number", "Phone Number", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));

            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'full_name'                => htmlspecialchars($this->input->post('full_name')),
                    'nick_name'                => htmlspecialchars($this->input->post('nick_name')),
                    'initial'                => htmlspecialchars($this->input->post('initial')),
                    'NIP'                => htmlspecialchars($this->input->post('NIP')),
                    'email'                => htmlspecialchars($this->input->post('email')),
                    'address'                => htmlspecialchars($this->input->post('address')),
                    'phone_number'                => htmlspecialchars($this->input->post('phone_number')),

                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_user->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' Add data Tracer Study Program Study', $this->session->userdata('id')));
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        }
    }

    function sideBar($param = '', $id = '')
    {
        if (empty($param)) {
            $view['listMenu'] = $this->Model_menu->getListMenu();
            ob_start();
            $this->load->view('elements/sideBar', $view);
            $html = ob_get_clean();
            echo json_encode(array('html' => $html));
        } else if ($param = 'getListMenu') {
        }
    }

    function errorPages($param = '', $id = '')
    {
        if (empty($param)) {
            ob_start();
            $this->load->view('pages/errorPages');
            $html = ob_get_clean();
            echo json_encode(array('html' => $html, 'title' => 'Users'));
        }
    }
}

/* End of file Administrator.php */
