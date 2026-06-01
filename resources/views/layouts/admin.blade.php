<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Datatables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">

    {{-- Select2 / Dropzone --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">

    {{-- Admin CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin-form.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin-list.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin-show.css') }}">

    @yield('styles')
</head>

<body>
@php
    $adminImportantLinks = \App\Models\ImportantLink::where('status', 1)->orderBy('sort_order')->get();
    $adminNotifications = \App\Models\AdminNotification::latest()->take(8)->get();
    $adminUnreadNotifications = $adminNotifications->whereNull('read_at')->count();
@endphp

<div class="admin-layout">

    {{-- Sidebar menu --}}
    @include('partials.menu')

    <div id="sidebar-overlay" onclick="closeSidebar()"></div>

    <div id="main-content" class="admin-main">

        {{-- Header --}}
        <header id="main-header">

            <div class="header-left">

                {{-- Mobile hamburger --}}
                <button type="button"
                        class="header-btn header-btn-sm lg:hidden"
                        onclick="toggleMobileSidebar()">
                    <i class="fas fa-bars"></i>
                </button>

                {{-- Desktop collapse --}}
                <button type="button"
                        class="header-btn header-btn-sm hidden lg:flex"
                        id="sidebar-toggle"
                        onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>

                {{-- Breadcrumb --}}
                <div class="breadcrumb-wrap hidden sm:flex">
                    <span class="breadcrumb-item">{{ trans('panel.site_title') }}</span>
                    <span class="breadcrumb-separator">/</span>
                    <span class="breadcrumb-item active">@yield('page-title', 'Dashboard')</span>
                </div>

            </div>

            <div class="header-right">

                {{-- Search --}}
                <div class="admin-search hidden md:flex">
                    <input type="text" id="admin-global-search" placeholder="Search...">
                    <i class="fas fa-search"></i>
                    <div id="admin-search-results" class="admin-search-results"></div>
                </div>

                @can('important_link_access')
                    <div x-data="{ open:false }" class="relative">
                        <button type="button" @click="open = !open" class="header-btn" title="Important Links">
                            <i class="fas fa-link"></i>
                        </button>
                        <div x-show="open" x-transition @click.outside="open=false" class="user-menu notification-menu">
                            @forelse($adminImportantLinks as $link)
                                <a href="{{ $link->url }}" target="_blank" rel="noopener">
                                    <p class="notification-title"><i class="{{ $link->icon ?: 'fas fa-link' }}"></i> {{ $link->title }}</p>
                                    <p class="notification-text">{{ $link->url }}</p>
                                </a>
                            @empty
                                <div class="admin-search-empty">No links added yet</div>
                            @endforelse
                            <a href="{{ route('admin.important-links.index') }}">
                                <p class="notification-title"><i class="fas fa-gear"></i> Manage links</p>
                            </a>
                        </div>
                    </div>
                @endcan

                @can('awareness_video_access')
                    <a href="{{ route('admin.awareness-videos.index') }}" class="header-btn" title="Awareness Sessions">
                        <i class="fas fa-video"></i>
                    </a>
                @endcan

                <button type="button" class="header-btn" onclick="toggleAdminThemeMode()" title="Toggle dark mode">
                    <i class="fas fa-circle-half-stroke"></i>
                </button>

                {{-- Language --}}
                @if(count(config('panel.available_languages', [])) > 1)
                    <div x-data="{ open:false }" class="relative">
                        <button type="button" @click="open = !open" class="lang-btn">
                            {{ app()->getLocale() }}
                            <i class="fas fa-chevron-down"></i>
                        </button>

                        <div x-show="open"
                             x-transition
                             @click.outside="open=false"
                             class="lang-menu">
                            @foreach(config('panel.available_languages') as $langLocale => $langName)
                                <a href="{{ url()->current() }}?change_language={{ $langLocale }}">
                                    {{ strtoupper($langLocale) }} – {{ $langName }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Notifications --}}
                @can('notification_access')
                    <div x-data="{ open:false }" class="relative">
                        <button type="button" @click="open = !open" class="header-btn notification-btn">
                            <i class="fas fa-bell"></i>
                            @if($adminUnreadNotifications)
                                <span class="notif-dot"></span>
                            @endif
                        </button>
                        <div x-show="open" x-transition @click.outside="open=false" class="user-menu notification-menu">
                            @forelse($adminNotifications as $notification)
                                <a href="{{ route('admin.notifications.show', $notification) }}">
                                    <p class="notification-title">{{ $notification->read_at ? '' : '• ' }}{{ $notification->title }}</p>
                                    <p class="notification-text">{{ \Illuminate\Support\Str::limit($notification->message, 90) }}</p>
                                    <p class="notification-time">{{ $notification->created_at->diffForHumans() }}</p>
                                </a>
                            @empty
                                <div class="admin-search-empty">No notifications yet</div>
                            @endforelse
                            <a href="{{ route('admin.notifications.index') }}">
                                <p class="notification-title"><i class="fas fa-list"></i> View all notifications</p>
                            </a>
                        </div>
                    </div>
                @endcan

                {{-- User dropdown --}}
                <div x-data="{ open:false }" class="relative">

                    <button type="button"
                            @click="open = !open"
                            class="user-dropdown-btn">

                        <div class="user-dropdown-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="hidden sm:block text-start">
                            <p class="user-dropdown-name">{{ auth()->user()->name }}</p>
                            <p class="user-dropdown-role">Administrator</p>
                        </div>

                        <i class="fas fa-chevron-down hidden sm:block user-dropdown-chevron"></i>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.outside="open=false"
                         class="user-menu">

                        <div class="user-menu-head">
                            <p class="user-menu-head-name">{{ auth()->user()->name }}</p>
                            <p class="user-menu-head-email">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="user-menu-body">

                            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                                <a href="{{ route('profile.password.edit') }}" class="user-menu-link">
                                    <i class="fas fa-key"></i>
                                    Change Password
                                </a>
                            @endif

                            <div class="user-menu-divider"></div>

                            <a href="#"
                               onclick="event.preventDefault(); document.getElementById('logoutform').submit();"
                               class="user-menu-link danger">
                                <i class="fas fa-sign-out-alt"></i>
                                Sign Out
                            </a>

                        </div>
                    </div>

                </div>

            </div>

        </header>

        {{-- Content --}}
        <main class="admin-content">

            @if(session('message'))
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('message') }}
                </div>
            @endif

            @if($errors->count() > 0)
                <div class="alert-error">
                    <div class="alert-error-title">
                        <i class="fas fa-exclamation-circle"></i>
                        <strong>Please fix the following errors:</strong>
                    </div>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </main>

    </div>

</div>

{{-- Logout Form --}}
<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>

{{-- JS --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="//cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="//cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

{{-- Admin JS --}}
<script src="{{ asset('assets/admin/js/admin.js') }}"></script>
<script src="{{ asset('assets/admin/js/admin-form.js') }}"></script>
<script src="{{ asset('assets/admin/js/admin-list.js') }}"></script>

<script>
initAdminGlobalSearch([
    { title: 'Dashboard', url: "{{ route('admin.home') }}", icon: 'fas fa-chart-pie', keywords: 'home dashboard' },
    @can('user_access') { title: 'Users', url: "{{ route('admin.users.index') }}", icon: 'fas fa-user-circle', keywords: 'staff admin users' }, @endcan
    @can('task_access') { title: 'Tasks', url: "{{ route('admin.tasks.index') }}", icon: 'fas fa-list-check', keywords: 'task management assigned due' }, @endcan
    @can('internship_access') { title: 'Internships', url: "{{ route('admin.internships.index') }}", icon: 'fas fa-user-graduate', keywords: 'internship applications students' }, @endcan
    @can('legal_qa_access') { title: 'Legal Q&A', url: "{{ route('admin.legal-qas.index') }}", icon: 'fas fa-comments', keywords: 'ai chat question answer legal' }, @endcan
    @can('important_link_access') { title: 'Important Links', url: "{{ route('admin.important-links.index') }}", icon: 'fas fa-link', keywords: 'phc ecourts consumer links' }, @endcan
    @can('awareness_video_access') { title: 'Awareness Videos', url: "{{ route('admin.awareness-videos.index') }}", icon: 'fas fa-video', keywords: 'sessions videos awareness' }, @endcan
    @can('meta_tag_access') { title: 'Meta Tags', url: "{{ route('admin.meta-tags.index') }}", icon: 'fas fa-tags', keywords: 'seo meta title description keywords' }, @endcan
    @can('testimonial_access') { title: 'Testimonials', url: "{{ route('admin.testimonials.index') }}", icon: 'fas fa-star', keywords: 'feedback reviews approval' }, @endcan
    @can('audit_log_access') { title: 'Audit Logs', url: "{{ route('admin.audit-logs.index') }}", icon: 'fas fa-history', keywords: 'logs activity audit' }, @endcan
]);
</script>

@yield('scripts')

</body>
</html>
