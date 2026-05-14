<script setup lang="ts">
import {
  MapPin,
  Phone,
  Mail,
  Instagram,
  Facebook,
  ShoppingBag,
  Youtube
} from 'lucide-vue-next'
</script>

<template>
  <footer class="bg-[#B7D4E8] text-[#2D2D2D] w-full mt-20">

    <!-- MAIN -->
    <div class="w-full px-10 py-12">

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-14">

        <!-- BRAND -->
        <div>
          <h2 class="text-2xl font-bold mb-3 text-[#2F1E1B]">
            Winnefly Pastries
          </h2>

          <p class="text-sm leading-7 text-[#4F4F4F] max-w-[280px]">
            Freshly baked pastries, cakes, and desserts crafted with love,
            bringing sweetness to every special moment.
          </p>
        </div>

        <!-- LINKS -->
        <div>
          <h3 class="text-lg font-semibold mb-4 text-[#2F1E1B]">
            Quick Links
          </h3>

          <ul class="space-y-3 text-sm text-[#4F4F4F]">
            <li>
              <RouterLink
                to="/"
                class="hover:text-[#8B5E4E] transition"
              >
                Home
              </RouterLink>
            </li>

            <li>
              <RouterLink
                to="/menu"
                class="hover:text-[#8B5E4E] transition"
              >
                Menu
              </RouterLink>
            </li>

            <li>
              <RouterLink
                to="/about"
                class="hover:text-[#8B5E4E] transition"
              >
                About Us
              </RouterLink>
            </li>

            <li>
              <RouterLink
                to="/contact"
                class="hover:text-[#8B5E4E] transition"
              >
                Contact
              </RouterLink>
            </li>
          </ul>
        </div>

        <!-- CONTACT -->
        <div>
          <h3 class="text-lg font-semibold mb-4 text-[#2F1E1B]">
            Contact
          </h3>

          <ul class="space-y-4 text-sm text-[#4F4F4F]">

            <li class="flex items-center gap-3">
              <MapPin class="w-4 h-4 text-[#8B5E4E]" />
              <span>Yogyakarta, Indonesia</span>
            </li>

            <li class="flex items-center gap-3">
              <Phone class="w-4 h-4 text-[#8B5E4E]" />
              <span>+62 812-3456-7890</span>
            </li>

            <li class="flex items-center gap-3">
              <Mail class="w-4 h-4 text-[#8B5E4E]" />
              <span>hello@winnefly.com</span>
            </li>
          </ul>
        </div>

        <!-- SOCIAL -->
        <div>
          <h3 class="text-lg font-semibold mb-4 text-[#2F1E1B]">
            Follow Us
          </h3>

          <div class="flex gap-3">

            <a
              href="#"
              class="w-10 h-10 rounded-full bg-white/40 flex items-center justify-center hover:bg-white transition shadow-sm"
            >
              <Instagram class="w-4 h-4 text-[#4A2E2B]" />
            </a>

            <a
              href="#"
              class="w-10 h-10 rounded-full bg-white/40 flex items-center justify-center hover:bg-white transition shadow-sm"
            >
              <Facebook class="w-4 h-4 text-[#4A2E2B]" />
            </a>

            <a
              href="#"
              class="w-10 h-10 rounded-full bg-white/40 flex items-center justify-center hover:bg-white transition shadow-sm"
            >
              <ShoppingBag class="w-4 h-4 text-[#4A2E2B]" />
            </a>

            <a
              href="#"
              class="w-10 h-10 rounded-full bg-white/40 flex items-center justify-center hover:bg-white transition shadow-sm"
            >
              <Youtube class="w-4 h-4 text-[#4A2E2B]" />
            </a>

          </div>
        </div>
      </div>

      <!-- COPYRIGHT -->
      <div class="pt-10">
        <p class="text-center text-sm text-[#4F4F4F]">
          © {{ new Date().getFullYear() }} Winnefly Pastries.
          All rights reserved.
        </p>
      </div>

    </div>
  </footer>
</template>