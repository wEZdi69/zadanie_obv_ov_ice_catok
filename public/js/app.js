// Маска для телефона
document.addEventListener('DOMContentLoaded', function() {
    const phoneInputs = document.querySelectorAll('.phone-mask');
    
    phoneInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
            e.target.value = !x[2] ? '+7 (' + x[1] : '+7 (' + x[2] + ') ' + x[3] + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
        });
    });

    // Показывать/скрывать секцию коньков на странице бронирования
    const hasSkatesCheckbox = document.getElementById('hasSkates');
    const skatesSection = document.getElementById('skatesSection');
    const hoursSelect = document.getElementById('hours');
    const totalPriceDiv = document.getElementById('totalPrice');

    if (hasSkatesCheckbox) {
        hasSkatesCheckbox.addEventListener('change', function() {
            skatesSection.style.display = this.checked ? 'block' : 'none';
            updateTotalPrice();
        });
    }

    if (hoursSelect) {
        hoursSelect.addEventListener('change', updateTotalPrice);
    }

    function updateTotalPrice() {
        const hours = parseInt(document.getElementById('hours')?.value || 1);
        const hasSkates = document.getElementById('hasSkates')?.checked || false;
        const ticketPrice = 300;
        const skatePrice = hasSkates ? 150 * hours : 0;
        const total = ticketPrice + skatePrice;
        
        if (totalPriceDiv) {
            totalPriceDiv.innerHTML = `
                <p>Стоимость входа: ${ticketPrice}₽</p>
                <p>Аренда коньков: ${skatePrice}₽</p>
                <p class="total">Итого: ${total}₽</p>
            `;
        }
    }

    // Плавная прокрутка к якорям
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});