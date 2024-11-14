document.addEventListener('DOMContentLoaded', function() {
    const telInputs = document.querySelectorAll('.telephones');
 
    telInputs.forEach(telInput => {
        telInput.addEventListener('input', function(e) {
            let input = e.target.value.replace(/\D/g, '');
            if (input.length > 3 && input.length <= 6) {
                input = input.slice(0, 3) + '-' + input.slice(3);
            } else if (input.length > 6) {
                input = input.slice(0, 3) + '-' + input.slice(3, 6) + '-' + input.slice(6, 10);
            }
            e.target.value = input;
        });
    });
});
