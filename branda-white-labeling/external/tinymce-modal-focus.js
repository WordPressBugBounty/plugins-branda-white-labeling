/**
 * Keep TinyMCE Insert/Edit Link usable inside SUI modals.
 */
( function () {
	'use strict';

	var selectors = [
		'.mce-inline-toolbar-grp',
		'.mce-container.mce-floatpanel',
		'.mce-window',
		'.wp-link-input',
		'#wp-link-wrap',
		'#wp-link-backdrop',
		'.wplink-autocomplete'
	].join( ',' );

	document.addEventListener( 'focus', function ( event ) {
		var target = event.target;

		if ( ! document.documentElement.classList.contains( 'sui-has-modal' ) ) {
			return;
		}

		if ( ! target || 'function' !== typeof target.closest ) {
			return;
		}

		if ( target.closest( selectors ) ) {
			event.stopImmediatePropagation();
		}
	}, true );
}() );
