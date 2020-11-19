(function ($) {
    // Get the path to action from CakePHP
    var autoCompleteSource = urlToAutocompleteAction;
    $('#product_name').autocomplete({
        source: autoCompleteSource,        
        minLength: 1
    });
})(jQuery);