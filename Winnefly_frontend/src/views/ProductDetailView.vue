<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { useRoute, RouterLink } from 'vue-router'
import { getProductById } from '@/services/productService'
import { useCartStore } from '@/stores/cartStore'
import type { Product } from '@/types/product'

const route = useRoute()
const cartStore = useCartStore()

const product = ref<Product | null>(null)
const loading = ref(true)

const fetchProductDetail = async () => {
  try {
    const id = Number(route.params.id)
    product.value = await getProductById(id)
  } catch (error) {
    console.error('Failed to fetch product detail:', error)
    product.value = null
  } finally {
    loading.value = false
  }
}

onMounted(fetchProductDetail)
</script>

<template>
  <main class="min-h-screen bg-[#FDF8F0] px-6 py-16 text-[#4A2E2B] flex justify-center">
    <section
      v-if="product"
      class="w-full max-w-6xl"
    >

      <!-- Product Container -->
      <div
        class=" border border-[#E7D8C9] rounded-4xl shadow-lg p-8 md:p-12"
      >
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
          
          <!-- Image -->
          <div class="flex justify-center">
            <div
              class="w-full max-w-130 aspect-square rounded-[28px] overflow-hidden bg-[#fee0c6] border border-[#E7D8C9]"
            >
              <img
                :src="product.image"
                :alt="product.name"
                class="w-full h-full object-cover hover:scale-105 transition duration-500"
              >
            </div>
          </div>

          <!-- Detail -->
          <div class="flex flex-col justify-center">
            <span
              v-if="product.category?.name"
              class="w-fit px-4 py-2 rounded-full bg-[#EAF4FB] text-[#4E8BB7] text-sm font-semibold mb-5"
            >
              {{ product.category.name }}
            </span>

            <h1 class="text-5xl font-bold leading-tight mb-5">
              {{ product.name }}
            </h1>

            <p class="text-[#6B4F4F] text-lg leading-relaxed mb-8">
              {{
                product.description ||
                'Freshly baked pastry with premium ingredients and handcrafted texture.'
              }}
            </p>

            <div class="flex items-center gap-4 mb-10">
              <p class="text-4xl font-bold text-[#4E8BB7]">
                Rp {{ Number(product.price).toLocaleString('id-ID') }}
              </p>

              <span
                :class="[
                  'px-3 py-1 rounded-full text-sm',
                  product.stock > 0
                    ? 'bg-green-100 text-green-700'
                    : 'bg-red-100 text-red-700'
                ]"
              >
                {{ product.stock > 0 ? 'Available' : 'Unavailable' }}
              </span>
            </div>

            <!-- Buttons -->
            <div class="flex flex-wrap gap-4">
              <button
                @click="cartStore.addToCart(product)"
                :disabled="product.stock <= 0"
                :class="[
                  'min-w-[140px] px-8 py-4 rounded-2xl font-semibold transition shadow-md',
                  product.stock > 0
                    ? 'bg-[#4E8BB7] text-white hover:bg-[#36525d] hover:-translate-y-1'
                    : 'bg-gray-300 text-gray-500 cursor-not-allowed'
                ]"
              >
                {{ product.stock > 0 ? 'Add to Cart' : 'Sold Out' }}
              </button>

              <RouterLink
                to="/cart"
                class="min-w-[100px] inline-flex items-center justify-center px-8 py-4 rounded-2xl border border-[#D8C3A5] bg-white/60 text-[#4A2E2B] font-semibold hover:bg-[#4A2E2B] hover:text-white hover:border-[#4A2E2B] hover:-translate-y-1 transition shadow-sm"
              >
                View Cart
              </RouterLink>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Not Found -->
    <div
      v-else
      class="flex items-center justify-center min-h-[60vh]"
    >
      <p class="text-xl text-[#6B4F4F]">
        Produk tidak ditemukan.
      </p>
    </div>
  </main>
</template>