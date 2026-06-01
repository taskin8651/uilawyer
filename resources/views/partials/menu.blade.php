<aside id="sidebar">
    @php
        $sidebarSetting = \App\Models\SiteSetting::first();
        $sidebarLogo = $sidebarSetting?->logo ?: asset('assets/img/logo.png');
    @endphp

    {{-- BRAND --}}
    <div class="sidebar-brand">
        <div class="brand-area">
            <div class="brand-icon">
                <img src="{{ $sidebarLogo }}" alt="Rajpati & Associates" style="width:28px;height:28px;object-fit:contain;">
            </div>

            <span class="brand-text">
                {{ trans('panel.site_title') }}
            </span>
        </div>
    </div>

    {{-- NAV --}}
    <nav class="sidebar-nav">

        <p class="sidebar-section-title nav-label">Main</p>

        {{-- Dashboard --}}
        <a href="{{ route('admin.home') }}"
           data-tooltip="Dashboard"
           class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <i class="fas fa-chart-pie nav-icon"></i>
            <span class="nav-label">{{ trans('global.dashboard') }}</span>
        </a>
         {{-- USER MANAGEMENT GROUP --}}
@can('user_management_access')
    @php
        $umActive = request()->is('admin/permissions*')
            || request()->is('admin/roles*')
            || request()->is('admin/users*')
            || request()->is('admin/audit-logs*');
    @endphp

    <div x-data="{ open: {{ $umActive ? 'true' : 'false' }} }">

        <button type="button"
                @click="open = !open"
                data-tooltip="Users"
                class="nav-link nav-group-btn {{ $umActive ? 'active' : '' }}">

            <div class="nav-group-left">
                <i class="fas fa-users nav-icon"></i>
                <span class="nav-label">{{ trans('cruds.userManagement.title') }}</span>
            </div>

            <i class="fas fa-chevron-right chevron"
               :style="open ? 'transform:rotate(90deg)' : ''"></i>
        </button>

        <div class="submenu"
             x-show="open"
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1">

            @can('permission_access')
                <a href="{{ route('admin.permissions.index') }}"
                   class="sub-link {{ request()->is('admin/permissions*') ? 'active' : '' }}">
                    <i class="fas fa-key"></i>
                    {{ trans('cruds.permission.title') }}
                </a>
            @endcan

            @can('role_access')
                <a href="{{ route('admin.roles.index') }}"
                   class="sub-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
                    <i class="fas fa-shield-alt"></i>
                    {{ trans('cruds.role.title') }}
                </a>
            @endcan

            @can('user_access')
                <a href="{{ route('admin.users.index') }}"
                   class="sub-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <i class="fas fa-user-circle"></i>
                    {{ trans('cruds.user.title') }}
                </a>
            @endcan

            @can('audit_log_access')
                <a href="{{ route('admin.audit-logs.index') }}"
                   class="sub-link {{ request()->is('admin/audit-logs*') ? 'active' : '' }}">
                    <i class="fas fa-history"></i>
                    {{ trans('cruds.auditLog.title') }}
                </a>
            @endcan

        </div>
    </div>
@endcan
@can('task_access')
    <a href="{{ route('admin.tasks.index') }}"
       data-tooltip="Tasks"
       class="nav-link {{ request()->is('admin/tasks*') ? 'active' : '' }}">
        <div class="nav-group-left">
            <i class="fas fa-list-check nav-icon"></i>
            <span class="nav-label">Task Management</span>
        </div>
    </a>
@endcan

@can('internship_access')
    <a href="{{ route('admin.internships.index') }}"
       data-tooltip="Internships"
       class="nav-link {{ request()->is('admin/internships*') ? 'active' : '' }}">
        <div class="nav-group-left">
            <i class="fas fa-user-graduate nav-icon"></i>
            <span class="nav-label">Internships</span>
        </div>
    </a>
@endcan

@can('important_link_access')
    <a href="{{ route('admin.important-links.index') }}"
       data-tooltip="Important Links"
       class="nav-link {{ request()->is('admin/important-links*') ? 'active' : '' }}">
        <div class="nav-group-left">
            <i class="fas fa-link nav-icon"></i>
            <span class="nav-label">Important Links</span>
        </div>
    </a>
@endcan

@can('legal_qa_access')
    <a href="{{ route('admin.legal-qas.index') }}"
       data-tooltip="Legal Q&A"
       class="nav-link {{ request()->is('admin/legal-qas*') ? 'active' : '' }}">
        <div class="nav-group-left">
            <i class="fas fa-comments nav-icon"></i>
            <span class="nav-label">Legal Q&A / AI Chat</span>
        </div>
    </a>
