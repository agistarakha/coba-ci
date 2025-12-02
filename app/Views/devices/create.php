<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <h1 class="mb-4"><?= $title ?></h1>

        <form action="<?= base_url('devices/create') ?>" method="post" id="deviceForm">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="device_type_id" class="form-label">Device Type <span class="text-danger">*</span></label>
                <select class="form-select" id="device_type_id" name="device_type_id" required>
                    <option value="">Loading...</option>
                </select>
                <div id="device-type-error" class="text-danger d-none"></div>
            </div>

            <div class="mb-3">
                <label for="tenant_id" class="form-label">Tenant <span class="text-danger">*</span></label>
                <select class="form-select" id="tenant_id" name="tenant_id" required>
                    <option value="">Pilih Tenant</option>
                    <?php if (isset($tenants) && is_array($tenants)): ?>
                        <?php foreach ($tenants as $tenant): ?>
                            <option value="<?= $tenant['id'] ?>" <?= old('tenant_id') == $tenant['id'] ? 'selected' : '' ?>><?= esc($tenant['name']) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nama Device <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?= old('name') ?>" required>
            </div>

            <div class="mb-3">
                <label for="specification" class="form-label">Spesifikasi</label>
                <textarea class="form-control" id="specification" name="specification" rows="3"><?= old('specification') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select" id="status" name="status" required>
                    <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    <option value="maintenance" <?= old('status') == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('devices') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
let isLoadingDeviceTypes = false;
let lastFetchTime = 0;
const FETCH_DEBOUNCE = 300; // Debounce 300ms

// Load device types dari API saat halaman load
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('device_type_id');
    
    // Load saat halaman pertama kali dimuat
    loadDeviceTypes();
    
    // Load setiap kali user akan membuka dropdown
    // Gunakan focus karena lebih reliable untuk dropdown
    select.addEventListener('focus', function() {
        const now = Date.now();
        // Debounce untuk menghindari multiple calls
        if (now - lastFetchTime > FETCH_DEBOUNCE) {
            loadDeviceTypes();
            lastFetchTime = now;
        }
    });
    
    // Juga load saat click (untuk memastikan)
    select.addEventListener('click', function() {
        const now = Date.now();
        if (now - lastFetchTime > FETCH_DEBOUNCE) {
            loadDeviceTypes();
            lastFetchTime = now;
        }
    });
});

async function loadDeviceTypes() {
    // Prevent multiple simultaneous calls
    if (isLoadingDeviceTypes) {
        return;
    }
    
    isLoadingDeviceTypes = true;
    const select = document.getElementById('device_type_id');
    const errorDiv = document.getElementById('device-type-error');
    
    // Simpan nilai yang sedang dipilih sebelum reload
    const currentValue = select.value;
    
    // Tampilkan loading indicator tanpa disable select (biarkan dropdown bisa dibuka)
    const wasEmpty = select.options.length === 0 || (select.options.length === 1 && select.options[0].value === '');
    
    try {
        const response = await fetch('<?= base_url('api/device-types') ?>');
        const result = await response.json();
        
        console.log('API Response:', result); // Debug log
        
        if (result.status === 'success' && result.data) {
            // Clear dan rebuild options
            select.innerHTML = '<option value="">Pilih Device Type</option>';
            
            // Pastikan data adalah array
            const deviceTypes = Array.isArray(result.data) ? result.data : [];
            
            if (deviceTypes.length === 0) {
                select.innerHTML = '<option value="">Tidak ada data</option>';
            } else {
                deviceTypes.forEach(deviceType => {
                    const option = document.createElement('option');
                    option.value = deviceType.id;
                    option.textContent = deviceType.name;
                    
                    // Set selected berdasarkan old value atau nilai yang sedang dipilih
                    const oldValue = <?= old('device_type_id') ? old('device_type_id') : 'null' ?>;
                    const valueToSelect = oldValue !== null ? oldValue : currentValue;
                    
                    if (deviceType.id == valueToSelect) {
                        option.selected = true;
                    }
                    
                    select.appendChild(option);
                });
            }
            
            errorDiv.classList.add('d-none');
            console.log('Options loaded:', select.options.length); // Debug log
        } else {
            throw new Error(result.message || 'Gagal mengambil data');
        }
    } catch (error) {
        console.error('Error:', error);
        select.innerHTML = '<option value="">Error loading device types</option>';
        errorDiv.textContent = 'Gagal memuat device types: ' + error.message;
        errorDiv.classList.remove('d-none');
    } finally {
        isLoadingDeviceTypes = false;
    }
}
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>