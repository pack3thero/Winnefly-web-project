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
    <section class="w-full px-8 py-8 flex justify-center">
      <div class="w-full max-w-5xl">

        <!-- TITLE -->
        <h1 class="text-4xl font-bold mb-10 text-[#4A2E2B]">
          Checkout
        </h1>

        <!-- CONTENT -->
        <div class="grid grid-cols-1 lg:grid-cols-[1.5fr_0.9fr] gap-14 items-start">

        <!-- FORM -->
        <form
          @submit.prevent="checkout"
          class="flex flex-col gap-4"
        >

          <input
            v-model="form.name"
            required
            placeholder="Nama lengkap"
            class="checkout-input"
          />

          <input
            v-model="form.email"
            required
            type="email"
            placeholder="Email"
            class="checkout-input"
          />

          <input
            v-model="form.phone"
            required
            placeholder="Nomor HP"
            class="checkout-input"
          />

          <textarea
            v-model="form.address"
            required
            placeholder="Alamat lengkap"
            class="checkout-input h-40"
          ></textarea>

          <select
            v-model="form.payment_method"
            class="checkout-input"
          >
            <option value="xendit">
              Xendit Payment Gateway
            </option>
          </select>

          <button
            type="submit"
            :disabled="loading || cartStore.cartItems.length === 0"
            class="w-full mt-2 bg-[#9ebcdb] text-white py-4 rounded-xl hover:bg-[#36525d] transition disabled:opacity-50"
          >
            {{ loading ? 'Memproses...' : 'Bayar Sekarang' }}
          </button>

        </form>

          <!-- SUMMARY -->
          <aside class="border border-[#D8C3A5] rounded-3xl p-8 h-fit bg-white/30">
            <h2 class="text-2xl font-semibold mb-6">
              Ringkasan Pesanan
            </h2>

            <div
              v-for="item in cartStore.cartItems"
              :key="item.id"
              class="flex justify-between mb-4 text-base"
            >
              <span>{{ item.name }} x {{ item.quantity }}</span>

              <span>
                Rp {{ (item.price * item.quantity).toLocaleString('id-ID') }}
              </span>
            </div>

            <div class="flex justify-between border-t border-[#D8C3A5] pt-5 text-xl font-semibold">
              <span>Total</span>

              <span>
                Rp {{ cartStore.totalPrice.toLocaleString('id-ID') }}
              </span>
            </div>
          </aside>

        </div>
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