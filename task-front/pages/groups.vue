<template>
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-4">Groups</h1>
      <div class="space-y-4">
        <Group
          v-for="group in groups"
          :key="group.id"
          :id="group.id"
          :label="group.label"
          :createdAt="group.createdAt"
        />
      </div>
      <NuxtLink to="/AddGroup" class="fixed bottom-4 right-4 px-4 py-2 bg-green-500 text-white rounded-full">
        Add Group
      </NuxtLink>
    </div>
  </template>
  
  <script>
  import Group from '@/components/Group.vue'
  
  export default {
    components: {
      Group,
    },
    data() {
    return {
      groups: [],
    }
  },
  async fetch() {
    this.groups = await this.$axios.$get('/groups');
  },
}
  </script>