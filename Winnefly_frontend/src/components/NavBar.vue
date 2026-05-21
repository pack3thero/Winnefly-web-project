<script setup lang="ts">
import { useRouter } from 'vue-router'
import { useCartStore } from '@/stores/cartStore'
import { useAuthStore } from '@/stores/authStore'
import { ShoppingCart, UserRound, CakeSlice } from 'lucide-vue-next'

const router = useRouter()
const cartStore = useCartStore()
const authStore = useAuthStore()

async function scrollToSection(id: string) {
  await router.push('/')

  setTimeout(() => {
    const section = document.getElementById(id)

    if (section) {
      section.scrollIntoView({
        behavior: 'smooth',
        block: 'start',
      })
    }
  }, 100)
}
</script>

<template>
  <header class="w-full bg-[#FDF8F0]/95 backdrop-blur border-b border-[#E8DDD0] sticky top-0 z-50">
    <div class="relative w-full px-8 py-3 flex items-center">

      <!-- LEFT : LOGO -->
      <RouterLink to="/" class="flex items-center gap-2 group">
        <div class="w-10 h-10 rounded-full bg-[#4A2E2B] flex items-center justify-center shadow-sm group-hover:scale-105 transition">
          <CakeSlice class="w-5 h-5 text-white" />
        </div>

        <div class="leading-tight">
          <h1 class="text-xl font-bold tracking-wide text-[#4A2E2B]">
            Winnefly Pastries
          </h1>
          <p class="text-xs text-[#9A7B6F] -mt-1">
            Pastries & Dessert
          </p>
        </div>
      </RouterLink>

      <!-- CENTER : NAVBAR -->
      <nav class="absolute left-1/2 -translate-x-1/2 flex items-center gap-10">
        <RouterLink
          to="/"
          class="nav-link"
        >
          Home
        </RouterLink>

        <button
          type="button"
          @click="scrollToSection('our-story')"
          class="nav-link"
        >
          About Us
        </button>

        <button
          type="button"
          @click="scrollToSection('our-products')"
          class="nav-link"
        >
          Menu
        </button>



        <RouterLink
          v-if="!authStore.user"
          to="/login"
          class="nav-link"
        >
          Login
        </RouterLink>
      </nav>

      <!-- RIGHT : CART + PROFILE -->
      <div class="absolute right-8 top-1/2 -translate-y-1/2 flex items-center gap-5">

        <RouterLink to="/cart" class="relative">
          <ShoppingCart class="w-5 h-5 text-[#4A2E2B] hover:text-[#C58C6D] transition" />

          <span
            v-if="cartStore.cartCount > 0"
            class="absolute -top-2 -right-2 min-w-[18px] h-[18px] px-1 rounded-full bg-red-500 text-white text-[10px] flex items-center justify-center font-semibold"
          >
            {{ cartStore.cartCount }}
          </span>
        </RouterLink>

        <RouterLink
          v-if="authStore.user"
          to="/profile"
          class="flex items-center gap-2 hover:opacity-80 transition"
        >
          <div
            class="w-9 h-9 rounded-full bg-gray-300 overflow-hidden flex items-center justify-center shadow-sm"
          >
            <img
              v-if="authStore.user?.avatar"
              :src="authStore.user.avatar"
              class="w-full h-full object-cover"
            />

            <UserRound
              v-else
              class="w-4 h-4 text-white"
            />
          </div>

          <div class="hidden md:block">
            <p class="text-[11px] text-[#8D6E63] leading-none">
              Welcome
            </p>
            <p class="text-sm font-semibold text-[#4A2E2B]">
              {{ authStore.user.name }}
            </p>
          </div>
        </RouterLink>
      </div>

    </div>
  </header>
</template>

<style scoped>
.nav-link {
  position: relative;
  font-size: 0.875rem;
  font-weight: 500;
  color: #4A2E2B;
  transition: color 0.3s ease, transform 0.3s ease;
}

.nav-link:hover {
  color: #C58C6D;
  transform: translateY(-2px);
}

.nav-link {
  position: relative;
  font-size: 0.875rem;
  font-weight: 500;
  color: #4A2E2B;
  transition: color 0.3s ease, transform 0.3s ease;
  background: transparent;
  border: none;
  cursor: pointer;
  padding: 0;
}

.nav-link:hover::after {
  width: 100%;
}
</style>