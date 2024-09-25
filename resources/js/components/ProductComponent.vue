<template>
  <div class="product-details">
    <h1>{{ product.name }}</h1>
    <img :src="product.images[0]" :alt="product.name" />
    <p>{{ product.description }}</p>
    <p>Price: ${{ product.price }}</p>

    <button @click="addToCart">Add to Cart</button>
  </div>
</template>

<script>
export default {
  props: {
    productId: Number
  },
  data() {
    return {
      product: {}
    };
  },
  mounted() {
    // Fetch the product details from the backend
    axios.get(`/api/products/${this.productId}`)
      .then(response => {
        this.product = response.data;
      })
      .catch(error => {
        console.error("Error fetching product:", error);
      });
  },
  methods: {
    addToCart() {
      axios.post('/api/cart', {  
        product_id: this.product.id,
        product_type: 'electronics', // adjust for your product types
      }).then(() => {
        alert('Product added to cart!');
      }).catch(error => {
        console.error("Error adding to cart:", error);
      });
    }
  }
};
</script>
