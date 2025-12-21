<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HIMAFI UNUD Kabinet Arunika Swakarsa</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/img/logo.jpg">
    <!-- Ikon untuk menu burger (dari Font Awesome via CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tambahkan kelas gradient yang digunakan di kode asli */
        .bg-linear-to-r {
            background-image: linear-gradient(to right, var(--tw-gradient-stops));
        }
        .bg-linear-to-t {
            background-image: linear-gradient(to top, var(--tw-gradient-stops));
        }
        .bg-linear-to-br {
            background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
        }
        .bg-linear-to-b {
            background-image: linear-gradient(to bottom, var(--tw-gradient-stops));
        }
        
        #mainHeader {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
        }
        
        #mainHeader.scrolled {
            backdrop-filter: blur(0);
            -webkit-backdrop-filter: blur(0);
        }
        
        /* Smooth transition untuk semua elemen header */
        #mainHeader * {
            transition: color 0.3s ease, border-color 0.3s ease, background-color 0.3s ease;
        }
        
        /* Custom styles untuk login page */
        .login-container {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .input-field {
            width: 100%;
            padding: 1rem 1.25rem 1rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 1.25rem;
        }
        
        .checkbox-input {
            appearance: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #d1d5db;
            border-radius: 0.375rem;
            margin-right: 0.75rem;
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .checkbox-input:checked {
            border-color: #3b82f6;
            background-color: #3b82f6;
        }
        
        .checkbox-input:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.875rem;
            font-weight: bold;
        }
        
        .social-login-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.875rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background: white;
        }
        
        .social-login-btn:hover {
            border-color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #6b7280;
            margin: 2rem 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .divider span {
            padding: 0 1rem;
        }
        
        /* Animasi untuk login */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Animasi untuk error */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #0891b2, #2563eb);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #0e7490, #1d4ed8);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Main Login Content dengan Background Image -->
<section class="relative min-h-screen flex items-center justify-center">
    <!-- Background Image -->
    <div class="fixed inset-0 z-0">
        <img 
            src="/img/homeimg.png" 
            alt="Kabinet Arunika Swakarsa" 
            class="w-full h-full object-cover"
        >
        <!-- Overlay gradient untuk keterbacaan -->
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 py-8">
        <div class="max-w-md mx-auto fade-in">
            <!-- Login Container -->
            <div class="login-container">
                <!-- Header -->
                <div class="bg-gradient-to-r from-cyan-600 to-blue-600 p-8 text-white text-center">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-user-lock text-3xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold mb-2">Selamat Datang Kembali</h1>
                    <p class="text-cyan-100">Masuk ke akun HIMAFI UNUD Anda</p>
                </div>
                
                <!-- Form Login -->
                <div class="p-8">
                    <form id="loginForm">
                        <!-- Email Input -->
                        <div class="input-group">
                            <i class="fas fa-envelope input-icon"></i>
                            <input 
                                type="email" 
                                id="email" 
                                class="input-field" 
                                placeholder="Email atau NIM" 
                                required
                                autocomplete="email"
                            >
                        </div>
                        
                        <!-- Password Input -->
                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input 
                                type="password" 
                                id="password" 
                                class="input-field" 
                                placeholder="Kata sandi" 
                                required
                                autocomplete="current-password"
                            >
                            <button type="button" id="togglePassword" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        
                        <!-- Remember Me & Forgot Password -->
                        <div class="flex justify-between items-center mb-6">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" id="rememberMe" class="checkbox-input">
                                <span class="text-gray-700">Ingat saya</span>
                            </label>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                Lupa kata sandi?
                            </a>
                        </div>
                        
                        <!-- Error Message -->
                        <div id="errorMessage" class="hidden mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span id="errorText">Email atau kata sandi salah. Silakan coba lagi.</span>
                        </div>
                        
                        <!-- Login Button -->
                        <button type="submit" id="loginButton" class="w-full bg-gradient-to-r from-cyan-500 to-blue-500 text-white py-4 rounded-full font-bold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 mb-6">
                            <span id="buttonText">Masuk ke Akun</span>
                            <span id="buttonLoading" class="hidden">
                                <i class="fas fa-spinner fa-spin mr-2"></i> Memproses...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="/" class="text-white hover:text-cyan-300 text-sm">
                    <i class="fas fa-home mr-1"></i> Beranda
                </a>
                <a href="#" class="text-white hover:text-cyan-300 text-sm">
                    <i class="fas fa-question-circle mr-1"></i> Bantuan
                </a>

            </div>
        </div>
    </div>
</section>

<!-- Tombol Back to Top -->
<button id="backToTop" class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-br from-blue-600 to-cyan-500 text-white rounded-full shadow-2xl hover:shadow-cyan-500/30 hover:scale-110 transition-all duration-300 z-40 hidden items-center justify-center text-2xl">
    <i class="fas fa-chevron-up"></i>
</button>

    <!-- Skrip JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Header scroll effect
            const header = document.getElementById('mainHeader');
            const menuBtn = document.getElementById('menuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const backToTopBtn = document.getElementById('backToTop');
            
            // Form elements
            const loginForm = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('togglePassword');
            const rememberMeCheckbox = document.getElementById('rememberMe');
            const loginButton = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            const buttonLoading = document.getElementById('buttonLoading');
            const errorMessage = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');
            
            // Fungsi untuk update header berdasarkan scroll
            function updateHeaderOnScroll() {
                if (window.scrollY > 50) {
                    // Saat di-scroll (lebih dari 50px)
                    header.classList.remove('bg-transparent');
                    header.classList.add('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                    
                    // Update teks navigasi desktop
                    const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                    desktopLinks.forEach(link => {
                        if (link.getAttribute('href') === 'login.html') {
                            link.classList.remove('text-white', 'border-cyan-300');
                            link.classList.add('text-blue-600', 'border-blue-600');
                        } else {
                            link.classList.remove('text-white/90', 'hover:text-white');
                            link.classList.add('text-gray-600', 'hover:text-blue-600');
                        }
                    });
                    
                    // Update tombol mobile menu
                    if (menuBtn) {
                        menuBtn.classList.remove('text-white');
                        menuBtn.classList.add('text-gray-700');
                    }
                    
                } else {
                    // Saat di atas (posisi awal)
                    header.classList.add('bg-transparent');
                    header.classList.remove('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                    
                    // Update teks navigasi desktop
                    const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                    desktopLinks.forEach(link => {
                        if (link.getAttribute('href') === 'login.html') {
                            link.classList.add('text-white', 'border-cyan-300');
                            link.classList.remove('text-blue-600', 'border-blue-600');
                        } else {
                            link.classList.add('text-white/90', 'hover:text-white');
                            link.classList.remove('text-gray-600', 'hover:text-blue-600');
                        }
                    });
                    
                    // Update tombol mobile menu
                    if (menuBtn) {
                        menuBtn.classList.add('text-white');
                        menuBtn.classList.remove('text-gray-700');
                    }
                }
                
                // Back to Top Button visibility
                if (window.scrollY > 300) {
                    backToTopBtn.classList.remove('hidden');
                    backToTopBtn.classList.add('flex');
                } else {
                    backToTopBtn.classList.add('hidden');
                    backToTopBtn.classList.remove('flex');
                }
            }
            
            // Toggle Mobile Menu
            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileMenu.classList.toggle('hidden');
                    const icon = menuBtn.querySelector('i');
                    if (mobileMenu.classList.contains('hidden')) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    } else {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    }
                });
                
                // Close mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenu.classList.contains('hidden') && 
                        !mobileMenu.contains(event.target) && 
                        !menuBtn.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                        const icon = menuBtn.querySelector('i');
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }
            
            // Back to Top Button functionality
            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            
            // Toggle password visibility
            togglePasswordBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle icon
                const icon = this.querySelector('i');
                if (type === 'text') {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
            
            // Form submission
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Hide any previous error messages
                errorMessage.classList.add('hidden');
                
                // Get form values
                const email = emailInput.value.trim();
                const password = passwordInput.value;
                const rememberMe = rememberMeCheckbox.checked;
                
                // Basic validation
                if (!email || !password) {
                    showError('Harap isi email dan kata sandi.');
                    return;
                }
                
                // Validate email format (accepts email or NIM)
                if (!isValidEmailOrNIM(email)) {
                    showError('Format email atau NIM tidak valid.');
                    return;
                }
                
                // Show loading state
                buttonText.classList.add('hidden');
                buttonLoading.classList.remove('hidden');
                loginButton.disabled = true;
                
                // Simulate API call
                setTimeout(() => {
                    // For demo purposes, accept specific credentials
                    if ((email === 'demo@himafi.unud.ac.id' || email === '2201234567') && password === 'password123') {
                        // Login successful
                        loginSuccess(email, rememberMe);
                    } else {
                        // Login failed
                        loginFailed();
                    }
                    
                    // Reset button state
                    buttonText.classList.remove('hidden');
                    buttonLoading.classList.add('hidden');
                    loginButton.disabled = false;
                }, 1500);
            });
            
            function isValidEmailOrNIM(input) {
                // Check if it's an email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailRegex.test(input)) {
                    return true;
                }
                
                // Check if it's a NIM (10 digits)
                const nimRegex = /^\d{10}$/;
                if (nimRegex.test(input)) {
                    return true;
                }
                
                return false;
            }
            
            function showError(message) {
                errorText.textContent = message;
                errorMessage.classList.remove('hidden');
                
                // Add shake animation to form
                loginForm.classList.add('shake');
                setTimeout(() => {
                    loginForm.classList.remove('shake');
                }, 500);
            }
            
            function loginSuccess(email, rememberMe) {
                // Show success message
                showNotification('Login berhasil! Mengarahkan ke dashboard...', 'success');
                
                // Save to localStorage if remember me is checked
                if (rememberMe) {
                    localStorage.setItem('rememberedEmail', email);
                } else {
                    localStorage.removeItem('rememberedEmail');
                }
                
                // Set a fake token for demo purposes
                sessionStorage.setItem('authToken', 'demo_token_' + Date.now());
                
                // Redirect to dashboard after 1 second
                setTimeout(() => {
                    window.location.href = 'dashboard.html';
                }, 1000);
            }
            
            function loginFailed() {
                showError('Email/NIM atau kata sandi salah. Silakan coba lagi.');
                
                // Clear password field
                passwordInput.value = '';
                passwordInput.focus();
            }
            
            // Check for remembered email
            const rememberedEmail = localStorage.getItem('rememberedEmail');
            if (rememberedEmail) {
                emailInput.value = rememberedEmail;
                rememberMeCheckbox.checked = true;
            }
            
            // Social login buttons
            document.querySelectorAll('.social-login-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const provider = this.querySelector('span').textContent;
                    showNotification(`Login dengan ${provider} belum tersedia di versi demo.`, 'info');
                });
            });
            
            // Forgot password link
            document.querySelector('a[href="#"]').addEventListener('click', function(e) {
                e.preventDefault();
                showNotification('Fitur reset password belum tersedia di versi demo.', 'info');
            });
            
            // Notification function
            function showNotification(message, type) {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full`;
                
                // Set styles based on type
                if (type === 'success') {
                    notification.className += ' bg-gradient-to-r from-emerald-500 to-green-500 text-white';
                } else if (type === 'info') {
                    notification.className += ' bg-gradient-to-r from-blue-500 to-cyan-500 text-white';
                } else if (type === 'error') {
                    notification.className += ' bg-gradient-to-r from-red-500 to-pink-500 text-white';
                }
                
                // Add icon based on type
                let icon = 'info-circle';
                if (type === 'success') icon = 'check-circle';
                if (type === 'error') icon = 'exclamation-circle';
                
                notification.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-${icon} mr-3"></i>
                        <span>${message}</span>
                        <button class="ml-4 text-white hover:text-gray-200" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                
                // Add to document
                document.body.appendChild(notification);
                
                // Animate in
                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                    notification.classList.add('translate-x-0');
                }, 10);
                
                // Remove after 5 seconds
                setTimeout(() => {
                    notification.classList.remove('translate-x-0');
                    notification.classList.add('translate-x-full');
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 300);
                }, 5000);
            }
            
            // Event listener untuk scroll
            window.addEventListener('scroll', updateHeaderOnScroll);
            
            // Jalankan sekali saat load
            updateHeaderOnScroll();
        });
    </script>
</body>
</html>