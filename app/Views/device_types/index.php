<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4"><?= $title ?></h1>

        <a href="<?= base_url('device-types/new') ?>" class="btn btn-primary mb-3">Tambah Device Type</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($deviceTypes)): ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($deviceTypes as $type): ?>
                        <tr>
                            <td><?= $type['id'] ?></td>
                            <td><?= esc($type['name']) ?></td>
                            <td><?= esc($type['description']) ?></td>
                            <td>
                                <a href="<?= base_url('device-types/' . $type['id']) ?>" class="btn btn-sm btn-info">Detail</a>
                                <a href="<?= base_url('device-types/' . $type['id'] . '/edit') ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= base_url('device-types/' . $type['id'] . '/delete') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>