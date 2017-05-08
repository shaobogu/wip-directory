
jQuery(document).ready(function () {
    jQuery("#wip-directory-form").submit(function (e) {
        e.preventDefault();
        
        var category = jQuery("#wip-directory-categories-select").val();
        var title = jQuery("#wip-directory-title").val();
        var description = jQuery("#wip-directory-description").val();
        
        var directoryItem = new wp.api.models.Directory({
            title: title,
            content: description,
            meta: { category: category }
        });
        directoryItem.save();
    });
    
    // find and parse categories
    var categories = jQuery("#wip-directory-categories-field").val().split(",");
    var select = jQuery("#wip-directory-categories-select");
    for (var i = 0; i < categories.length; i++) {
        select.append(WIPDirectory.getCategoryOptionHtml(categories[i]));
    }
});

wp.api.loadPromise.done(function () {
    return;
});