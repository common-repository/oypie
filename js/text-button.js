(function() {
    tinymce.PluginManager.add('oypie_tc_button', function( editor, url ) {
        editor.addButton( 'oypie_tc_button', {
            title: 'OYPie',
            type: 'menubutton',
            icon: 'icon dashicons-camera',
            menu: [
                {
                    text: 'Album',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Album toevoegen',
                            body: [{
                                type: 'listbox',
                                name: 'type',
                                label: 'Type',
                                'values': [
                                    {text: 'Specifiek fotoalbum', value: 'type="map"'},
                                    {text: 'Gebruikersprofiel', value: 'type="user"'},
                                    {text: 'Inlogkaartje', value: 'type="school"'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'id',
                                label: 'Gebruikersnaam of Album ID'
                            },{
                                type: 'listbox',
                                name: 'mapnavigatie',
                                label: 'Mapnavigatie',
                                'values': [
                                    {text: 'Ja', value: ''},
                                    {text: 'Nee', value: ' nonav="1"'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'transparant',
                                label: 'Transparantheid',
                                'values': [
                                    {text: 'Nee', value: ''},
                                    {text: 'Ja', value: ' trans="1"'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'voorkeuren',
                                label: 'Voorkeursinstellingen',
                                'values': [
                                    {text: 'Nee', value: ''},
                                    {text: 'Ja', value: ' pref="1"'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'lang',
                                label: 'Taal',
                                'values': [
                                    {text: 'Automatisch', value: 'lang="auto"'},
                                    {text: 'Nederlands', value: ''},
                                    {text: 'Engels', value: ' lang="en"'},
                                    {text: 'Duits', value: ' lang="de"'},
                                    {text: 'Frans', value: ' lang="fr"'}
                                ]
                            },{
                                type: 'container',
                                html: '<small>Andere opties zijn handmatig toe te voegen. Zie help-pagina.</small>'
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[oypo ' + e.data.type + ' id="' + e.data.id + '"' + e.data.mapnavigatie + '' +
                                                     e.data.voorkeuren + '' + e.data.lang + '' +e.data.transparant + ']');
                            }
                        });
                    }
                },
                {
                    text: 'Prijslijst',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Prijslijst toevoegen',
                            body: [{
                                type: 'listbox',
                                name: 'type',
                                label: 'Type',
                                'values': [
                                    {text: 'Compact', value: ' type="1"'},
                                    {text: 'Uitgebreid', value: ' type="0"'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'price',
                                label: 'Prijzen weergeven',
                                'values': [
                                    {text: 'Ja', value: ' price="1"'},
                                    {text: 'Nee', value: ' price="0"'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'id',
                                label: 'Fotoverkoopprofiel'
                            },{
                                type: 'listbox',
                                name: 'css',
                                label: 'Extra opmaak',
                                'values': [
                                    {text: 'Ja', value: ' css="1"'},
                                    {text: 'Nee', value: ''}
                                ]
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[oypo_price id="' + e.data.id + '"' + e.data.price + '' + e.data.type + '' + e.data.css + ']');
                            }
                        });
                    }
                 }]
        });
    });
})();
