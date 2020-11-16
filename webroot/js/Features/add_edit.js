$(document).ready(function () {
    // The path to action from CakePHP is in urlToLinkedListFilter 
    $('#feature_data_type').on('change', function () {
        var featureId = $(this).val();
        if (featureId) {
            $.ajax({
                url: urlToLinkedListFilter,
                data: 'feature_data_type=' + featureId,
                success: function (shapeOrColor) {
                    $select = $('#feature_name');
                    $select.find('option').remove();
                    $.each(shapeOrColor, function (key, value)
                    {
                        $.each(value, function (childKey, childValue) {
                            $select.append('<option value=' + childValue.id + '>' + childValue.name + '</option>');
                        });
                    });
                }
            });
        } else {
            $('#feature_name').html('<option value="">Select a type first</option>');
        }
    });
});
