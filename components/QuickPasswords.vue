<template>
  <div class="p-4 border border-solid border-2 border-black">
    <h3 class="text-2xl font-semibold tracking-wide">Quick Passwords</h3>
    <table class="mt-4">
      <thead class="border-solid border-b-2 border-gray-300">
        <tr>
          <th class="px-4 py-2 border-r-2 border-gray-300">Password</th>
          <th class="px-4 py-2">Hashed Password</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-solid border-b border-gray-200">
          <td class="px-4 py-2 border-r-2 border-gray-300">password</td>
          <td class="px-4 py-2">
            <span class="px-2 py-1" @click="copyThis"
              >$2y$13$U/SK/GrCZH7qXHY8zztwTOE.Qrsj9BK8X72VwN7B6PK0fJAitQ5au</span
            >
          </td>
        </tr>
        <tr class="border-solid border-b border-gray-200">
          <td class="px-4 py-2 border-r-2 border-gray-300">admin</td>
          <td class="px-4 py-2">
            <span class="px-2 py-1" @click="copyThis"
              >$2y$13$QGycz2JvSXek1U4tkcQYr.NZR.hzGtWs1phfajD32u6BxaCjIkV5C</span
            >
          </td>
        </tr>
        <tr class="border-solid border-b border-gray-200">
          <td class="px-4 py-2 border-r-2 border-gray-300">user</td>
          <td class="px-4 py-2">
            <span class="px-2 py-1" @click="copyThis"
              >$2y$13$dKONpx.zD5A5lfKVcbIq6.2CTuHRgjPPibdEOMF8VK3J/StMApOEm</span
            >
          </td>
        </tr>
        <tr>
          <td class="px-4 py-2 border-r-2 border-gray-300">craftcms</td>
          <td class="px-4 py-2">
            <span class="px-2 py-1" @click="copyThis"
              >$2y$13$.2X4qOW5C099t7hBqiVydOJsO.JmyDeRLdgdEIxf3qnHK5dMywsiW</span
            >
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  data() {
    return {
      // any component data
    }
  },
  methods: {
    copyThis(event) {
      this.$nuxt.$emit('copyThis', event.target)
    },
  },
}
</script>
