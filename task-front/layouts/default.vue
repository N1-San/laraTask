<template>
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8" src="https://laracasts.com/images/logo/logo-triangle.svg"
                                alt="Your Company">
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <li>
                                    <NuxtLink to="/"
                                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                                        Home</NuxtLink>
                                </li>
                                <li>
                                    <NuxtLink to="/users"
                                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                                        User</NuxtLink>
                                </li>
                                <li>
                                    <NuxtLink to="/groups"
                                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                                        Group</NuxtLink>
                                </li>
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="container mx-auto p-4">
                    <slot />
                </div>
            </div>
        </main>
    </div>
</template>
<style scoped>
.router-link-exact-active{
    color: #12b488;
    background: #43415e;
}
</style>