document.addEventListener('DOMContentLoaded', function() {
    const showAllBtn = document.getElementById('showAllContacts');
    const contactItems = document.querySelectorAll('.contact-item');
    
    if (showAllBtn) {
        showAllBtn.addEventListener('click', function() {
            
            contactItems.forEach((item, index) => {
                item.style.display = 'block';
            });
            
            this.style.display = 'none';
        });
    }
});