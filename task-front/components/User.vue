<template>
  <div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-4">User List</h1>
    <div class="mb-4">
      <label for="filter-groups" class="block font-medium mb-2">Filter by groups:</label>
      <select id="filter-groups" v-model="filterGroups" multiple
        class="w-full border border-gray-300 rounded-md px-3 py-2">
        <option v-for="group in availableGroups" :key="group" :value="group">{{ group }}</option>
      </select>
    </div class="mb-4">
    <button @click="showAddUserModal = true"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add User</button>
    <ul>
      <li v-for="user in filteredUsers" :key="user.id" class="bg-white shadow-md rounded-md p-4 mb-4">
        <div class="flex justify-between items-center">
          <div>
            <h3 class="text-lg font-semibold">{{ user.username }}</h3>
            <p class="text-sm text-gray-600">Mobile: {{ user.mobile }}</p>
            <p class="text-sm text-gray-600">Groups: {{ user.groups }}</p>
            <p class="text-sm text-gray-600">Created at: {{ user.created_at }}</p>
          </div>
          <div class="flex space-x-2">
            <button @click="showEditModal(user)"
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
            <button @click="deleteUser(user.id)"
              class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
          </div>
        </div>
      </li>
    </ul>
    <!-- Add User Modal -->
    <div v-if="showAddUserModal" class="fixed z-10 inset-0 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Add User</h2>
            <span class="close" @click="showAddUserModal = false">
              <svg class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </span>
          </div>
          <form @submit.prevent="addUser">
            <div class="mb-4">
              <label for="username" class="block font-medium mb-2">Username</label>
              <input v-model="newUser.username" id="username" placeholder="Username"
                class="w-full border border-gray-300 rounded-md px-3 py-2" />
            </div>
            <div class="mb-4">
              <label for="mobile" class="block font-medium mb-2">Mobile</label>
              <input v-model="newUser.mobile" id="mobile" placeholder="Mobile"
                class="w-full border border-gray-300 rounded-md px-3 py-2" />
            </div>
            <div class="mb-4">
              <label for="groups" class="block font-medium mb-2">Groups</label>
              <input v-model="newUser.groups" id="groups" placeholder="Groups"
                class="w-full border border-gray-300 rounded-md px-3 py-2" />
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
              User</button>
          </form>
        </div>
      </div>
    </div>
    <!-- Edit User Modal -->
    <div v-if="editedUser !== null" class="fixed z-10 inset-0 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Edit User</h2>
            <span class="close" @click="closeEditModal">
              <svg class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </span>
          </div>
          <form @submit.prevent="updateUser">
            <div class="mb-4">
              <label for="username" class="block font-medium mb-2">Username</label>
              <input v-model="editedUser.username" id="username" placeholder="Username"
                class="w-full border border-gray-300 rounded-md px-3 py-2" />
            </div>
            <div class="mb-4">
              <label for="mobile" class="block font-medium mb-2">Mobile</label>
              <input v-model="editedUser.mobile" id="mobile" placeholder="Mobile"
                class="w-full border border-gray-300 rounded-md px-3 py-2" />
            </div>
            <div class="mb-4">
              <label for="groups" class="block font-medium mb-2">Groups</label>
              <input v-model="editedUser.groups" id="groups" placeholder="Groups"
                class="w-full border border-gray-300 rounded-md px-3 py-2" />
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update
              User</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

// const { data: users } = await useFetch('127.0.0.1:8000/api/users')

export default {
  data() {
    return {
      users: [],
      showAddUserModal: false,
      newUser: {
        username: '',
        mobile: '',
        groups: ''
      },
      // showEditModal: false,
      editedUser: null,
      filterGroups: []
    }
  },
  computed: {
    filteredUsers() {
      let filteredUsers = this.users;

      if (this.filterGroups.length > 0) {
        filteredUsers = this.users.filter(user => {
          const userGroups = Array.isArray(user.groups) ? user.groups : user.groups.split(',');
          return userGroups.some(group => this.filterGroups.includes(group));
        });
      }

      return filteredUsers;
    },
    availableGroups() {
      const allGroups = new Set(this.users.flatMap(user => {
        const userGroups = Array.isArray(user.groups) ? user.groups : user.groups.split(',');
        return userGroups;
      }));
      return Array.from(allGroups);
    }
  },
  mounted() {
    this.fetchUsers()
  },
  methods: {
    async fetchUsers() {
      try {
        // const response = await axios.get('https://fakestoreapi.com/products')
        const response = await axios.get('http://127.0.0.1:8000/api/users')
        this.users = response.data
      } catch (error) {
        console.error(error)
      }
    },
    showEditModal(user) {
      console.log('showEditModal called with:', user);
      if (user) {
        this.editedUser = { ...user }
        this.showEditModal = true
      }
    },
    closeEditModal() {
      this.showEditModal = false
      this.editedUser = null
    },
    async updateUser() {
      try {
        await axios.put(`http://127.0.0.1:8000/api/users/${this.editedUser.id}`, this.editedUser)
        this.closeEditModal()
        this.fetchUsers()
      } catch (error) {
        console.error(error)
      }
    },
    editUser(user) {
      // add edit user functionality
      console.log('Edit user:', user)
    },
    async deleteUser(userId) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/users/delete/${userId}`);
        this.fetchUsers()
      } catch (error) {
        console.error(error)
      }
    },
    async addUser() {
      try {
        await axios.post('http://127.0.0.1:8000/api/usersAdd', this.newUser)
        this.newUser = {
          username: '',
          mobile: '',
          groups: ''
        }
        this.showAddUserModal = false
        this.fetchUsers()
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>