/**
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
jsBackend.twitter =
{
    init: function()
    {
        $('#accounts').multipleTextbox(
        {
            emptyMessage: utils.string.ucfirst(jsBackend.locale.msg('NoAccounts')),
            addLabel: utils.string.ucfirst(jsBackend.locale.lbl('Add')),
            removeLabel: utils.string.ucfirst(jsBackend.locale.lbl('Delete')),
            canAddNew: true
        });

        $('#hashtags').multipleTextbox(
        {
            emptyMessage: utils.string.ucfirst(jsBackend.locale.msg('NoHashtags')),
            addLabel: utils.string.ucfirst(jsBackend.locale.lbl('Add')),
            removeLabel: utils.string.ucfirst(jsBackend.locale.lbl('Delete')),
            canAddNew: true
        });
    }
}

$(jsBackend.twitter.init);