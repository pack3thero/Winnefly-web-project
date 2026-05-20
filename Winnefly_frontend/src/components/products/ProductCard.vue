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
        :class="[
          'absolute top-5 right-5 text-sm px-4 py-1 rounded-full',
          product.stock > 0
            ? 'bg-green-100 text-green-700'
            : 'bg-red-100 text-red-700'
        ]"
      >
        {{ product.stock > 0 ? 'Available' : 'Unavailable' }}
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
          :disabled="product.stock <= 0"
          :class="[
            'rounded-xl py-3 font-medium transition duration-300 flex items-center justify-center gap-2',
            product.stock > 0
              ? 'bg-[#4E8BB7] text-white hover:bg-[#3E749A] hover:shadow-md'
              : 'bg-gray-300 text-gray-500 cursor-not-allowed'
          ]"
        >
          <ShoppingCart class="w-4 h-4" />

          {{ product.stock > 0 ? 'Add' : 'Sold Out' }}
        </button>
      </div>
    </div>
  </div>
</template>