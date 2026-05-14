<script setup lang="ts">
import { useCartStore } from '@/stores/cartStore'

const cartStore = useCartStore()

defineProps<{
  product: any
}>()

</script>

<template>
  <div class="w-full max-w-xs border border-[#D8C3A5] rounded-2xl p-5 shadow-sm hover:shadow-md transition">
    <div class="relative">
      <img
        :src="product.image_url || product.image"
        :alt="product.name"
        class="w-full aspect-square object-cover rounded-xl"
      />

      <span class="absolute top-3 right-3 bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full">
        Available
      </span>
    </div>

    <div class="mt-5">
      <h2 class="text-xl font-semibold">
        {{ product.name }}
      </h2>

      <p class="text-[#6B4F4F] mt-1">
        {{ product.category?.name }}
      </p>

      <p class="text-2xl text-[#4E8BB7] font-semibold mt-5">
        Rp {{ Number(product.price).toLocaleString('id-ID') }}
      </p>

      <div class="grid grid-cols-2 gap-4 mt-4">
        <RouterLink
          :to="`/product/${product.id}`"
          class="h-14 flex items-center justify-center border border-[#4E8BB7] text-[#111827] rounded-xl hover:bg-[#EAF4FB] transition"
        >
          Detail
        </RouterLink>

        <button
          @click="cartStore.addToCart(product)"
          class="h-14 flex items-center justify-center bg-[#4E8BB7] text-white rounded-xl hover:bg-[#36525d] transition"
        >
          Add to Cart
        </button>
      </div>
    </div>
  </div>
</template>