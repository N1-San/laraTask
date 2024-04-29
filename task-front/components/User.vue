<template>
  <div>
    <h1>User List</h1>
    <button @click="showAddUserModal = true">Add User</button>
    <ul>
      <li v-for="user in users" :key="user.id">
        {{ user.username }} - {{ user.mobile }} - {{ user.groups }} - {{ user.createdAt }}
        <button @click="showEditModal(user)">Edit</button>
        <button @click="deleteUser(user.id)">Delete</button>
      </li>
    </ul>
    <!-- Add User Modal -->
    <div v-if="showAddUserModal" class="modal">
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
    </div>
    <!-- Edit User Modal -->
    <div v-if="showEditModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="closeEditModal">&times;</span>
        <h2>Edit User</h2>
        <form @submit.prevent="updateUser">
          <input v-model="editedUser.username" placeholder="Username" />
          <input v-model="editedUser.mobile" placeholder="Mobile" />
          <input v-model="editedUser.groups" placeholder="Groups" />
          <button type="submit">Update User</button>
        </form>
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
      showEditModal: false,
      editedUser: null
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
      this.editedUser = {}
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