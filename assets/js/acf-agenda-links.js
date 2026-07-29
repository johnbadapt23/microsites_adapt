(function ($) {

    function getAgendaItemFromEditor(editor) {
        var $textarea = $(editor.getElement());
        var $textField = $textarea.closest('textarea.wp-editor-area');

        return $textField
            .parents('.layout, .acf-row')
            .filter(function () {
                return (
                    $(this).find('[data-name="speakers"]').length &&
                    $(this).find('textarea.wp-editor-area').length
                );
            })
            .first();
    }

    function getSpeakerLinks(editor) {
        var $agendaItem = getAgendaItemFromEditor(editor);

        var agendaID = $agendaItem
            .closest('.layout').find('[data-name="agenda_id"] input')
            .val();

        var links = [];
        var speakerCount = 0;

        $agendaItem
            .find('[data-name="speakers"] [data-name="speaker"] .values .acf-rel-item')
            .each(function () {
                speakerCount++;

                var $item = $(this);
                var label = $.trim($item.text());
                var id = $item.data('id') || $item.attr('data-id');
                var roundTableCounter = '';

                if (label && id) {
                    if( $item.closest('.acf-field.acf-field-repeater[data-name="roundtable"]').length !== 0 ){
                        if( $item.parents('tr.acf-row').eq(1).attr('data-id') != '' ){
                            roundTableCounter = $item.parents('tr.acf-row').eq(1).attr('data-id').replace('row','');
                        }
                        
                    }else if( $item.closest('.acf-field.acf-field-repeater[data-name="speakers"]').length === 0  ){
                        roundTableCounter = $item.closest('tr.acf-row').attr('data-id').replace('row','');
                    }
                    links.push({
                        text: label,
                        url: '#' + agendaID + 'speakerPopup-' + speakerCount + '' + roundTableCounter
                    });
                }
            });

        return links;
    }

    function insertSpeakerLink(editor, link) {
        var selectedText = editor.selection
            .getContent({ format: 'text' })
            .trim();

        var linkText = selectedText || link.text;
 
        editor.insertContent(
            '<a class="speaker-popup" href="' + link.url + '">' + linkText + '</a>'
        );
    }

    function refreshAgendaEditor($agendaItem) {
        var $textarea = $agendaItem.find('textarea.wp-editor-area');

        if (!$textarea.length) {
            return;
        }

        var editorId = $textarea.attr('id');

        if (!editorId || typeof tinyMCE === 'undefined') {
            return;
        }

        var editor = tinyMCE.get(editorId);

        if (!editor) {
            return;
        }

        editor.save();
        tinyMCE.execCommand('mceRemoveEditor', false, editorId);

        setTimeout(function () {
            tinyMCE.execCommand('mceAddEditor', false, editorId);
        }, 50);
    }

    tinymce.PluginManager.add('agenda_speaker_links', function (editor) {

        function buildMenuItems() {
            var links = getSpeakerLinks(editor);

            if (!links.length) {
                return [{
                    text: 'No speakers found',
                    disabled: true
                }];
            }

            return links.map(function (link) {
                return {
                    text: link.text,
                    onclick: function () {
                        insertSpeakerLink(editor, link);
                    }
                };
            });
        }

        editor.addButton('agenda_speaker_links', {
            type: 'menubutton',
            text: 'Speakers',
            icon: false,
            menu: buildMenuItems()
        });
    });

    $(document).on(
        'click sortstop change',
        '[data-name="speakers"] [data-name="speaker"] .acf-rel-item, [data-name="speakers"] [data-name="speaker"] input',
        function () {
            var $agendaItem = $(this)
                .closest('.acf-field, .layout, .acf-row')
                .parents('.acf-field, .layout, .acf-row')
                .filter(function () {
                    return (
                        $(this).find('[data-name="speakers"]').length &&
                        $(this).find('[data-name="text"]').length
                    );
                })
                .first();

            setTimeout(function () {
                refreshAgendaEditor($agendaItem);
            }, 300);
        }
    );

})(jQuery);