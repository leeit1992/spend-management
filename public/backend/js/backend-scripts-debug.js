(function($) {

    window.ATLLIB = {
        checkAll: function($el = null) {
            $(".atl-checkbox-primary-js", $el).change(function() {
                if (this.checked) {
                    $(".atl-checkbox-child-js", $el).each(function(index, el) {
                        $(el).prop('checked', true)
                    });
                } else {
                    $(".atl-checkbox-child-js", $el).each(function(index, el) {
                        $(el).prop('checked', false)
                    });
                }
            });

            return false;
        },
    }
    
})(jQuery);