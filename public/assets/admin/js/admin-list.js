function initAdminDataTable(selector, options = {}) {
    if (!$(selector).length) return;

    const dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons || []);

    dtButtons.push(
        {
            extend: 'csv',
            text: '<i class="fas fa-file-csv"></i><span>CSV</span>',
            className: 'admin-dt-btn admin-dt-btn-export'
        },
        {
            extend: 'excel',
            text: '<i class="fas fa-file-excel"></i><span>Excel</span>',
            className: 'admin-dt-btn admin-dt-btn-export admin-dt-btn-excel'
        },
        {
            extend: 'print',
            text: '<i class="fas fa-print"></i><span>Print</span>',
            className: 'admin-dt-btn admin-dt-btn-export'
        },
        {
            text: '<i class="fas fa-check-square"></i><span>Select All</span>',
            className: 'admin-dt-btn admin-dt-btn-select',
            action: function (e, dt) {
                dt.rows({ search: 'applied' }).select();
            }
        },
        {
            text: '<i class="far fa-square"></i><span>Deselect</span>',
            className: 'admin-dt-btn admin-dt-btn-select',
            action: function (e, dt) {
                dt.rows().deselect();
            }
        }
    );

    if (options.canDelete && options.massDeleteUrl) {
        dtButtons.push({
            text: '<i class="fas fa-trash-alt"></i><span>' + (options.deleteText || 'Delete selected') + '</span>',
            url: options.massDeleteUrl,
            className: 'admin-dt-btn admin-dt-btn-danger',
            action: function (e, dt, node, config) {
                const ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id');
                });

                if (!ids.length) {
                    alert(options.zeroSelectedText || 'No rows selected');
                    return;
                }

                if (confirm(options.confirmText || 'Are you sure?')) {
                    $.ajax({
                        headers: { 'x-csrf-token': window._token || $('meta[name="csrf-token"]').attr('content') },
                        method: 'POST',
                        url: config.url,
                        data: {
                            ids: ids,
                            _method: 'DELETE'
                        }
                    }).done(function () {
                        location.reload();
                    });
                }
            }
        });
    }

    const dataTable = $(selector + ':not(.ajaxTable)').DataTable({
        buttons: dtButtons,
        order: options.order || [[1, 'desc']],
        pageLength: options.pageLength || 25,
        scrollX: true,
        columnDefs: [
            {
                targets: 0,
                orderable: false,
                searchable: false,
                className: 'dt-checkbox-cell',
                render: function () {
                    return '<label class="dt-checkbox-wrap"><input type="checkbox" class="dt-row-checkbox" aria-label="Select row"><span></span></label>';
                }
            }
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        language: {
            search: '',
            searchPlaceholder: options.searchPlaceholder || 'Search...',
            lengthMenu: 'Show _MENU_ entries',
            info: options.infoText || 'Showing _START_-_END_ of _TOTAL_ entries',
        }
    }).on('select', function (e, dt, type, indexes) {
        if (type !== 'row') return;

        dt.rows(indexes).nodes().to$().find('.dt-row-checkbox').prop('checked', true);
        syncHeaderCheckbox(dt);
    }).on('deselect', function (e, dt, type, indexes) {
        if (type !== 'row') return;

        dt.rows(indexes).nodes().to$().find('.dt-row-checkbox').prop('checked', false);
        syncHeaderCheckbox(dt);
    }).on('draw', function () {
        const dt = $(this).DataTable();

        dt.rows().every(function () {
            $(this.node()).find('.dt-row-checkbox').prop('checked', this.selected());
        });

        syncHeaderCheckbox(dt);
    });

    const headerCell = $(dataTable.column(0).header());

    headerCell
        .addClass('dt-checkbox-cell')
        .html('<label class="dt-checkbox-wrap"><input type="checkbox" class="dt-header-checkbox" aria-label="Select all visible rows"><span></span></label>');

    headerCell.find('.dt-header-checkbox').on('click', function (event) {
        event.stopPropagation();

        if (this.checked) {
            dataTable.rows({ search: 'applied' }).select();
        } else {
            dataTable.rows({ search: 'applied' }).deselect();
        }

        syncHeaderCheckbox(dataTable);
    });

    $(selector + ' tbody').on('click', '.dt-checkbox-wrap', function (event) {
        event.stopPropagation();
    });

    $(selector + ' tbody').on('change', '.dt-row-checkbox', function () {
        const row = dataTable.row($(this).closest('tr'));

        if (this.checked) {
            row.select();
        } else {
            row.deselect();
        }

        syncHeaderCheckbox(dataTable);
    });
}

function syncHeaderCheckbox(dt) {
    const rows = dt.rows({ search: 'applied' });
    const selectedRows = dt.rows({ search: 'applied', selected: true });
    const checkbox = $(dt.column(0).header()).find('.dt-header-checkbox').get(0);

    if (!checkbox) return;

    checkbox.checked = rows.count() > 0 && selectedRows.count() === rows.count();
    checkbox.indeterminate = selectedRows.count() > 0 && selectedRows.count() < rows.count();
}
