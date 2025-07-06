<template>
  <div class="catalog-page">
    <h1>Product Catalog</h1>
    <div v-if="products.length === 0">No products available.</div>
    
    <!-- Product Cards Section -->
    <div class="product-grid">
      <div v-for="product in products" :key="product.vendor_code" class="product-card">
        <!-- Link to product details page -->
        <a :href="`/product/${product.vendor_code}/${product.category_id}`">
          <p>{{ product.name_ua }}</p>
          <img v-if="product.images.length > 0" :src="product.images[0].picture" alt="Product image" />
        </a>
      </div>
    </div>

    <!-- Pagination Controls -->
    <Pagination v-slot="{ page }" :total="totalProducts" :sibling-count="1" show-edges :default-page="currentPage" @update:page="fetchProducts">
      <PaginationList v-slot="{ items }" class="flex items-center gap-1 pagination">
        <PaginationFirst />
        <PaginationPrev />
  
        <template v-for="(item, index) in items" :key="index">
          <PaginationListItem v-if="item.type === 'page'" :value="item.value" as-child>
            <Button 
              class="button w-10 h-10 p-0" 
              :class="{ 'default': item.value === page, 'outline': item.value !== page }"
              :variant="item.value === page ? 'default' : 'outline'"
              @click="fetchProducts(item.value)"
            >
              {{ item.value }}
            </Button>
          </PaginationListItem>
          <PaginationEllipsis v-else :index="index" class="ellipsis" />
        </template>
  
        <PaginationNext />
        <PaginationLast />
      </PaginationList>
    </Pagination>
  </div>
</template>

<script setup lang="ts">
import axios from 'axios';
import {
  Pagination,
  PaginationEllipsis,
  PaginationFirst,
  PaginationLast,
  PaginationList,
  PaginationListItem,
  PaginationNext,
  PaginationPrev,
} from '@/components/ui/pagination';

import { Button } from '@/components/ui/button';
import { ref, onMounted } from 'vue';

// State management
const products = ref([]);
const totalProducts = ref(0);
const currentPage = ref(1);

// Fetch products from the Laravel API
const fetchProducts = async (page = 1) => {
  try {
    const response = await axios.get(`/api/catalog?page=${page}`);
    console.log('API Response:', response.data);
    products.value = response.data.data;
    totalProducts.value = response.data.last_page*10; // Adjusted to use total instead of last_page * 10
    currentPage.value = response.data.current_page;
  } catch (error) {
    console.error('Error fetching products:', error);
  }
};

// Fetch initial products when component is mounted
onMounted(() => {
  fetchProducts();
});
</script>

<style scoped>
.catalog-page {
  text-align: center;
  margin-bottom: 2rem;
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
  margin-bottom: 2rem;
}

.product-card {
  border: 1px solid #ddd;
  padding: 1rem;
  text-align: center;
}

.product-card img {
  max-width: 100%;
  height: 150px;
  object-fit: cover; /* Ensure the image fits properly */
}

.product-card p {
  font-weight: bold;
  margin-top: 1rem;
}

/* Pagination styles */
.pagination {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem;
}

/* Button styles */
.button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem; /* Rounded corners */
  font-weight: 600;
  text-align: center;
  cursor: pointer;
  transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}

.button.default {
  background-color: #007bff; /* Primary color */
  color: white;
  border: none; /* No border for default button */
}

.button.default:hover {
  background-color: #0056b3; /* Darker shade on hover */
}

.button.outline {
  background-color: white; /* White background */
  color: #007bff; /* Primary text color */
  border: 1px solid #007bff; /* Border color */
}

.button.outline:hover {
  background-color: #e7f0ff; /* Light blue on hover */
  border-color: #0056b3; /* Darker border on hover */
}

.button:disabled {
  background-color: #f0f0f0; /* Light gray background for disabled state */
  color: #a0a0a0; /* Gray text color */
  border: none; /* No border for disabled button */
  cursor: not-allowed; /* Change cursor for disabled state */
}

/* Ellipsis styles */
.ellipsis {
  margin: 0 0.5rem;
  font-weight: bold;
  color: #666; /* Gray color for ellipsis */
}
.product-card a {
  color: inherit; /* Makes the link inherit the color from the parent */
  text-decoration: none; /* Removes the underline */
  display: block; /* Ensures the entire card is clickable */
}

.product-card a:hover {
  color: #007bff; /* Change color on hover (optional) */
}

</style>
