(function (e) {
	e(
		function () {
			tinymce.create(
				'tinymce.plugins.wusmbutton',
				{
					init : function (editor, url) {
						url = url.substring( 0, url.length - 2 );
						if (editor.buttons.wusmbutton ) {
							editor.buttons.wusmbutton.menu.push(
								{
									text: 'Button',
									icon: false,
									onclick: function ( ) {
										var text_selection = tinymce.activeEditor.selection.getContent( {format: 'text'} );
										editor.windowManager.open(
											{
												title: 'Insert Button',
												body: [{
													type: 'textbox',
													name: 'text',
													label: 'Text',
													size: 30,
													value: text_selection
												}, {
													type: 'textbox',
													name: 'link',
													label: 'URL',
													value: ''
												}, {
													type: 'checkbox',
													name: 'newwindow',
													label: 'Open in a new window?'
												}, ],
												onsubmit: function ( e ) {
													if (e.data.newwindow == true ) {
														var openin = 'target="_blank"';
													}
													editor.insertContent(
														'<a class="wusm-button"' + openin + '" href="' + e.data.link + '">' + e.data.text + '</a>'
													);
												}
											}
										);
									}
								}
							);
						} else {
							editor.addButton(
								'wusmbutton',
								{
									title: 'Insert',
									image: url + 'img/add.svg',
									type: 'menubutton',
									menu: [ {
										text: 'Button',
										icon: false,
										onclick: function ( ) {
											var text_selection = tinymce.activeEditor.selection.getContent( {format: 'text'} );
											editor.windowManager.open(
												{
													title: 'Insert Button',
													body: [{
														type: 'textbox',
														name: 'text',
														label: 'Text',
														size: 30,
														value: text_selection
													}, {
														type: 'textbox',
														name: 'link',
														label: 'URL',
														value: ''
													}, {
														type: 'checkbox',
														name: 'newwindow',
														label: 'Open in a new window?'
													}, ],
													onsubmit: function ( e ) {
														if (e.data.newwindow == true ) {
															var openin = 'target="_blank"';
														}
														editor.insertContent(
															'<a class="wusm-button"' + openin + '" href="' + e.data.link + '">' + e.data.text + '</a>'
														);
													}
												}
											);
										}
									} ]
								}
							);
						}
					},

					createControl : function (n, cm) {
						return null;
					},

					getInfo : function () {
						return {
							longname : 'WUSM Button',
							author : 'Medical Public Affairs',
							authorurl : 'http://medicine.wustl.edu',
							version : "1.0"
						};
					}
				}
			);
			tinymce.PluginManager.add( 'wusmbutton', tinymce.plugins.wusmbutton );
		}
	)
})( jQuery );
