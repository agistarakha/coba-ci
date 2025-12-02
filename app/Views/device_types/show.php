<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <h1 class="mb-4"><?= $title ?></h1>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Detail Device Type</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9"><?= $deviceType['id'] ?></dd>

                    <dt class="col-sm-3">Nama</dt>
                    <dd class="col-sm-9"><?= esc($deviceType['name']) ?></dd>

                    <dt class="col-sm-3">Deskripsi</dt>
                    <dd class="col-sm-9"><?= esc($deviceType['description'] ?? '-') ?></dd>

                    <dt class="col-sm-3">Dibuat</dt>
                    <dd class="col-sm-9"><?= $deviceType['created_at'] ? date('d/m/Y H:i', strtotime($deviceType['created_at'])) : '-' ?></dd>

                    <dt class="col-sm-3">Diupdate</dt>
                    <dd class="col-sm-9"><?= $deviceType['updated_at'] ? date('d/m/Y H:i', strtotime($deviceType['updated_at'])) : '-' ?></dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('device-types/' . $deviceType['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
                <a href="<?= base_url('device-types') ?>" class="btn btn-secondary">Kembali</a>
                <a href="<?= base_url('device-types/' . $deviceType['id'] . '/delete') ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>