<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library Management System')</title>
    
    <!-- PWA Meta Tags -->
    <meta name="description" content="A modern library management system with offline capabilities">
    <meta name="theme-color" content="#00ffff">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="LibraryMS">
    <meta name="msapplication-TileColor" content="#00ffff">
    <meta name="msapplication-config" content="/browserconfig.xml">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    
    <!-- Favicon and Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-touch-icon.png') }}">
    
    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-book-open"></i> Library Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"><span></span></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                            <i class="fas fa-book"></i> Books
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            <i class="fas fa-tags"></i> Categories
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item me-2">
                        <button id="theme-toggle" class="btn btn-outline-secondary btn-sm" type="button" title="Toggle Theme">
                            <i class="fas fa-moon"></i>
                        </button>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-plus"></i> Quick Add
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('books.create') }}">
                                <i class="fas fa-book"></i> Add Book
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('categories.create') }}">
                                <i class="fas fa-tag"></i> Add Category
                            </a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <span class="navbar-text">
                            <i class="fas fa-clock"></i> <span id="navbar-time">{{ now()->format('h:i A') }}</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="navbar-text" id="online-status">
                            <i class="fas fa-wifi"></i> Online
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="navbar-text">
                            <i class="fas fa-user-circle"></i> Admin
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cyberpunk Visual Effects -->
    <div class="cyberpunk-overlay" aria-hidden="true">
        <div class="data-stream" style="left: 10%; animation-delay: 0s;"></div>
        <div class="data-stream" style="left: 30%; animation-delay: 2s;"></div>
        <div class="data-stream" style="left: 50%; animation-delay: 4s;"></div>
        <div class="data-stream" style="left: 70%; animation-delay: 6s;"></div>
        <div class="data-stream" style="left: 90%; animation-delay: 8s;"></div>
    </div>
    
    <div class="cyber-grid" aria-hidden="true"></div>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Breadcrumbs -->
        @if(!request()->routeIs('dashboard'))
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    @yield('breadcrumbs')
                </ol>
            </nav>
        @endif

        @yield('content')
    </div>

    

    

    <!-- Floating Action Button -->
    <div class="cyber-fab-container">
        <div class="cyber-fab-main">
            <i class="fas fa-plus"></i>
        </div>
        <div class="cyber-fab-options">
            <a href="{{ route('books.create') }}" class="cyber-fab-option" title="Add Book">
                <i class="fas fa-book"></i>
            </a>
            <a href="{{ route('categories.create') }}" class="cyber-fab-option" title="Add Category">
                <i class="fas fa-tag"></i>
            </a>
            <a href="{{ route('dashboard') }}" class="cyber-fab-option" title="Dashboard">
                <i class="fas fa-home"></i>
            </a>
        </div>
    </div>

    

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Service Worker Registration for Offline Functionality
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js')
                    .then(function(registration) {
                        console.log('Service Worker registered successfully:', registration.scope);
                        
                        // Check for updates
                        registration.addEventListener('updatefound', function() {
                            const newWorker = registration.installing;
                            newWorker.addEventListener('statechange', function() {
                                if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                    // New content is available, show update notification
                                    showUpdateNotification();
                                }
                            });
                        });
                    })
                    .catch(function(error) {
                        console.log('Service Worker registration failed:', error);
                    });
            });
        }

        // Show update notification
        function showUpdateNotification() {
            if (confirm('A new version of the Library Management System is available. Would you like to update?')) {
                window.location.reload();
            }
        }

        // Offline/Online status indicator
        function updateOnlineStatus() {
            const isOnline = navigator.onLine;
            const statusElement = document.getElementById('online-status');
            
            if (statusElement) {
                if (isOnline) {
                    statusElement.innerHTML = '<i class="fas fa-wifi"></i> Online';
                    statusElement.className = 'navbar-text text-success';
                } else {
                    statusElement.innerHTML = '<i class="fas fa-wifi-slash"></i> Offline';
                    statusElement.className = 'navbar-text text-warning';
                }
            }
        }

        // Listen for online/offline events
        window.addEventListener('online', updateOnlineStatus);
        window.addEventListener('offline', updateOnlineStatus);

        // Cyberpunk Floating Action Button functionality
        document.addEventListener('DOMContentLoaded', function() {
            const fabMain = document.querySelector('.cyber-fab-main');
            const fabOptions = document.querySelector('.cyber-fab-options');
            
            if (fabMain && fabOptions) {
                fabMain.addEventListener('click', function() {
                    fabOptions.classList.toggle('active');
                    fabMain.classList.toggle('active');
                });
                
                // Close FAB when clicking outside
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.cyber-fab-container')) {
                        fabOptions.classList.remove('active');
                        fabMain.classList.remove('active');
                    }
                });
            }
            
            // Initialize online status
            updateOnlineStatus();
            
            // Real-time clock for navbar
            function updateNavbarTime() {
                const now = new Date();
                const timeOptions = { 
                    hour: 'numeric', 
                    minute: '2-digit',
                    hour12: true 
                };
                const formattedTime = now.toLocaleTimeString('en-US', timeOptions);
                
                const timeElement = document.getElementById('navbar-time');
                if (timeElement) {
                    timeElement.textContent = formattedTime;
                }
            }
            
            // Update immediately
            updateNavbarTime();
            
            // Update every minute
            setInterval(updateNavbarTime, 60000);

            // Removed command palette overlay per request

            // Quick search focus with '/'
            document.addEventListener('keydown', (e) => {
                if (e.key === '/' && !e.ctrlKey && !e.metaKey && !e.altKey) {
                    const activeTag = document.activeElement && document.activeElement.tagName.toLowerCase();
                    const isTyping = activeTag === 'input' || activeTag === 'textarea';
                    if (!isTyping && !kbarOverlay.classList.contains('active')) {
                        const search = document.querySelector('input[name="search"]');
                        if (search) {
                            e.preventDefault();
                            search.focus();
                        }
                    }
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
