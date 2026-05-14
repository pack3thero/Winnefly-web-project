<script setup lang="ts">
import { onMounted } from 'vue'
import { useCartStore } from '@/stores/cartStore'

const cartStore = useCartStore()

onMounted(() => {
  cartStore.clearCart()
})
</script>

<template>
  <main class="bg-[#FDF8F0] min-h-screen flex items-center justify-center text-[#4A2E2B]">
    <div class="text-center">
      <h1 class="text-3xl font-bold mb-4">
        Pembayaran Berhasil
      </h1>

      <p>Terima kasih sudah membeli di Winnefly Pastries.</p>
    </div>
  </main>
</template>