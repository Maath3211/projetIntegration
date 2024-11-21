$(document).ready(function() {

    function chargerContenu() {
        var selectedModelId = $('#templateSelect').val(); // Get the selected value

        $.ajax({
            url: '/get-template-content',
            method: 'GET',
            data: {
                modelId: selectedModelId
            },
            success: function(response) {
                $('#sujet').text(response.sujet);
                $('#contenu').text(response.contenu);
            },
            error: function(xhr) {
                console.log('Error loading template:', xhr.responseText);
            }
        });
    }

    $('#templateSelect').change(function() {
        chargerContenu();
    });

    chargerContenu();
});