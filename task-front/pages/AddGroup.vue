<template>
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-4">Add Group</h1>
      <form @submit.prevent="saveGroup" class="space-y-4">
        <div>
          <label class="block mb-2 font-semibold" for="label">Group Label:</label>
          <input
            id="label"
            v-model="label"
            type="text"
            class="w-full p-2 border border-gray-300 rounded-md"
            required
          />
        </div>
        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">Save</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        label: '',
      }
    },
    methods: {
    async saveGroup() {
      const newGroup = { label: this.label };
      await this.$axios.$post('/groups', newGroup);
      this.$router.push('/groups');
      },
    },
  }
  </script>