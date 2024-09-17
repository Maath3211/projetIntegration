document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('neq').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});