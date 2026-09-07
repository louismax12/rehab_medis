<div class="flex flex-col md:flex-row w-full max-w-[900px] bg-white rounded-xl shadow-2xl overflow-hidden min-h-[500px]">
    
    <!-- Left Side: Image and Branding -->
    <div class="md:w-1/2 relative bg-cover bg-center hidden md:block" style="background-image: url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/20"></div>
        
        <div class="absolute inset-0 p-8 flex flex-col justify-between z-10">
            <!-- Logo Top Left -->
            <div class="flex items-center gap-3">
                <img src="img/logo_rkz.png" alt="Logo RKZ" class="w-12 h-12 object-contain bg-white rounded-full p-1 shadow-md">
                <span class="text-white font-bold text-xl tracking-wide shadow-sm">Rehab RKZ</span>
            </div>
            
            <!-- Text Bottom Left -->
            <div class="text-white">
                <p class="text-sm leading-relaxed text-slate-200 font-medium">Sistem Manajemen Rehabilitasi Medis Terintegrasi.</p>
            </div>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center bg-white">
        
        <!-- Mobile Logo (shown only on small screens) -->
        <div class="flex items-center gap-3 mb-8 md:hidden">
            <img src="img/logo_rkz.png" alt="Logo RKZ" class="w-10 h-10 object-contain bg-white rounded-full p-1 shadow-sm border border-slate-100">
            <span class="text-slate-800 font-bold text-xl tracking-wide">Rehab RKZ</span>
        </div>
        
        <?php if(isset($error)): ?>
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm mb-6 flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>
        
        <form action="index.php?page=login" method="POST" class="space-y-6">
            <!-- NIP Field -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-700">Nomor Induk Karyawan / NIP</label>
                <div class="relative">
                    <i data-lucide="briefcase" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                    <input type="text" name="username" class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600/50 focus:border-blue-600 transition-all text-sm text-slate-800" required placeholder="Contoh: 12345678">
                </div>
            </div>
            
            <!-- Password Field -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-700">Kata Sandi</label>
                <div class="relative">
                    <i data-lucide="key" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                    <input type="password" name="password" id="password_input" class="w-full pl-10 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600/50 focus:border-blue-600 transition-all text-sm text-slate-800" required placeholder="Masukkan kata sandi">
                    <button type="button" id="toggle_password" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none">
                        <i data-lucide="eye-off" class="w-4 h-4" id="eye_icon"></i>
                    </button>
                </div>
            </div>
            
            <div class="pt-4">
                <button type="submit" class="w-full bg-[#004b8f] hover:bg-blue-800 text-white font-medium py-3 px-4 rounded-lg shadow-sm transition-colors flex items-center justify-center gap-2">
                    <span>Masuk Sistem</span>
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggle_password');
        const passInput = document.getElementById('password_input');
        const eyeIcon = document.getElementById('eye_icon');
        
        toggleBtn.addEventListener('click', function() {
            if (passInput.type === 'password') {
                passInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye');
            } else {
                passInput.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            }
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    });
</script>
