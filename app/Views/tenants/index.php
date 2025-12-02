<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4"><?= $title ?></h1>
        <a href="<?= base_url('tenants/new') ?>" class="btn btn-primary mb-3">Tambah Tenant</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Device Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tenants as $t): ?>
                    <tr>
                        <td><?= $t['id'] ?></td>
                        <td><?= esc($t['name']) ?></td>
                        <td><?= esc($t['email']) ?></td>
                        <td><?= esc($t['phone']) ?></td>
                        <td><?= esc($t['status']) ?></td>
                        <td><?= isset($t['device_count']) ? $t['device_count'] : 0 ?></td>
                        <td>
                            <a href="<?= base_url('tenants/' . $t['id']) ?>" class="btn btn-sm btn-info">Show</a>
                            <a href="<?= base_url('tenants/' . $t['id'] . '/edit') ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= base_url('tenants/' . $t['id'] . '/delete') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus tenant ini?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
