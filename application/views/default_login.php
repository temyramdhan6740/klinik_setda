<?php
$data['js'] = $js;
$data['css'] = $css;

$this->load->view(VIEW_INCLUDE . '/header_login', $data);
echo '<div class="authentication-wrapper authentication-cover">';
$this->load->view($content);
echo '</div>';
echo '</div>';
$this->load->view(VIEW_INCLUDE . '/footer', $data);