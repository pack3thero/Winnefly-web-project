<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import ProductCard from '@/components/products/ProductCard.vue'
import { categoryService } from '@/services/categoryService'
import type { Category } from '@/types/category'
import type { Product } from '@/types/product'

const categories = ref<Category[]>([])
const selectedCategory = ref<Category | null>(null)
const loading = ref(true)

const currentProducts = computed<Product[]>(() => {
    return selectedCategory.value?.products ?? []
})

const fetchCategories = async () => {
    try {
        categories.value = await categoryService.getAll()

        if (categories.value.length > 0) {
            selectedCategory.value = categories.value[0]!
        } else {
            selectedCategory.value = null
        }
    } catch (error) {
        console.error('Failed to fetch categories:', error)
        selectedCategory.value = null
    } finally {
        loading.value = false
    }
}


onMounted(fetchCategories)
</script>
<template>
  <section class="py-16 px-6 bg-[#FDF8F0] min-h-screen">
    <div class="w-full max-w-7xl mx-auto flex flex-col items-center">
      <!-- Header -->
      <div class="w-full text-center mb-12">
        <h1 class="text-5xl font-bold text-[#4A2E2B] mb-4">
          Our Menu
        </h1>
        <p class="text-gray-600 text-lg">
          Discover our finest handcrafted pastries
        </p>
      </div>

      <!-- Loading -->
      <div v-if="loading" class="text-center py-20">
        Loading products...
      </div>

      <template v-else>
        <!-- Categories -->
        <div class="w-full flex justify-center mb-12">
          <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide">
            <button
              v-for="category in categories"
              :key="category.id"
              @click="selectedCategory = category"
              class="px-6 py-3 rounded-full whitespace-nowrap font-medium transition-all duration-300"
              :class="
                selectedCategory?.id === category.id
                  ? 'bg-[#4E8BB7] text-white shadow-lg'
                  : 'bg-white text-gray-700 hover:bg-gray-100'
              "
            >
              {{ category.name }}
            </button>
          </div>
        </div>

        <!-- Products -->
        <div
          v-if="currentProducts.length"
          class="w-fit mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 justify-items-center"
        >
          <ProductCard
            v-for="product in currentProducts"
            :key="product.id"
            :product="product"
          />
        </div>

        <!-- Empty State -->
        <div v-else class="text-center py-20 text-gray-500">
          No products available in this category.
        </div>
      </template>
    </div>
  </section>
</template>