// my shopping cart stuff
const cartSidebar = document.getElementById('cart-sidebar');
const openCartBtn = document.getElementById('open-cart');
const closeCartBtn = document.getElementById('close-cart');
const cartItemsContainer = document.getElementById('cart-items');
const cartTotal = document.getElementById('cart-total');
const cartCount = document.querySelector('.cart-count');
const clearCartBtn = document.getElementById('clear-cart');
const checkoutBtn = document.getElementById('checkout');

let cart = [];

function saveCart() {
  localStorage.setItem('e_tech_cart', JSON.stringify(cart));
}

function loadCart() {
  const data = localStorage.getItem('e_tech_cart');
  cart = data ? JSON.parse(data) : [];
}

function updateCartCount() {
  cartCount.textContent = cart.reduce((sum, item) => sum + item.qty, 0);
}

function renderCart() {
  cartItemsContainer.innerHTML = '';
  if (cart.length === 0) {
    cartItemsContainer.innerHTML = `
      <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 220px;">
        <p style="font-size:1.1rem; color:#888; margin-bottom: 1.2rem;">Your cart is empty.</p>
        <button id="continue-shopping-empty" class="btn btn-secondary" style="margin-top:0.5rem;">Continue Shopping</button>
      </div>
    `;
    cartTotal.textContent = '0.00';
    updateCartCount();
    // add event listener for continue shopping button
    const continueBtn = document.getElementById('continue-shopping-empty');
    if (continueBtn) {
      continueBtn.addEventListener('click', () => cartSidebar.classList.remove('open'));
    }
    return;
  }
  let total = 0;
  cart.forEach(item => {
    total += item.price * item.qty;
    const div = document.createElement('div');
    div.className = 'cart-item';
    div.innerHTML = `
      <img src="${item.image}" alt="${item.name}" />
      <div class="cart-item-details">
        <div class="cart-item-title">${item.name}</div>
        <div>$${item.price.toFixed(2)}</div>
        <div class="cart-item-qty">
          <button class="decrease-qty" data-id="${item.id}">-</button>
          <span>${item.qty}</span>
          <button class="increase-qty" data-id="${item.id}">+</button>
          <button class="cart-item-remove" data-id="${item.id}" title="Remove">&times;</button>
        </div>
      </div>
    `;
    cartItemsContainer.appendChild(div);
  });
  cartTotal.textContent = total.toFixed(2);
  updateCartCount();
}

function addToCart(product) {
  const found = cart.find(item => item.id === product.id);
  if (found) {
    found.qty += 1;
  } else {
    cart.push({ ...product, qty: 1 });
  }
  saveCart();
  renderCart();
}

// Event Listeners
openCartBtn.addEventListener('click', e => {
  e.preventDefault();
  cartSidebar.classList.add('open');
  renderCart();
});
closeCartBtn.addEventListener('click', () => cartSidebar.classList.remove('open'));
clearCartBtn.addEventListener('click', () => {
  cart = [];
  saveCart();
  renderCart();
});
checkoutBtn.addEventListener('click', () => {
  if (cart.length === 0) {
    alert('Your cart is empty!');
    return;
  }
  const total = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
  if (confirm(`Total: $${total.toFixed(2)}. Confirm purchase?`)) {
    fetch('pages/checkout.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ cart })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Order placed! Thank you for shopping with us.');
        cart = [];
        saveCart();
        renderCart();
        cartSidebar.classList.remove('open');
      } else {
        alert(data.message || 'Order failed.');
      }
    })
    .catch(() => alert('Order failed.'));
  }
});

cartItemsContainer.addEventListener('click', e => {
  if (e.target.classList.contains('increase-qty')) {
    const id = e.target.getAttribute('data-id');
    const item = cart.find(i => i.id === id);
    if (item) item.qty += 1;
    saveCart();
    renderCart();
  } else if (e.target.classList.contains('decrease-qty')) {
    const id = e.target.getAttribute('data-id');
    const item = cart.find(i => i.id === id);
    if (item && item.qty > 1) {
      item.qty -= 1;
    } else if (item) {
      cart = cart.filter(i => i.id !== id);
    }
    saveCart();
    renderCart();
  } else if (e.target.classList.contains('cart-item-remove')) {
    const id = e.target.getAttribute('data-id');
    cart = cart.filter(i => i.id !== id);
    saveCart();
    renderCart();
  }
});

// when page loads
loadCart();
renderCart();

// search box stuff
const searchInput = document.querySelector('#search-bar input');
const searchButton = document.querySelector('#search-bar button');

// Simple search - just show an alert for now
function performSearch() {
  const query = searchInput.value.trim();
  if (query.length < 2) {
    alert('Please enter at least 2 characters to search');
    return;
  }

  alert('Search for "' + query + '" - feature coming soon!');
  searchInput.value = '';
}


document.querySelectorAll('.add-to-cart').forEach(btn => {
  btn.addEventListener('click', function () {
    const product = JSON.parse(this.getAttribute('data-product'));
    addToCart(product);
    cartSidebar.classList.add('open');
  });
});


// search buttons
searchButton.addEventListener('click', performSearch);
searchInput.addEventListener('keypress', (e) => {
  if (e.key === 'Enter') {
    performSearch();
  }
});

// User dropdown functionality
document.addEventListener('DOMContentLoaded', function() {
    const profileBtn = document.getElementById('profile-btn');
    const userDropdown = document.getElementById('user-dropdown');
    
    if (profileBtn && userDropdown) {
        profileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('show');
            }
        });
    }
});
