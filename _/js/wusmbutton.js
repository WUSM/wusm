(function() {
	tinymce.PluginManager.add('wusmbutton', function( editor, url ) {
		url = url.substring(0, url.length - 2);
		editor.addButton( 'wusmbutton', {
			title: 'Insert',
			image: url + 'img/add.svg',
			type: 'menubutton',
			menu: [
				{
					text: 'Button',
					icon: false,
					onclick: function() {
						editor.insertContent('[wusmbutton]Call to Action[/wusmbutton]');
					}
				}
			]
		});
	});
})();