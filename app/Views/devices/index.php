<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4"><?= $title ?></h1>

        <a href="<?= base_url('devices/new') ?>" class="btn btn-primary mb-3">Tambah Device</a>
        <a href="<?= base_url('device-types') ?>" class="btn btn-secondary mb-3">Kelola Device Types</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Device Type</th>
                    <th>Tenant</th>
                    <th>Nama Device</th>
                    <th>Spesifikasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($devices)): ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($devices as $device): ?>
                        <tr>
                            <td><?= $device['id'] ?></td>
                            <td><?= esc($device['device_type_name']) ?></td>
                            <td><?= esc($device['tenant_name'] ?? '-') ?></td>
                            <td><?= esc($device['name']) ?></td>
                            <td><?= esc($device['specification']) ?></td>
                            <td>
                                <?php
                                $badgeClass = [
                                    'active' => 'bg-success',
                                    'inactive' => 'bg-secondary',
                                    'maintenance' => 'bg-warning'
                                ];
                                $badge = $badgeClass[$device['status']] ?? 'bg-secondary';
                                ?>
                                <span class="badge <?= $badge ?>"><?= ucfirst($device['status']) ?></span>
                            </td>
                            <td>
                                <a href="<?= base_url('devices/' . $device['id']) ?>" class="btn btn-sm btn-info">Detail</a>
                                <a href="<?= base_url('devices/' . $device['id'] . '/edit') ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= base_url('devices/' . $device['id'] . '/delete') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>