// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  modules: [
    "@nuxtjs/tailwindcss",  
  ],
  
});
// module.exports = {
//   server: {
//     port: 8000, // or any other port you prefer
//     host: '127.0.0.1' // For development
//   },
//   proxy: {
//     '/api/': 'http://127.0.0.1:8000/api/users' // Replace with your backend server URL
//   },
//   cors: {
//     origin: 'http://localhost:3000', // Replace with your Nuxt.js app URL
//     methods: 'GET,HEAD,PUT,PATCH,POST,DELETE',
//     allowedHeaders: 'Content-Type,Authorization'
//   }
// }