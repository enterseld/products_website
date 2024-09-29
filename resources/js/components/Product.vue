<template>
    <div>
      <h1>Product Details</h1>
      <div v-if="product">
        <h2>{{ product.name }}</h2>
        <div class="image-gallery">
          <div v-for="(image, index) in product.images" :key="index" class="image-container">
            <img :src="image.picture" alt="Product Image" />
          </div>
        </div>
        <p>{{ product.description_ua }}</p>
        <p>Price: {{ product.price }}{{ product.currency_id }}</p>
        <button @click="addToCart">Add to Cart</button>
      </div>
      <div v-else>
        <p>Loading product details...</p>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted, defineProps } from 'vue';
  import axios from 'axios';
  import { useRoute } from 'vue-router';
  
  // Define props
  const props = defineProps({
    initialVendorCode: String,
    initialCategoryId: String,
  });
  
  // Create a reactive reference for the product
  const product = ref(null);
  const route = useRoute(); // Get route parameters
  
  // Fetch the product based on vendor_code and category_id
  const fetchProduct = async () => {
    const vendor_code = props.initialVendorCode;
    const category_id = props.initialCategoryId;
    try {
      const response = await axios.get(`/api/product/${vendor_code}/${category_id}`);
      product.value = response.data;
      console.log('API Response:', response.data);
    } catch (error) {
      console.error('Error fetching product:', error);
    }
  };
  
  // Add product to cart
  const addToCart = async () => {
    if (!product.value) return; // Ensure product is available
    try {
      const response = await axios.post('/api/cart/add', {
        vendor_code: product.value.vendor_code,
        category_id: route.params.category_id,
      });
      console.log('Product added to cart:', response.data);
    } catch (error) {
      console.error('Error adding product to cart:', error);
    }
  };
  
  // Fetch the product on component mount
  onMounted(() => {
    fetchProduct();
  });
  </script>
  
  <style scoped>
  /* Add your component styles here */
  h1 {
    font-size: 2rem;
    margin-bottom: 1rem;
  }
  .image-gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem; /* Space between images */
  }
  .image-container {
    flex: 1 0 calc(33% - 1rem); /* Responsive image containers */
    max-width: calc(33% - 1rem);
  }
  .image-container img {
    width: 100%;
    border-radius: 8px; /* Optional: add rounded corners to images */
  }
  button {
    background-color: #4CAF50; /* Green */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  button:hover {
    background-color: #45a049;
  }
  </style>
  