<?php
require_once __DIR__ . '/includes/auth.php';
admin_logout();
header('Location: ' . admin_base_path() . '/admin/login.php');
exit;
