jQuery(document).ready(function () {
    WIPDirectoryAdmin.categoriesGroup = jQuery("#wip_directory_categories_group");
    var categoriesField = jQuery("#wip_directory_categories_field");
    
    var categories = categoriesField.val().split(",");
    for (var i = 0; i < categories.length; i++) {
        var category = categories[i];
        WIPDirectoryAdmin.categoriesGroup.append(WIPDirectoryAdmin.inputHtml);
        WIPDirectoryAdmin.categoriesGroup.find("input[type='text']:last").val(category);
    }
    
    WIPDirectoryAdmin.categoriesGroup.on("click", ".removeCategory", function() {
        jQuery(this).parent().remove();
    });
    
    jQuery("form").on("submit", null, function(e) {
        var categories = [];
        WIPDirectoryAdmin.categoriesGroup.find("input[type='text']").each(function() {
            var val = jQuery(this).val().replace(/\W/g, '');
            if (val && val.length > 0) {
                categories.push(jQuery(this).val());
            }
        });
        jQuery("#wip_directory_categories_field").val(categories.join());
    });
});

var WIPDirectoryAdmin = {
    addCategory: function() {
        var item = this.categoriesGroup.append(this.inputHtml);
        var i = 1;
    },
    categoriesGroup: null,
    inputHtml: `<div class="wrapper">
        <input type="text" value="">
        <a href="javascript:void(0);" class="removeCategory">remove</a>
    </div>`
}