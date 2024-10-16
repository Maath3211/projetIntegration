$(document).ready(function() {
    $('#templateSelect').change(function() {
        var selectedModelId = $(this).val();
        
        $.ajax({
            url: '/get-template-content',
            method: 'GET',
            data: { modelId: selectedModelId },
            success: function(response) {
                $('#templateContent').html(response.content);
            },
            error: function(xhr) {
                console.log('Error loading template:', xhr.responseText);
            }
        });
    });
});