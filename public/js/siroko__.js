// Obtener las referencias de las capas
const cartLayer = document.getElementById('mini-shopping-cart-layer');
const cart = document.getElementById('mini-shopping-cart');
const closeCart = document.getElementById('close-cart');
// Agregar un evento de clic a la capa del carrito
cart.addEventListener('click', () => {
    // Mostrar la capa del carrito
    cartLayer.style.display = 'block';
    //Colocar la capa a la derecha:
    cartLayer.style.right = '0';
    // Obtener la altura de la tabla
    const tableHeight = cartLayer.querySelector('table').offsetHeight;
    // Establecer la altura inicial de la capa del carrito como 0
    cartLayer.style.height = '0';
    // Animar el despliegue hacia abajo con una transición
    cartLayer.style.transition = 'height 0.5s';
    cartLayer.style.height = `${tableHeight}px`;
    // Agregar una clase CSS para aplicar el efecto
    cartLayer.classList.add('show-layer');
});
  
// Agregar un evento de clic al documento para ocultar la capa del carrito
closeCart.addEventListener('click', (event) => {
    // Verificar si se hizo clic fuera de la capa del carrito
    if (!cart.contains(event.target)) {
      // Establecer la altura de la capa del carrito como 0 para animar el colapso hacia arriba
      cartLayer.style.height = '0';
      // Remover la clase CSS para el efecto después de que finalice la transición
      setTimeout(() => {
        cartLayer.style.display = 'none';
        cartLayer.classList.remove('show-layer');
      }, 500);
    }
});

function calculateShoppingCartTotals() {
    // Obtener la tabla
    const table = document.querySelector('#mini-shopping-cart-layer table');
    // Obtener las filas de la tabla, excluyendo la primera (encabezados) y la última (fila de total)
    const rows = table.querySelectorAll('tbody tr:not(:last-child)');
    // Variables para almacenar las sumas
    let quantityTotal = 0;
    let totalValue = 0;
    // Recorrer las filas y sumar los valores de las columnas deseadas
    rows.forEach(row => {
        // Obtener los elementos td de la fila
        const cells = row.querySelectorAll('td');
        
        // Obtener los valores de la tercera y cuarta columna (índices 2 y 3)
        const quantity = parseInt(cells[2].querySelector('input').value);
        const total = parseFloat(cells[3].textContent);
        
        // Acumular los valores en las variables totales
        quantityTotal += quantity;
        totalValue += total;
    });
    // Actualizar los elementos span con las sumas
    const quantitySpan = document.querySelector('#mini-shopping-cart .quantity');
    const totalSpan = document.querySelector('#mini-shopping-cart .total');

    quantitySpan.textContent = quantityTotal.toString();
    totalSpan.textContent = totalValue.toFixed(2) + ' €';
}

calculateShoppingCartTotals();
