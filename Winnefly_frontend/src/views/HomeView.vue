<script setup lang="ts">
import NavBar from '@/components/NavBar.vue';
import TheWelcome from '../components/TheWelcome.vue'
import ProductView from './products/ProductView.vue';
import CoverPage from '@/components/CoverPage.vue';
import ProductSection from '@/components/products/ProductSection.vue';
import { useProductStore } from '@/productStore';
import FooterWeb from '@/components/FooterWeb.vue';

const productStore = useProductStore()
</script>

<template>
  <main>
    <CoverPage />
    <ProductSection />
  </main>
</template>
