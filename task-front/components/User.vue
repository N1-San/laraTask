<template>
    <div class="flex justify-between items-center p-4 bg-gray-100 rounded-md">
      <div>
        <h3 class="text-lg font-semibold">{{ username }}</h3>
        <p class="text-sm text-gray-600">Mobile: {{ mobile }}</p>
        <p class="text-sm text-gray-600">Groups: {{ groups.join(', ') }}</p>
        <p class="text-sm text-gray-600">Created at: {{ createdAt }}</p>
      </div>
      <div class="flex space-x-2">
        <NuxtLink :to="`/users/edit/${id}`" class="px-3 py-1 bg-blue-500 text-white rounded-md">Edit</NuxtLink>
        <button class="px-3 py-1 bg-red-500 text-white rounded-md">Delete</button>
      </div>
    </div>
  </template>
  
  <script>
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
  </script>