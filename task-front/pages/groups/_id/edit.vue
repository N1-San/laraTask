<template>
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-4">Edit Group</h1>
      <form @submit.prevent="updateGroup" class="space-y-4">
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
        groupId: this.$route.params.id,
        label: '',
      }
    },
    mounted() {
      this.fetchGroupData()
    },
    methods: {
      fetchGroupData() {
        // Find the group data from the groups array based on the groupId
        const group = this.$parent.groups.find(group => group.id === parseInt(this.groupId))
  
        if (group) {
          this.label = group.label
        }
      },
      updateGroup() {
        // Update Logic
        this.$router.push('/groups')
      },
    },
  }
  </script>