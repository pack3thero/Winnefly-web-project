<script setup lang="ts">
import { ref } from 'vue'
import { useCartStore } from '@/stores/cartStore'
import { api } from '@/services/api'

const cartStore = useCartStore()

const form = ref({
  name: '',
  email: '',
  phone: '',
  address: '',
  payment_method: 'xendit',
})

const loading = ref(false)

async function checkout() {
  loading.value = true

  try {
    const response = await api.post('/checkout', {
      customer_name: form.value.name,
      customer_email: form.value.email,
      customer_phone: form.value.phone,
      address: form.value.address,
      payment_method: form.value.payment_method,
      items: cartStore.cartItems,
      total_price: cartStore.totalPrice,
    })

    window.location.href = response.data.invoice_url
  } catch (error: any) {
  console.error('Checkout error:', error)

  if (error.response) {
    console.log('Status:', error.response.status)
    console.log('Data:', error.response.data)

    alert(error.response.data.message || 'Checkout gagal dari backend')
  } else {
    alert('Tidak bisa terhubung ke backend Laravel')
  }
}
}
</script>

<template>
  <main class="bg-[#FDF8F0] text-[#4A2E2B]">
    <section class="max-w-5xl mx-auto px-8 py-10">
      <h1 class="text-3xl font-bold mb-8">
        Checkout
      </h1>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <form @submit.prevent="checkout" class="lg:col-span-2 space-y-5">
          <input v-model="form.name" required placeholder="Nama lengkap" class="checkout-input" />

          <input v-model="form.email" required type="email" placeholder="Email" class="checkout-input" />

          <input v-model="form.phone" required placeholder="Nomor HP" class="checkout-input" />

          <textarea v-model="form.address" required placeholder="Alamat lengkap" class="checkout-input h-32"></textarea>

          <select v-model="form.payment_method" class="checkout-input">
            <option value="xendit">Xendit Payment Gateway</option>
          </select>

          <button
            type="submit"
            :disabled="loading || cartStore.cartItems.length === 0"
            class="w-full bg-[#9ebcdb] text-white py-3 rounded-lg hover:bg-[#36525d] transition disabled:opacity-50"
          >
            {{ loading ? 'Memproses...' : 'Bayar Sekarang' }}
          </button>
        </form>

        <aside class="border border-[#D8C3A5] rounded-2xl p-6 h-fit">
          <h2 class="text-xl font-bold mb-4">
            Ringkasan Pesanan
          </h2>

          <div
            v-for="item in cartStore.cartItems"
            :key="item.id"
            class="flex justify-between mb-3 text-sm"
          >
            <span>{{ item.name }} x {{ item.quantity }}</span>
            <span>Rp {{ (item.price * item.quantity).toLocaleString('id-ID') }}</span>
          </div>

          <div class="flex justify-between border-t border-[#D8C3A5] pt-4 font-bold">
            <span>Total</span>
            <span>Rp {{ cartStore.totalPrice.toLocaleString('id-ID') }}</span>
          </div>
        </aside>
      </div>
    </section>
  </main>
</template>

<style scoped>
.checkout-input {
  width: 100%;
  border: 1px solid #D8C3A5;
  border-radius: 12px;
  padding: 12px 16px;
  background: transparent;
  outline: none;
}
</style>