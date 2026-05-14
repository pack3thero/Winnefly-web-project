<script setup lang="ts">
import { useCartStore } from '@/stores/cartStore'

const cartStore = useCartStore()
</script>

<template>
  <main class="bg-[#FDF8F0] text-[#4A2E2B]">
    <section class="w-full flex flex-col items-center px-8 py-10">
      <div class="w-full max-w-5xl mb-8">
        <h1 class="text-3xl font-bold">
          Your Cart
        </h1>
      </div>

      <div v-if="cartStore.cartItems.length === 0" class="text-center">
        Cart masih kosong.
      </div>

      <div v-else class="w-full max-w-5xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
          <div class="lg:col-span-2 space-y-5">
            <div
              v-for="item in cartStore.cartItems"
              :key="item.id"
              class="border border-[#D8C3A5] p-5 rounded-2xl shadow-sm"
            >
              <div class="flex gap-6 items-center">
                <img
                  :src="item.image"
                  :alt="item.name"
                  class="w-36 aspect-square object-cover rounded-xl shrink-0"
                />

                <div class="flex-1">
                  <h2 class="text-xl font-semibold">
                    {{ item.name }}
                  </h2>

                  <p class="mt-2 text-[#6B4F4F]">
                    Harga: Rp {{ item.price.toLocaleString('id-ID') }}
                  </p>

                  <p class="mt-1 text-[#6B4F4F]">
                    Subtotal: Rp {{ (item.price * item.quantity).toLocaleString('id-ID') }}
                  </p>

                  <div class="flex items-center justify-between mt-5">
                    <p class="text-[#6B4F4F]">
                      Jumlah: {{ item.quantity }}
                    </p>

                    <div class="flex items-center gap-4">
                      <button
                        @click="cartStore.decreaseQuantity(item.id)"
                        class="w-9 h-9 rounded-full bg-[#E8D9C8] hover:bg-[#D8C3A5] transition"
                      >
                        -
                      </button>

                      <span class="font-semibold">
                        {{ item.quantity }}
                      </span>

                      <button
                        @click="cartStore.increaseQuantity(item.id)"
                        class="w-9 h-9 rounded-full bg-[#E8D9C8] hover:bg-[#D8C3A5] transition"
                      >
                        +
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <aside class="border border-[#D8C3A5] rounded-2xl p-6 h-fit shadow-sm">
            <h2 class="text-xl font-bold mb-4">
              Order Summary
            </h2>

            <div class="flex justify-between mb-3 text-[#6B4F4F]">
              <span>Total Items</span>
              <span>{{ cartStore.cartCount }}</span>
            </div>

            <div class="flex justify-between text-lg font-bold border-t border-[#D8C3A5] pt-4">
              <span>Total</span>
              <span>Rp {{ cartStore.totalPrice.toLocaleString('id-ID') }}</span>
            </div>

            <RouterLink to="/checkout">
              <button
                class="w-full mt-6 bg-[#9ebcdb] text-white py-3 rounded-lg hover:bg-[#36525d] transition"
              >
                Check Out
              </button>
            </RouterLink>
          </aside>
        </div>
      </div>
    </section>
  </main>
</template>