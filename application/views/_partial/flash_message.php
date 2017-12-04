<?php
    $success = $this->session->flashdata('success');
    $error   = $this->session->flashdata('error');
    $warning = $this->session->flashdata('warning');
    $info = $this->session->flashdata('info');

    if ($error) {
        $message_status = 'alert-error';
        $message = $error;
        $icon = 'fa-ban';
    }

    if ($warning) {
        $message_status = 'alert-warning';
        $message = $warning;
        $icon = 'fa-warning';
    }

    if ($success) {
        $message_status = 'alert-success';
        $message = $success;
        $icon = 'fa-check';
    }
    
    if ($info) {
        $message_status = 'alert-info';
        $message = $info;
        $icon = 'fa-info';
    }
?>

<?php if ($success || $warning || $error): ?>
    <div class="alert <?= $message_status ?> alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa <?= $icon ?>"></i> Alert! </h4>
        <?= $message ?>
    </div>
<?php endif ?>



