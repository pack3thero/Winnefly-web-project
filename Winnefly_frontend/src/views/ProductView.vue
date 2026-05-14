<script setup lang="ts">
    import  {onMounted} from 'vue';
    import { useProductStore } from '@/productStore';

    const productStore = useProductStore();

    onMounted(() => {
        productStore.fetchProducts()
    });
</script>