@endcan

@can('awareness_video_access')
    <a href="{{ route('admin.awareness-videos.index') }}"
       data-tooltip="Awareness"
       class="nav-link {{ request()->is('admin/awareness-videos*') ? 'active' : '' }}">
        <div class="nav-group-left">
            <i class="fas fa-video nav-icon"></i>
            <span class="nav-label">Awareness Videos</span>
        </div>
    </a>
@endcan

@can('meta_tag_access')
    <a href="{{ route('admin.meta-tags.index') }}"
       data-tooltip="Meta Tags"
       class="nav-link {{ request()->is('admin/meta-tags*') ? 'active' : '' }}">
        <div class="nav-group-left">
            <i class="fas fa-tags nav-icon"></i>
            <span class="nav-label">Meta Tag Management</span>
        </div>
    </a>
@endcan

        {{-- ABOUT PAGE MANAGEMENT GROUP --}}
@can('about_page_management_access')
    @php
        $aboutPageActive = request()->is('admin/about-intro*')
            || request()->is('admin/founder-message*')
            || request()->is('admin/vision-mission*');
    @endphp

    <div x-data="{ open: {{ $aboutPageActive ? 'true' : 'false' }} }">

        <button type="button"
                @click="open = !open"
                data-tooltip="About Page"
                class="nav-link nav-group-btn {{ $aboutPageActive ? 'active' : '' }}">

            <div class="nav-group-left">
                <i class="fas fa-building nav-icon"></i>
                <span class="nav-label">About Page</span>
            </div>

            <i class="fas fa-chevron-right chevron"
               :style="open ? 'transform:rotate(90deg)' : ''"></i>
        </button>

        <div class="submenu"
             x-show="open"
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1">

            @can('about_intro_access')
                <a href="{{ route('admin.about-intro.index') }}"
                   class="sub-link {{ request()->is('admin/about-intro*') ? 'active' : '' }}">
                    <i class="fas fa-info-circle"></i>
                    About Intro
                </a>
            @endcan

            @can('founder_message_access')
                <a href="{{ route('admin.founder-message.index') }}"
                   class="sub-link {{ request()->is('admin/founder-message*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i>
                    Founder Message
                </a>
            @endcan

            @can('vision_mission_access')
                <a href="{{ route('admin.vision-mission.index') }}"
                   class="sub-link {{ request()->is('admin/vision-mission*') ? 'active' : '' }}">
                    <i class="fas fa-bullseye"></i>
                    Vision Mission
                </a>
            @endcan

            

        </div>
    </div>
@endcan

{{-- TEAM MANAGEMENT GROUP --}}
@can('team_management_access')
    @php
        $teamActive = request()->is('admin/attorneys*');
    @endphp

    <div x-data="{ open: {{ $teamActive ? 'true' : 'false' }} }">

        <button type="button"
                @click="open = !open"
                data-tooltip="Team"
                class="nav-link nav-group-btn {{ $teamActive ? 'active' : '' }}">

            <div class="nav-group-left">
                <i class="fas fa-users nav-icon"></i>
                <span class="nav-label">Team Management</span>
            </div>

            <i class="fas fa-chevron-right chevron"
               :style="open ? 'transform:rotate(90deg)' : ''"></i>
        </button>

        <div class="submenu"
             x-show="open"
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1">

            @can('attorney_access')
                <a href="{{ route('admin.attorneys.index') }}"
                   class="sub-link {{ request()->is('admin/attorneys*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i>
                    Attorneys
                </a>
            @endcan

        </div>
    </div>
@endcan

