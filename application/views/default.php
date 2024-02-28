<?php
$data['js'] = $js;
$data['css'] = $css;

$this->load->view(VIEW_INCLUDE . '/header', $data);
echo '<div class="layout-wrapper layout-content-navbar">';
echo '<div class="layout-container">';
$this->load->view(VIEW_INCLUDE . '/navbar', $data);
echo '<div class="layout-page">';
$this->load->view(VIEW_INCLUDE . '/topbar', $data);
echo '<div class="content-wrapper">';
$this->load->view($content);
$this->load->view(VIEW_INCLUDE . '/footer', $data);