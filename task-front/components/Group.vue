<template>
  <div>
    <h1>User List</h1>
    <button @click="showAddGroupModal = true">Add Group</button>
    <ul>
      <li v-for="group in Groupd" :key="user.id">
        {{ group.id }} - {{ group.label }} - {{ group.createdat }}
        <button @click="editGroup(group)">Edit</button>
        <button @click="deleteGroup(group.id)">Delete</button>
      </li>
    </ul>

    <!-- Add User Modal -->
    <div v-if="showAddGroupModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="showAddGroupModal = false">&times;</span>
        <h2>Add User</h2>
        <form @submit.prevent="addUser">
          <input v-model="newUser.username" placeholder="Username" />
          <input v-model="newUser.mobile" placeholder="Mobile" />
          <input v-model="newUser.groups" placeholder="Groups" />
          <button type="submit">Add User</button>
        </form>
      </div>
    </div>

    <!-- <div class="flex justify-between items-center p-4 bg-gray-100 rounded-md">
      <div v-for="u in users">
        <h3 class="text-lg font-semibold">{{ u.username }}</h3>
        <p class="text-sm text-gray-600">Mobile: {{ u.mobile }}</p>
        <p class="text-sm text-gray-600">Groups: {{ u.groups }}</p>
        <p class="text-sm text-gray-600">Created at: {{ u.created_at }}</p>
      </div>
      <div class="flex space-x-2">
        <NuxtLink :to="`/users/${id}`" class="px-3 py-1 bg-blue-500 text-white rounded-md">Edit</NuxtLink>
        <button class="px-3 py-1 bg-red-500 text-white rounded-md">Delete</button>
      </div>
    </div> -->
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
      newGroup: {
        username: '',
        mobile: '',
        groups: ''
      }
    }
  },
  mounted() {
    this.fetchGroups()
  },
  methods: {
    async fetchGroups() {
      try {
        // const response = await axios.get('https://fakestoreapi.com/products')
        const response = await axios.get('http://127.0.0.1:8000/api/group')
        this.groups = response.data
      } catch (error) {
        console.error(error)
      }
    },
    editUser(groups) {
      // add edit user functionality
      console.log('Edit Group:', group)
    },
    async deleteUser(groupId) {
      try {
        await axios.delete(`127.0.0.1:8000/api/groups/${groupId}`)
        this.fetchGroups()
      } catch (error) {
        console.error(error)
      }
    },
    async addGroup() {
      try {
        await axios.post('http://127.0.0.1:8000/api/groups', this.newGroup)
        this.newGroup = {
          id: '',
          label: '',
          created_at: ''
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