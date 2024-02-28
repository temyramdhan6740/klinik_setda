<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Coba extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('m_coba', 'coba');
        if (!is_logged_in()) {
            redirect('login');
        }
    }

    public function generate_token()
    {
        $clientId = 'rUbjfG6yVC2laALfwmR0cGlnnonR8KKmmMqUNIzdAfT09P8F';
        $clientSecret = 'USkmGmHlUfH831GkIugePT5tf7ZcfS6RAjEi2NIGOaxMFKI5wv5KbVDDOR2Ki0Au';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-satusehat-dev.dto.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'client_id=' . $clientId . '&client_secret=' . $clientSecret . '',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $res = json_decode($response, 0);
        return $res->access_token;
    }

    public function index()
    {
        $data['js'] = 'js';
        $data['css'] = 'css';
        $data['content'] = 'coba';
        $data['dokter'] = $this->coba->get_dokter();
        $data['lokasi'] = $this->coba->get_lokasi();
        $this->load->view('default', $data);
    }

    public function list()
    {
        $data['js'] = 'js';
        $data['css'] = 'css';
        $data['content'] = 'coba2';
        $data['dokter'] = $this->coba->get_dokter();
        $data['lokasi'] = $this->coba->get_lokasi();
        $this->load->view('default', $data);
    }


    public function get_pasien_fire()
    {
        $nik = $this->input->post('nik');
        $url = 'https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Patient?identifier=https://fhir.kemkes.go.id/id/nik|' . $nik;

        $token = $this->generate_token();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $token"
            ),
        ));

        $response = curl_exec($curl);
        $res = json_decode($response, true);
        // $info = curl_getinfo($curl);
        // print_r($info);

        curl_close($curl);
        if (isset($res['total'])) {

            $his =  $res['entry'][0]['resource']['id'];
            $this->coba->update_fire($nik, $his);

            echo json_encode($res);
        }
    }

    public function post_encounter()
    {
        $code_class = "AMB";
        $display_class = "ambulatory";

        $pasien_id = "P00076560468";
        $pasien_display = "Budi Santoso";

        $dokter_id = $this->input->post('dokter');
        $dokter_display = $this->input->post('dokter_name');

        $location_id = $this->input->post('lokasi');
        $location_display = $this->input->post('lokasi_name');
        $organisasi_id = "10084120";
        $trans_code = "RJ" . rand();
        $token = $this->generate_token();

        $arrived_time = $this->input->post('arrvied') . ':00+07:00';
        $inprogress_time = $this->input->post('inprogress') . ':00+07:00';
        $finished_time = $this->input->post('finished') . ':00+07:00';


        $array_param = [
            "resourceType" => "Encounter",
            "status" => "finished",
            "class" => [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code" => "$code_class",
                "display" => "$display_class"
            ],
            "subject" => [
                "reference" => "Patient/$pasien_id",
                "display" => "$pasien_display"
            ],
            "participant" => [
                [
                    "type" => [
                        [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code" => "ATND",
                                    "display" => "attender"
                                ]
                            ]
                        ]
                    ],
                    "individual" => [
                        "reference" => "Practitioner/$dokter_id",
                        "display" => "$dokter_display"
                    ]
                ]
            ],
            "period" => [
                "start" => date('Y-m-d') . "T" . date('H:i:s') . "+07:00"
            ],
            "location" => [
                [
                    "location" => [
                        "reference" => "Location/$location_id",
                        "display" => "$location_display"
                    ]
                ]
            ],
            "statusHistory" => [
                [
                    "status" => "arrived",
                    "period" => [
                        "start" => "$arrived_time",
                        "end" => "$arrived_time"
                    ],
                    "status" => "in-progress",
                    "period" => [
                        "start" => "$inprogress_time",
                        "end" => "$inprogress_time"
                    ],
                    "status" => "finished",
                    "period" => [
                        "start" => "$finished_time",
                        "end" => "$finished_time"
                    ]
                ]
            ],
            "serviceProvider" => [
                "reference" => "Organization/$organisasi_id"
            ],
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/encounter/10084120",
                    "value" => "$trans_code"
                ]
            ]
        ];



        $param_json = json_encode($array_param);


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Encounter',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $param_json,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $res = json_decode($response, true);
        $info = curl_getinfo($curl);
        // print_r($info);

        curl_close($curl);
        if ($info['http_code'] == 201) {
            $encounter_id = $res['id'];
            $insert = $this->coba->insert_encounter($encounter_id, $pasien_id, $location_id, $trans_code);
            echo json_encode($insert);
        }
    }

    public function post_condition()
    {
        $token = $this->generate_token();
        $diag = $this->input->post('diag');
        $pasien_id = "P00076560468";
        $icd = $this->input->post('icd');
        $encounter_id = $this->input->post('encounter_id');
        $array_param = [
            "resourceType" => "Condition",
            "clinicalStatus" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                        "code" => "active",
                        "display" => "Active"
                    ]
                ]
            ],
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                            "code" => "encounter-diagnosis",
                            "display" => "Encounter Diagnosis"
                        ]
                    ]
                ]
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://hl7.org/fhir/sid/icd-10",
                        "code" => "$icd",
                        "display" => "$diag"
                    ]
                ]
            ],
            "subject" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/$encounter_id",
                "display" => "Kunjungan Budi Santoso di " . date('Y-m-d')
            ]
        ];

        $param_json = json_encode($array_param);


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Condition',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $param_json,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $res = json_decode($response, true);
        $info = curl_getinfo($curl);
        // print_r($info);

        curl_close($curl);
        if ($info['http_code'] == 201) {
            $condition_id = $res['id'];
            $insert = $this->coba->insert_condition($condition_id, $encounter_id, $pasien_id);
            echo json_encode($insert);
        }
    }

    public function get_list_diagnosa()
    {
        $param = $this->input->post('search');
        $result = $this->coba->get_list_diagnosa($param);
        if ($result) {
            foreach ($result as $key) {
                $response[] = array(
                    "id" => $key->kode,
                    "text" => $key->nama
                );
            }
            echo json_encode($response);
        }
    }

    public function put_encounter()
    {
        $encounter_id = $this->input->post('encounter_id');
        $pasien_id = '100000030009';
        $pasien_name = 'Budi Santoso';
        $organisasi_id = "10084120";

        $dokter_id = $this->input->post('dokter');
        $dokter_display = $this->input->post('dokter_name');

        $location_id = $this->input->post('lokasi');
        $location_display = $this->input->post('lokasi_name');
        $condition_id = $this->input->post('condition_id');
        $condition_name = $this->input->post('condition_name');
        $arrived_time = $this->input->post('arrvied') . ':00+07:00';
        $inprogress_time = $this->input->post('inprogress') . ':00+07:00';
        $finished_time = $this->input->post('finished') . ':00+07:00';
        $token = $this->generate_token();
        $trans_code = "RJ" . rand();


        $array_param = [
            "resourceType" => "Encounter",
            "id" => "$encounter_id",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/encounter/$organisasi_id",
                    "value" => "$trans_code"
                ]
            ],
            "status" => "finished",
            "class" => [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code" => "AMB",
                "display" => "ambulatory"
            ],
            "subject" => [
                "reference" => "Patient/$pasien_id",
                "display" => "$pasien_name"
            ],
            "participant" => [
                [
                    "type" => [
                        [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code" => "ATND",
                                    "display" => "attender"
                                ]
                            ]
                        ]
                    ],
                    "individual" => [
                        "reference" => "Practitioner/$dokter_id",
                        "display" => "$dokter_display"
                    ]
                ]
            ],
            "period" => [
                "start" => date('Y-m-d') . "T" . date('H:i:s') . "+07:00",
                "end" => date('Y-m-d') . "T" . date('H:i:s') . "+07:00"
            ],
            "location" => [
                [
                    "location" => [
                        "reference" => "Location/$location_id",
                        "display" => "$location_display"
                    ]
                ]
            ],
            "diagnosis" => [
                [
                    "condition" => [
                        "reference" => "Condition/$condition_id",
                        "display" => "$condition_name"
                    ],
                    "use" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                "code" => "DD",
                                "display" => "Discharge diagnosis"
                            ]
                        ]
                    ],
                    "rank" => 1
                ]
            ],
            "statusHistory" => [
                [
                    "status" => "arrived",
                    "period" => [
                        "start" => "$arrived_time",
                        "end" => "$arrived_time"
                    ],
                    "status" => "in-progress",
                    "period" => [
                        "start" => "$inprogress_time",
                        "end" => "$inprogress_time"
                    ],
                    "status" => "finished",
                    "period" => [
                        "start" => "$finished_time",
                        "end" => "$finished_time"
                    ]
                ]
            ],
            "serviceProvider" => [
                "reference" => "Organization/$organisasi_id"
            ]
        ];

        $param = json_encode($array_param);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Encounter/$encounter_id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $param,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token",
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        echo $response;
    }

    public function get_encounter_subject()
    {
        $token = $this->generate_token();
        $curl = curl_init();
        $his = $this->input->post('his');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Encounter?subject=$his",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $res = json_decode($response, true);
        $total_data = count($res['entry']);
        if ($total_data > 0) {
            echo json_encode($res['entry']);
            // for ($i = 0; $i < $total_data; $i++) {
            //     echo json_encode($res['entry'][$i]);
            // }
        }
    }

    public function get_condition()
    {
        $token = $this->generate_token();
        $encounter_id = $this->input->post('encounter_id');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Condition?encounter=$encounter_id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token"
            ),
        ));

        $response = curl_exec($curl);

        $res = json_decode($response, true);
        if ($res['total'] > 0) {
            echo json_encode($res['entry']);
        }
    }
}