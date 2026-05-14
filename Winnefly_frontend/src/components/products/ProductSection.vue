<script setup lang="ts">
import { computed, onMounted } from 'vue'
import { useProductStore } from '@/productStore'
import ProductCard from '@/components/products/ProductCard.vue'

const productStore = useProductStore()

onMounted(() => {
  productStore.fetchProducts()
})

const categories = computed(() => {
  const names = productStore.products.map((product: any) => product.category?.name)
  return ['All', ...new Set(names.filter(Boolean))]
})

const filteredProducts = computed(() => {
  return productStore.products
})
</script>

<template>
  <section class="w-screen min-h-screen bg-[#FDF8F0] text-[#4A2E2B] py-16">
    <div class="w-screen px-8">
      <!-- Header -->
      <div class="w-full text-center mb-8">
        <h1 class="text-5xl font-bold">
          Our Products
        </h1>

        <p class="text-[#6B4F4F] text-lg mt-2">
          Some of our featured products
        </p>
      </div>

      <!-- Category -->
      <div class="w-full flex justify-center mb-12">
        <button
          v-for="category in categories"
          :key="category"
          class="px-6 py-3 rounded-full bg-[#4A2E2B] text-white"
        >
          {{ category }}
        </button>
      </div>

      <!-- Products -->
      <div
        v-if="filteredProducts.length > 0"
        class="w-full flex justify-center"
      >
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 justify-items-center">
          <ProductCard
            v-for="product in filteredProducts"
            :key="product.id"
            :product="product"
          />
        </div>
      </div>

      <p v-else class="text-center text-[#6B4F4F]">
        Produk belum tersedia.
      </p>
    </div>
  </section>
</template>