<script setup lang="ts">
import { computed, onMounted, ref } from 'vue'
import { useProductStore } from '@/productStore'
import ProductCard from '@/components/products/ProductCard.vue'

const productStore = useProductStore()
const selectedCategory = ref('All')

onMounted(() => {
  productStore.fetchProducts()
})

const categories = computed(() => {
  const names = productStore.products.map((product: any) => product.category?.name)
  return ['All', ...new Set(names.filter(Boolean))]
})

const filteredProducts = computed(() => {
  if (selectedCategory.value === 'All') {
    return productStore.products
  }

  return productStore.products.filter((product: any) => {
    return product.category?.name === selectedCategory.value
  })
})
</script>

<template>
  <section class="w-screen min-h-screen bg-[#FDF8F0] text-[#4A2E2B] py-16" id="our-products">
    <div class="w-screen px-8">
    <!-- Header -->
    <div class="w-full text-center mb-8">
        <h1 class="text-5xl font-bold mb-4">
          Our Products
        </h1>

        <p class="text-[#6B4F4F] text-lg">
          Some of our featured products
        </p>
      </div>

      <!-- Category -->
      <div class="w-full flex justify-center gap-4 mb-24">
        <button
          v-for="category in categories"
          :key="category"
          @click="selectedCategory = category"
          :class="[
            'px-6 py-3 rounded-full transition font-medium',
            selectedCategory === category
              ? 'bg-[#4A2E2B] text-white shadow-md'
              : 'bg-white text-[#4A2E2B] border border-[#D8C3A5] hover:bg-[#F3E8DC]'
          ]"
        >
          {{ category }}
        </button>
      </div>

      <!-- Products -->
      <div class="w-full pt-20">
        <div
          v-if="filteredProducts.length > 0"
          class="w-full flex justify-center"
        >
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10 justify-items-center">
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
    </div>
  </section>
</template>