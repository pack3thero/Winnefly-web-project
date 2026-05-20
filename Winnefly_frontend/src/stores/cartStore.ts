import { defineStore } from 'pinia'
import { ref, computed, watch } from 'vue'

function getCartKey() {
  const user = JSON.parse(localStorage.getItem('user') || 'null')

  if (user && user.id) {
    return `cart_user_${user.id}`
  }

  return 'cart_guest'
}

export const useCartStore = defineStore('cart', () => {
  const cartKey = ref(getCartKey())

  const cartItems = ref<any[]>(
    JSON.parse(localStorage.getItem(cartKey.value) || '[]')
  )

  const cartCount = computed(() => {
    return cartItems.value.reduce((total, item) => {
      return total + item.quantity
    }, 0)
  })

  const totalPrice = computed(() => {
    return cartItems.value.reduce((total, item) => {
      return total + item.price * item.quantity
    }, 0)
  })

  function saveCart() {
    localStorage.setItem(cartKey.value, JSON.stringify(cartItems.value))
  }

  function loadCart() {
    cartKey.value = getCartKey()
    cartItems.value = JSON.parse(localStorage.getItem(cartKey.value) || '[]')
  }

  function addToCart(product: any) {
    if (product.stock <= 0) {
      alert('Produk sedang tidak tersedia')
      return
    }

    const existingItem = cartItems.value.find(item => item.id === product.id)

    if (existingItem) {
      if (existingItem.quantity >= product.stock) {
        alert('Jumlah produk melebihi stok yang tersedia')
        return
      }

      existingItem.quantity++
    } else {
      cartItems.value.push({
        id: product.id,
        name: product.name,
        price: Number(product.price),
        image: product.image_url || product.image,
        stock: product.stock,
        quantity: 1,
      })
    }

    saveCart()
  }

  function removeFromCart(id: number) {
    cartItems.value = cartItems.value.filter(item => item.id !== id)
    saveCart()
  }

  function increaseQuantity(id: number) {
    const item = cartItems.value.find(item => item.id === id)

    if (!item) return

    if (item.quantity >= item.stock) {
      alert('Jumlah produk melebihi stok yang tersedia')
      return
    }

    item.quantity++
    saveCart()
  }

  function decreaseQuantity(id: number) {
    const item = cartItems.value.find(item => item.id === id)

    if (item && item.quantity > 1) {
      item.quantity--
    } else {
      removeFromCart(id)
    }

    saveCart()
  }

  function clearCart() {
    cartItems.value = []
    saveCart()
  }

  watch(
    cartItems,
    (newCart) => {
      localStorage.setItem(cartKey.value, JSON.stringify(newCart))
    },
    { deep: true }
  )

  return {
    cartItems,
    cartCount,
    totalPrice,
    loadCart,
    addToCart,
    removeFromCart,
    increaseQuantity,
    decreaseQuantity,
    clearCart,
  }
})