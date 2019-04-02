(function() {
	tinymce.create('tinymce.plugins.wusm_columns', {

	init : function(ed, url) {
		ed.addButton('wusm_columns', {
			icon  : 'code',
			title : 'Add columns',
			onclick: function( ) {
				ed.windowManager.open( {
				title: 'Insert Columns',
				body: [
				{
					type: 'listbox', 
					name: 'columns', 
					label: 'Number of columns to insert:', 
					'values': [
						{ text: '2', value: 2 },
						{ text: '3', value: 3 }
					]
				},
				],
				onsubmit: function( e ) {
					cols = e.data.columns;
					divhtml = "<div class='wrapper clearfix'>";
					for (var i = 0; i < cols; i++) {
						divhtml += "<div class='wusm-cols cols-" + cols + "'><p>Column " + i + "</p></div>";
					}
					divhtml += "</div><p></p>";
					ed.insertContent( 
						divhtml
					);
				}
				} );
			}
		});
	},

	/**
	 *
	 */
	createControl : function(n, cm) {
		return null;
	},

	/**
	 *
	 */
	getInfo : function() {
		return {
			longname  : 'Add button with dashicon',
			author    : 'Aaron Graham',
			authorurl : '',
			infourl   : '',
			version   : "0.1"
		};
	}
});

// Register plugin
tinymce.PluginManager.add( 'wusm_columns', tinymce.plugins.wusm_columns );
})();