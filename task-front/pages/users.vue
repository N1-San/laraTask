<template>
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-4">Users</h1>
      <p>Edit User Route Not Working</p>
      <div class="mb-4">
        <label class="block mb-2 font-semibold" for="group-filter">Filter by Group:</label>
        <select
          id="group-filter"
          v-model="selectedGroups"
          multiple
          class="w-full p-2 border border-gray-300 rounded-md"
        >
          <option v-for="group in availableGroups" :key="group" :value="group">{{ group }}</option>
        </select>
      </div>
      <div class="space-y-4">
        <User
          v-for="user in filteredUsers"
          :key="user.id"
          :id="user.id"
          :username="user.username"
          :mobile="user.mobile"
          :groups="user.groups"
          :createdAt="user.createdAt"
        />
      </div>
      <NuxtLink to="/AddUser" class="fixed bottom-4 right-4 px-4 py-2 bg-green-500 text-white rounded-full">
        Add User
      </NuxtLink>
    </div>
  </template>
  
  <script>
  import User from '@/components/User.vue'
  
  export default {
    components: {
      User,
    },
    data() {
      return {
        users: [
          {
            id: 1,
            username: 'john_doe',
            mobile: '+1234567890',
            groups: ['admin', 'editor'],
            createdAt: '2022-05-01',
          },
          {
            id: 2,
            username: 'jane_smith',
            mobile: '+0987654321',
            groups: ['user'],
            createdAt: '2023-02-15',
          },
          // dummy user data
        ],
        selectedGroups: [],
      }
    },
    computed: {
      availableGroups() {
        const groups = new Set()
        this.users.forEach((user) => {
          user.groups.forEach((group) => groups.add(group))
        })
        return Array.from(groups)
      },
      filteredUsers() {
        if (this.selectedGroups.length === 0) {
          return this.users
        }
        return this.users.filter((user) => {
          return this.selectedGroups.every((group) => user.groups.includes(group))
        })
      },
    },
  }
  </script>