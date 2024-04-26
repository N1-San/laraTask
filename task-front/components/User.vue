<template>
  <div>
    <h1>User List</h1>
    <!-- <button @click="showAddUserModal = true">Add User</button> -->
    <!-- <div class="grid grid-cols-4 gap-5">
      <div v-for="u in users">
      <NuxtLink :to="`/products/${u.id}`">{{ u.title }}</NuxtLink>
      </div>
    </div> -->

    <!-- <ul>
      <li v-for="user in users" :key="user.id">
        {{ user.username }} - {{ user.mobile }} - {{ user.groups }} - {{ user.createdAt }}
        <button @click="editUser(user)">Edit</button>
        <button @click="deleteUser(user.id)">Delete</button>
      </li>
    </ul> -->

    <!-- Add User Modal -->
    <!-- <div v-if="showAddUserModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="showAddUserModal = false">&times;</span>
        <h2>Add User</h2>
        <form @submit.prevent="addUser">
          <input v-model="newUser.username" placeholder="Username" />
          <input v-model="newUser.mobile" placeholder="Mobile" />
          <input v-model="newUser.groups" placeholder="Groups" />
          <button type="submit">Add User</button>
        </form>
      </div>
    </div> -->

    <div class="flex justify-between items-center p-4 bg-gray-100 rounded-md">
      <div v-for="u in users">
        <h3 class="text-lg font-semibold">{{ u.username }}</h3>
        <p class="text-sm text-gray-600">Mobile: </p>
        <p class="text-sm text-gray-600">Groups: </p>
        <p class="text-sm text-gray-600">Created at: </p>
      </div>
      <div class="flex space-x-2">
        <NuxtLink :to="`/users/${id}`" class="px-3 py-1 bg-blue-500 text-white rounded-md">Edit</NuxtLink>
        <button class="px-3 py-1 bg-red-500 text-white rounded-md">Delete</button>
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
      }
    }
  },
  mounted() {
    this.fetchUsers()
  },
  methods: {
    async fetchUsers() {
      try {
        // const response = await axios.get('https://fakestoreapi.com/products')
        const response = await axios.get('https://127.0.0.1:8000/api/users')
        this.users = response.data
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
        await axios.delete(`127.0.0.1:8000/api/users/${userId}`)
        this.fetchUsers()
      } catch (error) {
        console.error(error)
      }
    },
    async addUser() {
      try {
        await axios.post('127.0.0.1:8000/api/users', this.newUser)
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
<!-- <script>
export default {
  props: {
    id: {
      type: Number,
      required: true,
    },
    username: {
      type: String,
      required: true,
    },
    mobile: {
      type: String,
      required: true,
    },
    groups: {
      type: Array,
      required: true,
    },
    createdAt: {
      type: String,
      required: true,
    },
  },
}
</script> -->