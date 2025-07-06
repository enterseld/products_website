<template>
    <div class="main-page">
        <h1>Welcome to Our Dropshipping Store</h1>
        
        <div class="product-squares">
            <h2>Products</h2>
            <div v-if="products.length === 0">No products available.</div>
            <div v-else class = "full-squares">
                <div v-for="(productGroup, index) in chunkProducts(products, 4)" :key="index" class="product-square">
                    <div class="product-grid">
                        <div v-for="product in productGroup" :key="product.vendor_code" class="product">
                            <p>{{ product.name_ua }}</p>
                            <div class="image-wrapper">
                                <img v-if="product.images.length > 0" :src="product.images[0].picture" alt="Product image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: []  // Initialize empty product array
        };
    },
    created() {
        this.fetchProducts();  // Fetch products when component is mounted
    },
    methods: {
        fetchProducts() {
            // Make an HTTP request to your Laravel backend to get products
            axios.get('/api/products')
                .then(response => {
                    this.products = response.data;
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                });
        },
        // Helper method to chunk products into groups of 4
        chunkProducts(arr, chunkSize) {
            const chunks = [];
            for (let i = 0; i < arr.length; i += chunkSize) {
                chunks.push(arr.slice(i, chunkSize + i));
            }
            return chunks;
        }
    }
}
</script>

<style scoped>
.main-page {
    text-align: center;
}
.full-squares {
    padding: 20px;
}
.product-squares {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    
    padding: 20px;
}

.product-square {
    display: inline-block;
    border: 1px solid #ddd;
    padding: 10px;
    margin: 20px;
    width: 400px; /* Adjust based on how large you want each square */
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* 2x2 grid inside each square */
    gap: 10px; /* Adjust spacing between products */
}

.product {
    width: 100%; /* Take full width of the grid cell */
    height: 200px; /* Fixed height for uniformity */

    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Space out content vertically */
    text-align: center;
}

.image-wrapper {
    width: 100%; /* Full width of the product card */
    height: 150px; /* Set a fixed height for the image container */
    overflow: hidden; /* Hide overflow */
}

.product img {
     /* Make the image take full width */
    height: 100%; /* Make the image take full height */
    object-fit: cover; /* Maintain aspect ratio while filling the container */
}
</style>