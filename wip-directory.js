
wp.api.models.Directory = wp.api.models.Post.extend({
    url: wpApiSettings.root + wpApiSettings.versionString + "/wip_directory"
});

wp.api.collections.Directory = wp.api.collections.Posts.extend({
    url: wpApiSettings.root + wpApiSettings.versionString + "/wip_directory",
    model: wp.api.models.Directory
});