{{-- ARTICLE MANAGEMENT GROUP --}}
@can('article_management_access')
    @php
        $articleActive = request()->is('admin/article-categories*')
            || request()->is('admin/articles*')
            || request()->is('admin/verdict-judgments*');
    @endphp

    <div x-data="{ open: {{ $articleActive ? 'true' : 'false' }} }">

        <button type="button"
                @click="open = !open"
                data-tooltip="Articles"
                class="nav-link nav-group-btn {{ $articleActive ? 'active' : '' }}">

            <div class="nav-group-left">
                <i class="fas fa-newspaper nav-icon"></i>
                <span class="nav-label">Article Management</span>
            </div>

            <i class="fas fa-chevron-right chevron"
               :style="open ? 'transform:rotate(90deg)' : ''"></i>
        </button>

        <div class="submenu"
             x-show="open"
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1">

            @can('article_category_access')
                <a href="{{ route('admin.article-categories.index') }}"
                   class="sub-link {{ request()->is('admin/article-categories*') ? 'active' : '' }}">
                    <i class="fas fa-folder"></i>
                    Article Categories
                </a>
            @endcan

            @can('article_access')
                <a href="{{ route('admin.articles.index') }}"
                   class="sub-link {{ request()->is('admin/articles*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i>
                    Articles
                </a>
            @endcan

            @can('verdict_judgment_access')
                <a href="{{ route('admin.verdict-judgments.index') }}"
                   class="sub-link {{ request()->is('admin/verdict-judgments*') ? 'active' : '' }}">
                    <i class="fas fa-gavel"></i>
                    Verdicts & Judgments
                </a>
            @endcan

        </div>
    </div>
@endcan

{{-- PRACTICE AREA MANAGEMENT --}}
@if(Gate::allows('practice_area_access') || Gate::allows('practice_area_service_access'))
    @php
        $practiceActive = request()->is('admin/practice-areas*')
            || request()->is('admin/practice-area-services*');
    @endphp

    <div x-data="{ open: {{ $practiceActive ? 'true' : 'false' }} }">
        <button type="button"
                @click="open = !open"
                data-tooltip="Practice Areas"
                class="nav-link nav-group-btn {{ $practiceActive ? 'active' : '' }}">

            <div class="nav-group-left">
                <i class="fas fa-scale-balanced nav-icon"></i>
                <span class="nav-label">Practice Areas</span>
            </div>

            <i class="fas fa-chevron-right chevron"
               :style="open ? 'transform:rotate(90deg)' : ''"></i>
        </button>

        <div class="submenu"
             x-show="open"
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1">

            @can('practice_area_access')
                <a href="{{ route('admin.practice-areas.index') }}"
                   class="sub-link {{ request()->is('admin/practice-areas*') ? 'active' : '' }}">
                    <i class="fas fa-layer-group"></i>
                    Practice Categories
                </a>
            @endcan

            @can('practice_area_service_access')
                <a href="{{ route('admin.practice-area-services.index') }}"
                   class="sub-link {{ request()->is('admin/practice-area-services*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    Practice Services
                </a>
            @endcan
        </div>
    </div>
@endif

{{-- LEGAL ENQUIRY MANAGEMENT --}}
@can('legal_enquiry_access')
    <a href="{{ route('admin.legal-enquiries.index') }}"
       data-tooltip="Legal Enquiries"
       class="nav-link {{ request()->is('admin/legal-enquiries*') ? 'active' : '' }}">

        <div class="nav-group-left">
            <i class="fas fa-envelope-open-text nav-icon"></i>
            <span class="nav-label">Legal Enquiries</span>
        </div>
    </a>
@endcan
@can('career_application_access')
    <a href="{{ route('admin.career-applications.index') }}"
       data-tooltip="Career Applications"
       class="nav-link {{ request()->is('admin/career-applications*') ? 'active' : '' }}">

        <div class="nav-group-left">
            <i class="fas fa-user-graduate nav-icon"></i>
            <span class="nav-label">Career Applications</span>
        </div>
    </a>
@endcan

@can('testimonial_access')
    <a href="{{ route('admin.testimonials.index') }}"
       data-tooltip="Testimonials"
       class="nav-link {{ request()->is('admin/testimonials*') ? 'active' : '' }}">

        <div class="nav-group-left">
            <i class="fas fa-star nav-icon"></i>
            <span class="nav-label">Testimonials</span>
        </div>
    </a>
@endcan
        <div class="nav-divider"></div>

        <p class="sidebar-section-title compact nav-label">Account</p>

        {{-- Settings --}}
        <a href="{{ route('admin.site-settings.index') }}"
           data-tooltip="Settings"
           class="nav-link {{ request()->is('admin/site-settings*') ? 'active' : '' }}">
            <i class="fas fa-cog nav-icon"></i>
            <span class="nav-label">Settings</span>
        </a>

    </nav>

    {{-- LOGOUT --}}
    <div class="sidebar-footer">
        <a href="#"
           onclick="event.preventDefault(); document.getElementById('logoutform').submit();"
           data-tooltip="Logout"
           class="nav-link logout-link">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <span class="nav-label">{{ trans('global.logout') }}</span>
        </a>
    </div>

</aside>
