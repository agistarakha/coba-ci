<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <h1 class="mb-4"><?= $title ?></h1>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Detail Device</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9"><?= $device['id'] ?></dd>

                    <dt class="col-sm-3">Device Type</dt>
                    <dd class="col-sm-9"><?= esc($device['device_type_name']) ?></dd>

                    <dt class="col-sm-3">Tenant</dt>
                    <dd class="col-sm-9"><?= esc($device['tenant_name'] ?? '-') ?></dd>

                    <dt class="col-sm-3">Nama Device</dt>
                    <dd class="col-sm-9"><?= esc($device['name']) ?></dd>

                    <dt class="col-sm-3">Spesifikasi</dt>
                    <dd class="col-sm-9"><?= esc($device['specification'] ?? '-') ?></dd>

                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">
                        <?php
                        $badgeClass = [
                            'active' => 'bg-success',
                            'inactive' => 'bg-secondary',
                            'maintenance' => 'bg-warning'
                        ];
                        $badge = $badgeClass[$device['status']] ?? 'bg-secondary';
                        ?>
                        <span class="badge <?= $badge ?>"><?= ucfirst($device['status']) ?></span>
                    </dd>

                    <dt class="col-sm-3">Dibuat</dt>
                    <dd class="col-sm-9"><?= $device['created_at'] ? date('d/m/Y H:i', strtotime($device['created_at'])) : '-' ?></dd>

                    <dt class="col-sm-3">Diupdate</dt>
                    <dd class="col-sm-9"><?= $device['updated_at'] ? date('d/m/Y H:i', strtotime($device['updated_at'])) : '-' ?></dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('devices/' . $device['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
                <a href="<?= base_url('devices') ?>" class="btn btn-secondary">Kembali</a>
                <a href="<?= base_url('devices/' . $device['id'] . '/delete') ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>