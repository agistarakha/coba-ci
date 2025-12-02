<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <h1 class="mb-4"><?= $title ?></h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><?= esc($tenant['name']) ?></h5>
                <p class="card-text"><strong>Email:</strong> <?= esc($tenant['email']) ?></p>
                <p class="card-text"><strong>Phone:</strong> <?= esc($tenant['phone']) ?></p>
                <p class="card-text"><strong>Address:</strong> <?= nl2br(esc($tenant['address'])) ?></p>
                <p class="card-text"><strong>Status:</strong> <?= esc($tenant['status']) ?></p>
                <a href="<?= base_url('tenants/' . $tenant['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
                <a href="<?= base_url('tenants') ?>" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <h4>Devices milik tenant</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($devices)): ?>
                    <tr><td colspan="5">Tidak ada device</td></tr>
                <?php else: ?>
                    <?php foreach ($devices as $d): ?>
                        <tr>
                            <td><?= $d['id'] ?></td>
                            <td><?= esc($d['name']) ?></td>
                            <td><?= isset($d['device_type_name']) ? esc($d['device_type_name']) : esc($d['device_type_id']) ?></td>
                            <td><?= esc($d['status']) ?></td>
                            <td>
                                <a href="<?= base_url('devices/' . $d['id']) ?>" class="btn btn-sm btn-info">Show</a>
                                <a href="<?= base_url('devices/' . $d['id'] . '/edit') ?>" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
