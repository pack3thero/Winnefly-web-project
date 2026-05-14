<script setup lang="ts">
import Navbar from '@/components/NavBar.vue';
import FooterWeb from '@/components/FooterWeb.vue';
</script>

<template>
    <div class="min-h-screen flex flex-col bg-[#FDF8F0]">
        <Navbar />

        <main class="flex-1">
            <RouterView />
        </main>

        <FooterWeb />
    </div>
</template>