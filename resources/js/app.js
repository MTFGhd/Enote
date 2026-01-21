import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import jQuery from 'jquery';
import DataTable from 'datatables.net';

// Make jQuery available globally (many plugins expect window.$ / window.jQuery)
window.$ = window.jQuery = jQuery;

// Attach DataTables to jQuery (guarded so Alpine still runs if it fails)
try {
	DataTable(window, jQuery);
} catch (e) {
	// Intentionally ignore DataTables initialization issues
}

// Import search functionality
import './search';
