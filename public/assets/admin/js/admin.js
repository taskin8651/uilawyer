$(function () {
    if ($.fn.dataTable) {
        $.extend(true, $.fn.dataTable.defaults, {
            scrollX: true,
            pageLength: 25,
            dom: 'lBfrtip',
            buttons: []
        });
    }
});

// Sidebar collapse desktop
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');

    if (!sidebar) return;

    sidebar.classList.toggle('collapsed');

    localStorage.setItem(
        'sidebar_collapsed',
        sidebar.classList.contains('collapsed') ? '1' : '0'
    );
}

// Sidebar mobile open
function toggleMobileSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (!sidebar || !overlay) return;

    sidebar.classList.toggle('mobile-open');
    overlay.style.display = sidebar.classList.contains('mobile-open') ? 'block' : 'none';
}

// Sidebar mobile close
function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (!sidebar || !overlay) return;

    sidebar.classList.remove('mobile-open');
    overlay.style.display = 'none';
}

// Restore sidebar collapse and theme
(function () {
    const sidebar = document.getElementById('sidebar');

    if (sidebar && localStorage.getItem('sidebar_collapsed') === '1') {
        sidebar.classList.add('collapsed');
    }

    const colorTheme = localStorage.getItem('dash_theme');

    if (colorTheme) {
        try {
            const obj = JSON.parse(colorTheme);

            if (obj.accent) {
                document.documentElement.style.setProperty('--accent', obj.accent.trim());
            }
        } catch (e) {
            console.warn('Theme restore failed:', e);
        }
    }

    const mode = localStorage.getItem('admin_color_mode') || 'light';
    document.documentElement.setAttribute('data-admin-theme', mode);
})();

function toggleAdminThemeMode() {
    const current = document.documentElement.getAttribute('data-admin-theme') || 'light';
    const next = current === 'dark' ? 'light' : 'dark';

    document.documentElement.setAttribute('data-admin-theme', next);
    localStorage.setItem('admin_color_mode', next);
}

function initAdminGlobalSearch(items) {
    const input = document.getElementById('admin-global-search');
    const results = document.getElementById('admin-search-results');

    if (!input || !results) return;

    input.addEventListener('input', function () {
        const value = this.value.trim().toLowerCase();
        results.innerHTML = '';

        if (!value) {
            results.style.display = 'none';
            return;
        }

        const matches = items
            .filter(item => item.title.toLowerCase().includes(value) || item.keywords.toLowerCase().includes(value))
            .slice(0, 8);

        if (!matches.length) {
            results.innerHTML = '<div class="admin-search-empty">No matching admin page found</div>';
            results.style.display = 'block';
            return;
        }

        matches.forEach(function (item) {
            const link = document.createElement('a');
            link.href = item.url;
            link.innerHTML = '<i class="' + item.icon + '"></i><span>' + item.title + '</span>';
            results.appendChild(link);
        });

        results.style.display = 'block';
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.admin-search')) {
            results.style.display = 'none';
        }
    });
}



/// Toggle password visibility

function togglePass(id, btn) {
    const input = document.getElementById(id);
    if (!input) return;

    const icon = btn.querySelector('i');

    if (input.type === 'password') {
        input.type = 'text';
        if (icon) {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    } else {
        input.type = 'password';
        if (icon) {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
}

function initPasswordStrength() {
    const password = document.getElementById('password');
    const text = document.getElementById('strength-text');
    const bars = document.querySelectorAll('.strength-bar');

    if (!password || !text || !bars.length) return;

    password.addEventListener('input', function () {
        const val = this.value;
        let score = 0;

        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const colors = ['#EF4444', '#F59E0B', '#10B981', '#4F46E5'];
        const labels = ['Weak', 'Fair', 'Good', 'Strong'];

        bars.forEach((bar, index) => {
            bar.style.background = index < score ? colors[score - 1] : '#E2E8F0';
        });

        if (val.length === 0) {
            text.textContent = '';
            text.style.color = '#94A3B8';
        } else {
            text.textContent = labels[score - 1] || 'Weak';
            text.style.color = colors[score - 1] || '#EF4444';
        }
    });
}



document.addEventListener('DOMContentLoaded', function () {
    initPasswordStrength();
    initAdminCheckboxes();
});
