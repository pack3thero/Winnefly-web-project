<script setup lang="ts">
import { ShoppingCart } from 'lucide-vue-next'
import { useCartStore } from '@/stores/cartStore'

const props = defineProps<{
  product: any
}>()

const cartStore = useCartStore()

function formatPrice(price: number) {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
  }).format(price)
}
</script>

<template>
  <div
    class="w-[320px] bg-white/50 border border-[#E3CBAF] rounded-[28px] overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300"
  >
    <div class="relative h-[260px] flex items-center justify-center bg-[#FFF9F1]">
      <span
        class="absolute top-5 right-5 bg-green-100 text-green-700 text-sm px-4 py-1 rounded-full"
      >
        Available
      </span>

      <img
        :src="product.image"
        :alt="product.name"
        class="max-h-[210px] max-w-[240px] object-contain transition duration-300 hover:scale-105"
      />
    </div>

    <div class="p-6">
      <h3 class="text-2xl font-semibold text-[#4A2E2B] mb-1">
        {{ product.name }}
      </h3>

      <p class="text-[#8B6B61] mb-3">
        {{ product.category?.name }}
      </p>

      <p class="text-2xl text-[#4E8BB7] font-medium mb-5">
        {{ formatPrice(product.price) }}
      </p>

      <div class="grid grid-cols-2 gap-4">
        <RouterLink
          :to="`/product/${product.id}`"
          class="border border-[#4E8BB7] text-[#4A2E2B] rounded-xl py-3 font-medium hover:bg-[#4E8BB7] hover:text-white hover:shadow-md transition duration-300 flex items-center justify-center"
        >
          Detail
        </RouterLink>

        <button
          @click="cartStore.addToCart(product)"
          class="bg-[#4E8BB7] text-white rounded-xl py-3 font-medium hover:bg-[#3E749A] hover:shadow-md transition duration-300 flex items-center justify-center gap-2"
        >
          <ShoppingCart class="w-4 h-4" />
          Add
        </button>
      </div>
    </div>
  </div>
</template>