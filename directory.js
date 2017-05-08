
jQuery(document).ready(function () {
    // find and parse categories
    var categories = jQuery("#wip-directory-categories-field").val().split(",");
    var container = jQuery("#wip-directory-categories-container");
    for (var i = 0; i < categories.length; i++) {
        container.append(WIPDirectory.getCategoryLinkHtml(categories[i]));
    }
})