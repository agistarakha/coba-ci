<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <h1 class="mb-4"><?= $title ?></h1>

        <form action="<?= base_url('devices/' . $device['id'] . '/update') ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="device_type_id" class="form-label">Device Type <span class="text-danger">*</span></label>
                <select class="form-select" id="device_type_id" name="device_type_id" required>
                    <option value="">Pilih Device Type</option>
                    <?php foreach ($deviceTypes as $type): ?>
                        <option value="<?= $type['id'] ?>" 
                                <?= old('device_type_id', $device['device_type_id']) == $type['id'] ? 'selected' : '' ?>>
                            <?= esc($type['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="tenant_id" class="form-label">Tenant <span class="text-danger">*</span></label>
                <select class="form-select" id="tenant_id" name="tenant_id" required>
                    <option value="">Pilih Tenant</option>
                    <?php if (isset($tenants) && is_array($tenants)): ?>
                        <?php foreach ($tenants as $tenant): ?>
                            <option value="<?= $tenant['id'] ?>" 
                                    <?= old('tenant_id', $device['tenant_id']) == $tenant['id'] ? 'selected' : '' ?> >
                                <?= esc($tenant['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nama Device <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?= old('name', $device['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="specification" class="form-label">Spesifikasi</label>
                <textarea class="form-control" id="specification" name="specification" rows="3"><?= old('specification', $device['specification']) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select" id="status" name="status" required>
                    <option value="active" <?= old('status', $device['status']) == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= old('status', $device['status']) == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    <option value="maintenance" <?= old('status', $device['status']) == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('devices') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>