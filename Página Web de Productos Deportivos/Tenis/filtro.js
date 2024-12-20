document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="brand"]');
    const products = document.querySelectorAll('.columna');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            filterProducts();
        });
    });

    function filterProducts() {
        const selectedBrands = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        products.forEach(product => {
            const productBrand = product.getAttribute('data-brand');
            if (selectedBrands.length === 0 || selectedBrands.includes(productBrand)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }
});
