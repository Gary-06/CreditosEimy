document.getElementById('calculator-form').addEventListener('submit', function(event) {
  let nombre = document.getElementById('nombre').value;
  let peso = document.getElementById('peso').value;
  let nombreValido = /^[a-zA-Z\s]+$/.test(nombre);
  let pesoValido = /^\d+$/.test(peso) && peso >= 0 && peso <= 49;

  if (!nombreValido) {
    alert('El nombre del electrodoméstico debe contener solo letras.');
    event.preventDefault();
  }

  if (!pesoValido) {
    alert('El peso debe ser un número entre 0 y 49.');
    event.preventDefault();
  }
});