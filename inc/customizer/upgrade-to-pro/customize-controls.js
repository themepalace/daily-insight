( function( api ) {

	// Extends our custom "daily-insight" section.
	api.sectionConstructor['daily-insight'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
