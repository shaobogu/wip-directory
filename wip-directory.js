
wp.api.models.Directory = wp.api.models.Post.extend({
    url: wpApiSettings.root + wpApiSettings.versionString + "/wip_directory"
});

wp.api.collections.Directory = wp.api.collections.Posts.extend({
    url: wpApiSettings.root + wpApiSettings.versionString + "/wip_directory",
    model: wp.api.models.Directory
});

var WIPDirectory = {
    createPost: function() {
//        var item = new wp.api.models.Directory({
//            title: "Generated Item " + Date.now(),
//            content: "Generated Item content: " + Date.now()
//        });
//        item.save();
    },
    getCategoryLinkHtml: function(category) {
        return jQuery("<a>", {
            class: "wip-directory-category",
            href: "javascript:WIPDirectory.setQueryParam('" + category + "')",
            text: category
        });
    },
    getCategoryOptionHtml: function(category) {
        return jQuery("<option>", {
            value: category,
            text: category
        });
    },
    setQueryParam: function(category) {
        window.location.search = "?category=" + encodeURIComponent(category);
    }
}
