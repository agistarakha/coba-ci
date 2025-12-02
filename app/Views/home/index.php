<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="jumbotron bg-light p-5 rounded mb-4">
            <h1 class="display-4">Selamat Datang</h1>
            <p class="lead">Device Management System</p>
            <hr class="my-4">
            <p>Sistem manajemen device untuk mengelola device types dan devices dengan relasi database.</p>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Device Types</h5>
                        <p class="card-text">Kelola tipe-tipe device seperti Server, Router, Switch, dll.</p>
                        <a href="<?= base_url('device-types') ?>" class="btn btn-primary">Kelola Device Types</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Devices</h5>
                        <p class="card-text">Kelola devices dengan relasi ke device types.</p>
                        <a href="<?= base_url('devices') ?>" class="btn btn-primary">Kelola Devices</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tenants</h5>
                        <p class="card-text">Kelola tenants untuk mengelompokkan devices per organisasi atau pelanggan.</p>
                        <a href="<?= base_url('tenants') ?>" class="btn btn-primary">Kelola Tenants</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>