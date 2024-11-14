document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('codePostal').addEventListener('input', function (e) {
            let input = e.target.value.replace(/\s+/g, '');
            if (input.length > 6) {
                input = input.slice(0, 6);
            } 
            if (input.length > 3) {
                input = input.slice(0, 3) + ' ' + input.slice(3);
            }
            e.target.value = input;
        });
    });
