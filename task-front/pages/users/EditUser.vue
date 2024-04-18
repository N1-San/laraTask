<template>
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-4">Edit User</h1>
      <form @submit.prevent="updateUser" class="space-y-4">
        <div>
          <label class="block mb-2 font-semibold" for="username">Username:</label>
          <input
            id="username"
            v-model="username"
            type="text"
            class="w-full p-2 border border-gray-300 rounded-md"
            required
          />
        </div>
        <div>
          <label class="block mb-2 font-semibold" for="mobile">Mobile:</label>
          <input
            id="mobile"
            v-model="mobile"
            type="tel"
            class="w-full p-2 border border-gray-300 rounded-md"
            required
          />
        </div>
        <div>
          <label class="block mb-2 font-semibold" for="groups">Groups:</label>
          <select
            id="groups"
            v-model="groups"
            multiple
            class="w-full p-2 border border-gray-300 rounded-md"
            required
          >
            <option v-for="group in availableGroups" :key="group" :value="group">{{ group }}</option>
          </select>
        </div>
        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">Save</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        userId: this.$route.params.id,
        username: '',
        mobile: '',
        groups: [],
        availableGroups: ['admin', 'editor', 'user'],
      }
    },
    mounted() {
      this.fetchUserData()
    },
    methods: {
      fetchUserData() {
        // Find the user data from the users array based on the userId
        const user = this.$parent.users.find(user => user.id === parseInt(this.userId))
  
        if (user) {
          this.username = user.username
          this.mobile = user.mobile
          this.groups = user.groups
        }
      },
      updateUser() {
        // Update User Logic
        this.$router.push('/users')
      },
    },
  }
  </script>