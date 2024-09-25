import { createApp } from 'vue';
import ProductComponent from './components/ProductComponent.vue';

// Create a Vue app instance
const app = createApp({});
app.component('product-component', ProductComponent);
app.mount('#app');