<?php

/** 
 * @Author: arniuzGlobalAsia
 * @Date: 2022-07-22 00:42:55 
 * @Desc: Your website type is the Fast access Information System
 * @Quality: Medium 
 * @Please don't delete this comment.
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
        $userOnById = $this->Model_user_login->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->Model_user_login->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else {
            $view['title'] = 'Home';
            $view['pageName'] = 'home';
            $view['getListData'] = $this->Model_user->getListData();
            $this->load->view('index', $view);
        }
    }


    function user($param = '', $id = '')
    {
        if (empty($param)) {

            ob_start();
            $view['listUser'] = $this->Model_user->getData();
            $view['listUserRole'] = $this->Model_user_role->getData();
            $this->load->view('pages/user', $view);
            $html = ob_get_clean();
            $this->output->set_output(json_encode(array('html' => $html, 'title' => 'Users')));
        } else if ($param == 'getAllData') {
            $dt = $this->Model_user->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->userid);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->full_name . '</div>';
                $th3    = '<div class="text-center">' . $row->nick_name . '</div>';
                $th4    = '<div class="text-center">' . $row->initial . '</div>';
                $th5    = '<div class="text-center">' . $row->NIP . '</div>';
                $th6    = '<div class="text-center">' . $row->email . '</div>';
                $th7    = '<div class="text-center">' . $row->address . '</div>';
                $th8    = '<div class="text-center">' . $row->phone_number . '</div>';
                // $th9    = '<div class="text-center">' . $row->picture . '</div>';
                $th9   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('update_user(' . $userid . ')', 'delete_user(' . $userid . ')')) . '</div>';
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
                    'full_name'          => htmlspecialchars($this->input->post('full_name')),
                    'nick_name'          => htmlspecialchars($this->input->post('nick_name')),
                    'initial'            => htmlspecialchars($this->input->post('initial')),
                    'NIP'                => htmlspecialchars($this->input->post('NIP')),
                    'email'              => htmlspecialchars($this->input->post('email')),
                    'address'            => htmlspecialchars($this->input->post('address')),
                    'phone_number'       => htmlspecialchars($this->input->post('phone_number')),
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
        } else if ($param == 'getById') {
            $data = $this->Model_user->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("full_name", "Full Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("nick_name", "Nick Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("initial", "Initial", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("NIP", "NIP", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("email", "Email", "trim|required", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed!'));
            $this->form_validation->set_rules("address", "Address", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("phone_number", "Phone Number", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('userid');
                $data = array(
                    'full_name'          => htmlspecialchars($this->input->post('full_name')),
                    'nick_name'          => htmlspecialchars($this->input->post('nick_name')),
                    'initial'            => htmlspecialchars($this->input->post('initial')),
                    'NIP'                => htmlspecialchars($this->input->post('NIP')),
                    'email'              => htmlspecialchars($this->input->post('email')),
                    'address'            => htmlspecialchars($this->input->post('address')),
                    'phone_number'       => htmlspecialchars($this->input->post('phone_number')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Model_user->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_user->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function userLogin($param = '', $id = '')
    {
        if (empty($param)) {
            $view['listUser'] = $this->Model_user->getData();
            $this->load->view('pages/user', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_user_login->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $user_login_id     = $row->user_login_id;
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->full_name . '</div>';
                $th3    = '<div class="text-center">' . $row->nick_name . '</div>';
                $th4    = '<div class="text-center">' . $row->initial . '</div>';
                $th5    = '<div class="text-center">' . $row->NIP . '</div>';
                $th6    = '<div class="text-center">' . $row->email . '</div>';
                $th7    = '<div class="text-center">' . $row->address . '</div>';
                $th8    = '<div class="text-center">' . $row->phone_number . '</div>';
                $th9    = '<div class="text-center">' . $row->username . '</div>';
                $th10    = '<div class="text-center">' . $row->role . '</div>';
                $th11    = '<div class="text-center">' . $row->block_status . '</div>';
                $th12   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('update_user_login(' . $user_login_id . ')', 'delete_user_login(' . $user_login_id . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("userid", "Pilih Pengguna", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("username", "Username", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("password", "Password", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("user_role_id", "Pilih Role", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("block_status", "Status Blokir", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'userid'           => htmlspecialchars($this->input->post('userid')),
                    'username'         => htmlspecialchars($this->input->post('username')),
                    'password'         => htmlspecialchars($this->input->post('password')),
                    'user_role_id'     => htmlspecialchars($this->input->post('user_role_id')),
                    'block_status'     => htmlspecialchars($this->input->post('block_status')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_user_login->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' Add data Tracer Study Program Study', $this->session->userdata('id')));
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_user_login->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("userid", "Pilih Pengguna", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("username", "Username", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("password", "Password", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("user_role_id", "Pilih Role", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("block_status", "Status Blokir", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('user_login_id');
                $data = array(
                    'userid'           => htmlspecialchars($this->input->post('userid')),
                    'username'         => htmlspecialchars($this->input->post('username')),
                    'password'         => htmlspecialchars($this->input->post('password')),
                    'user_role_id'     => htmlspecialchars($this->input->post('user_role_id')),
                    'block_status'     => htmlspecialchars($this->input->post('block_status')),
                );
                $result['messages']    = '';
                $this->Model_user_login->update($aidi, $data);
                $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_user_login->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode($result);
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
                $user_role_id     = $row->user_role_id;
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->role . '</div>';
                $th3    = '<div class="text-center">' . $row->description . '</div>';
                $th4   = '<div class="text-center" style="width:100px;">' . get_btn_group1('update_user_role(' . $user_role_id . ')', 'delete_user_role(' . $user_role_id . ')') . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("role", "Role", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("description", "Description", "trim|required", array('required' => '{field} cannot be null !'));

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
        } else if ($param == 'getById') {
            $data = $this->Model_user_role->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("role", "Full Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("description", "Nick Name", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('user_role_id');
                $data = array(
                    'role'          => htmlspecialchars($this->input->post('role')),
                    'description'   => htmlspecialchars($this->input->post('description'))
                );
                $result['messages']    = '';
                $this->Model_user_role->update($aidi, $data);
                $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_user_role->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode($result);
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
            $title['title'] = '';
            $view['getListUser'] = $this->Model_user->getData();
            $view['getListProdi'] = $this->Model_prodi->getData();
            // $view['getTotalProdi'] = $this->Model_assessment->check_assessment_prodi();
            $view['getListKaprodi'] = $this->Model_user->getUserBaseRole('Kaprodi');
            $this->load->view('pages/assessmentSchedule', $view);
            $html = ob_get_clean();
            $this->output->set_output(json_encode(array('html' => $html, 'title' => 'Assessment')));
        } else if ($param == 'getDataAssessment') {
            $dt = $this->Model_assessment->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = ($row->assessment_schedule_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->title_prodi . '</div>';
                $th3    = '<div class="text-center">' . $row->accreditation_prodi . '</div>';
                $th4    = '<div class="text-center">' . $row->year_prodi . '</div>';
                $th5    = '<div class="text-center">' . $row->period . '</div>';
                $th6    = '<div class="text-center">' . $row->start . '</div>';
                $th7    = '<div class="text-center">' . $row->end . '</div>';
                $th8    = '<div class="text-center">' . $row->team . '</div>';
                $th9   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('ubahAssessment(' . $enc_id . ')', 'deleteAssessment(' . $enc_id . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("prodi_id", "Program Study", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("period", "Periode", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("start", "Tanggal Mulai", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("end", "Tanggal Selesai", "trim|required", array('required' => '{field} cannot be null !'));
            // $this->form_validation->set_rules("team_total", "Total Team", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum tepat. silahkan cek kembali!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $calc_team =
                    $data = array(
                        'prodi_id'           => htmlspecialchars($this->input->post('prodi_id')),
                        'period'             => htmlspecialchars($this->input->post('period')),
                        'start'              => htmlspecialchars($this->input->post('start')),
                        'end'                => htmlspecialchars($this->input->post('end')),
                        // 'team_total'                => htmlspecialchars($this->input->post('team_total')),
                    );

                $check_prodi_ass = $this->Model_assessment->check_assessment_prodi(4);

                $result['messages'] = '';
                if ($check_prodi_ass[0]->total_prodi != 0) {
                    $result = array('status' => 'error', 'msg' => 'Data Sudah ada, anda tidak dapat memasukkan lagi !');
                } else {
                    $result = array('status' => 'success', 'msg' => 'Data telah dimasukkan!');
                    $this->Model_assessment->addData($data);
                }
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_assessment->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("prodi_id", "Program Study", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("period", "Periode", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("start", "Tanggal Mulai", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("end", "Tanggal Selesai", "trim|required", array('required' => '{field} cannot be null !'));
            // $this->form_validation->set_rules("team_total", "Total Team", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('assessment_schedule_id');
                $data = array(
                    'prodi_id'                => htmlspecialchars($this->input->post('prodi_id')),
                    'period'                => htmlspecialchars($this->input->post('period')),
                    'start'                => htmlspecialchars($this->input->post('start')),
                    'end'                => htmlspecialchars($this->input->post('end')),
                    // 'team_total'                => htmlspecialchars($this->input->post('team_total')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Model_assessment->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_assessment->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function programStudy($param = '', $id = '')
    {
        if ($param == 'getAllData') {
            $dt = $this->Model_prodi->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = $row->program_study_id;
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->title . '</div>';
                $th3    = '<div class="text-center">' . $row->abbreviation . '</div>';
                $th4    = '<div class="text-center">' . $row->accreditation . '</div>';
                $th5    = '<div class="text-center">' . $row->year . '</div>';
                $th6    = '<div class="text-center">' . $row->kaprodi_name . '</div>';
                $th7   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('ubahProdi(' . $enc_id . ')', 'deleteProdi(' . $enc_id . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("title", "Full Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("abbreviation", "Nick Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("accreditation", "Initial", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("year", "NIP", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("user_id_for_kaprodi", "Email", "trim|required", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed!'));
            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'title'          => htmlspecialchars($this->input->post('title')),
                    'abbreviation'          => htmlspecialchars($this->input->post('abbreviation')),
                    'accreditation'            => htmlspecialchars($this->input->post('accreditation')),
                    'year'                => htmlspecialchars($this->input->post('year')),
                    'user_id_for_kaprodi'              => htmlspecialchars($this->input->post('user_id_for_kaprodi')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_prodi->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' Add data Tracer Study Program Study', $this->session->userdata('id')));
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_prodi->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("title", "Full Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("abbreviation", "Nick Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("accreditation", "Initial", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("year", "NIP", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("user_id_for_kaprodi", "Email", "trim|required", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed!'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('program_study_id');
                $data = array(
                    'title'          => htmlspecialchars($this->input->post('title')),
                    'abbreviation'          => htmlspecialchars($this->input->post('abbreviation')),
                    'accreditation'            => htmlspecialchars($this->input->post('accreditation')),
                    'year'                => htmlspecialchars($this->input->post('year')),
                    'user_id_for_kaprodi'              => htmlspecialchars($this->input->post('user_id_for_kaprodi')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Model_prodi->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_prodi->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function programStudyLecturer($param = '', $id = '')
    {
        if ($param == 'getAllData') {
            $dt = $this->Model_prodi_lecturer->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = $row->program_study_lecturer_id;
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->full_name . '</div>';
                $th3    = '<div class="text-center">' . $row->initial . '</div>';
                $th4    = '<div class="text-center">' . $row->NIP . '</div>';
                $th5    = '<div class="text-center">' . $row->email . '</div>';
                $th6    = '<div class="text-center">' . $row->prodi . '</div>';
                $th7   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('ubahDosenProdi(' . $enc_id . ')', 'deleteDosenProdi(' . $enc_id . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("userid", "Pengguna Sistem", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("program_study_id", "Program Study", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data Masih belum tepat, silahkan dicoba kembali.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'userid'                => htmlspecialchars($this->input->post('userid')),
                    'program_study_id'      => htmlspecialchars($this->input->post('program_study_id')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Berhasil di masukkan!');
                $this->Model_prodi_lecturer->addData($data);
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_prodi_lecturer->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("userid", "Pengguna Sistem", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("program_study_id", "Program Study", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('program_study_lecturer_id');
                $data = array(
                    'userid'                => htmlspecialchars($this->input->post('userid')),
                    'program_study_id'      => htmlspecialchars($this->input->post('program_study_id')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Model_prodi_lecturer->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_prodi_lecturer->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function accreditation($param = '', $id = '')
    {
        if (empty($param)) {
            ob_start();
            $title['title'] = '';
            $view['getListProdi'] = $this->Model_prodi->getData();
            $this->load->view('pages/accreditation', $view);
            $html = ob_get_clean();
            $this->output->set_output(json_encode(array('html' => $html, 'title' => 'Assessment')));
        } else if ($param == 'getAllData') {
            $dt = $this->Model_accreditation->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = $row->accreditation_document_id;
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->title . '</div>';
                // $th3    = '<div class="text-center">' . $row->link . '</div>';
                $th4    = '<div class="text-center">' . $row->remarks . '</div>';
                $th5   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('update(' . $enc_id . ')', 'hapus(' . $enc_id . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th4, $th5));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("title", "Judul Dokumen", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("remarks", "Keterangan", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data Belum tepat, Silahkan cek kembali.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'title'          => htmlspecialchars($this->input->post('title')),
                    'link'          => htmlspecialchars($this->input->post('link')),
                    'remarks'            => htmlspecialchars($this->input->post('remarks')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Berhasil dimasukkan!');
                $this->Model_accreditation->addData($data);
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_accreditation->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("title", "Judul Dokumen", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("remarks", "Keterangan", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('accreditation_document_id');
                $data = array(
                    'title'          => htmlspecialchars($this->input->post('title')),
                    'link'          => htmlspecialchars($this->input->post('link')),
                    'remarks'            => htmlspecialchars($this->input->post('remarks')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Model_accreditation->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_accreditation->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function getSupportDocLKPS($criteria = '')
    {
        if (empty($criteria)) {
            $dt = $this->Model_support_master->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = ($row->support_master_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->number . '</div>';
                $th3    = '<div class="text-center">' . $row->title . '</div>';
                $th4    = '<div class="text-center">' . $row->link . '</div>';
                $th5    = '<div class="text-center">' . $row->remarks . '</div>';
                $th6   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('underMaintenance(' . $enc_id . ')', 'underMaintenance(' . $enc_id . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {
            $dt = $this->Model_support_master->getAllData($criteria, 1);
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = ($row->support_master_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->number . '</div>';
                $th3    = '<div class="text-center">' . $row->title . '</div>';
                $th4    = '<div class="text-center">' . $row->link . '</div>';
                $th5    = '<div class="text-center">' . $row->remarks . '</div>';
                $th6   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('underMaintenance(' . $enc_id . ')', 'underMaintenance(' . $enc_id . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        }
    }

    function supportDocuments($param = '', $criteria = '')
    {
        if (empty($param)) {
            ob_start();
            $title['title'] = '';
            $view['getListProdi'] = $this->Model_prodi->getData();
            $view['getDocument'] = $this->Model_support_documents->getData();
            $view['getListCriteria'] = $this->Model_support_criteria->getData();
            $this->load->view('pages/supportDocuments', $view);
            $html = ob_get_clean();
            $this->output->set_output(json_encode(array('html' => $html, 'title' => 'Assessment')));
        } else if ($param == 'getAllData') {
            $dt = $this->Model_support_master->getAllData($criteria, 1);
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $enc_id     = ($row->support_master_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->number . '</div>';
                $th3    = '<div class="text-center">' . $row->title . '</div>';
                $th4    = '<div class="text-center">' . $row->link . '</div>';
                $th5    = '<div class="text-center">' . $row->remarks . '</div>';
                $th6   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('underMaintenance(' . $enc_id . ')', 'underMaintenance(' . $enc_id . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("title", "Full Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("abbreviation", "Nick Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("accreditation", "Initial", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("year", "NIP", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("user_id_for_kaprodi", "Email", "trim|required", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed!'));
            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'title'          => htmlspecialchars($this->input->post('title')),
                    'abbreviation'          => htmlspecialchars($this->input->post('abbreviation')),
                    'accreditation'            => htmlspecialchars($this->input->post('accreditation')),
                    'year'                => htmlspecialchars($this->input->post('year')),
                    'user_id_for_kaprodi'              => htmlspecialchars($this->input->post('user_id_for_kaprodi')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_prodi->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' Add data Tracer Study Program Study', $this->session->userdata('id')));
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        }
    }

    function accreditationTeam($param = '', $id = '')
    {
        if (empty($param)) {
            ob_start();
            $title['title'] = '';
            $view['getListProdi'] = $this->Model_prodi->getData();
            $this->load->view('pages/accreditationTeam', $view);
            $html = ob_get_clean();
            $this->output->set_output(json_encode(array('html' => $html, 'title' => 'Assessment')));
        } else if ($param == 'getDataProdi') {
            $dt = $this->Model_prodi->getAllData();
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
            $this->form_validation->set_rules("title", "Full Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("abbreviation", "Nick Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("accreditation", "Initial", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("year", "NIP", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("user_id_for_kaprodi", "Email", "trim|required", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed!'));
            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'title'          => htmlspecialchars($this->input->post('title')),
                    'abbreviation'          => htmlspecialchars($this->input->post('abbreviation')),
                    'accreditation'            => htmlspecialchars($this->input->post('accreditation')),
                    'year'                => htmlspecialchars($this->input->post('year')),
                    'user_id_for_kaprodi'              => htmlspecialchars($this->input->post('user_id_for_kaprodi')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_prodi->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' Add data Tracer Study Program Study', $this->session->userdata('id')));
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_prodi->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("title", "Full Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("abbreviation", "Nick Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("accreditation", "Initial", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("year", "NIP", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("user_id_for_kaprodi", "Email", "trim|required", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed!'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('program_study_id');
                $data = array(
                    'title'          => htmlspecialchars($this->input->post('title')),
                    'abbreviation'          => htmlspecialchars($this->input->post('abbreviation')),
                    'accreditation'            => htmlspecialchars($this->input->post('accreditation')),
                    'year'                => htmlspecialchars($this->input->post('year')),
                    'user_id_for_kaprodi'              => htmlspecialchars($this->input->post('user_id_for_kaprodi')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Model_prodi->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_user->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
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
