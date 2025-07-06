import { createApp } from 'vue'; // Make sure Vue is imported
import MainPage from './components/Home.vue'; 
import Catalog from './components/Catalog.vue'; 
import Product from './components/Product.vue'; 

const app = createApp({}); // Create the Vue instance
app.component('main-page', MainPage); // Registering MainPage component
app.component('catalog', Catalog);    // Registering Catalog component
app.component('product', Product);    // Registering Catalog component

app.mount('#app'); // Mount the Vue app to the div with id "app"
