<template>
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-4">{{resourceName}}</h1>
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
  import Group from '@/components/Group.vue'
  
  export default {
    components: {
      User,
      Group
    },
    setup(){
      
    },
    data() {
    return {
      resources: [],
      resourceName: '',
      resourceComponent: null,
      resourceType: '',
    }
  },
  async fetch() {
    // this.users = await this.$axios.$get('/users');
    // this.groups = await this.$axios.$get('/groups');
    this.fetchResources();
  },
  computed: {
    availableGroups() {
      return this.groups.map(group => group.label);
    },
    filteredUsers() {
      if (this.selectedGroups.length === 0) {
        return this.users;
      }
      return this.users.filter(user => {
        return this.selectedGroups.every(group => user.groups.map(g => g.label).includes(group));
      });
    },
  },
  methods: {
    async fetchResources() {
      if (this.$route.path === '/users') {
        this.resourceName = 'Users';
        this.resourceComponent = User;
        this.resourceType = 'users';
        this.resources = await this.$axios.$get('/users');
      } else {
        this.resourceName = 'Groups';
        this.resourceComponent = Group;
        this.resourceType = 'groups';
        this.resources = await this.$axios.$get('/groups');
      }
    },
  },
}
  </script>