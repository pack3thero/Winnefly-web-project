<script setup lang="ts">
import { RouterLink } from 'vue-router'
</script>

<template>
  <main class="bg-[#FDF8F0] min-h-screen flex items-center justify-center text-[#4A2E2B] px-6">
    <div class="max-w-xl text-center border border-[#D8C3A5] rounded-2xl p-8 shadow-sm">
      <h1 class="text-3xl font-bold mb-4">
        Payment Failed
      </h1>

      <p class="text-[#6B4F4F] mb-6">
        Pembayaran belum berhasil atau dibatalkan.  
        Silakan coba lagi untuk menyelesaikan pesanan Anda.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <RouterLink to="/cart">
          <button
            class="w-full sm:w-auto px-6 py-3 rounded-lg border border-[#D8C3A5] text-[#4A2E2B] hover:bg-[#E8D9C8] transition"
          >
            Back to Cart
          </button>
        </RouterLink>

        <RouterLink to="/checkout">
          <button
            class="w-full sm:w-auto px-6 py-3 rounded-lg bg-[#9ebcdb] text-white hover:bg-[#36525d] transition"
          >
            Try Again
          </button>
        </RouterLink>
      </div>
    </div>
  </main>
</template>