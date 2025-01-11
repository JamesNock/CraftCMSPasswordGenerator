<template>
  <div>
    <div class="p-4 border border-solid border-2 border-black">
      <p class="text-gray-600">
        Enter the password that you want to use e.g. 'password'.
      </p>
      <form class="my-4 flex">
        <input
          v-model="password"
          required
          class="flex-grow border border-solid border-gray-600 p-2"
          type="text"
          name="password"
        />
        <input
          class="
            flex-1
            bg-pink-600
            border border-solid border-gray-600 border-l-0
            text-white
            p-2
            w-16
            hover:bg-pink-400 hover:text-purple-700
          "
          type="submit"
          value="Gimme!"
          @click.prevent="fetch"
        />
      </form>
      <div v-if="hashedPW" class="bg-yellow-300 p-4" @click="copyThis">
        {{ hashedPW }}
      </div>
      <div v-if="errorMsg" class="bg-red-500 p-4">{{ errorMsg }}</div>
    </div>
    <div v-if="hashedPW && !fetching" class="text-gray-600">
      <h4 class="py-4 text-xl font-semibold tracking-wide">How to use</h4>
      <p>
        Open your `users` table and find the id of the user that you want to
        assign the password to.
      </p>
      <p class="mt-4">
        Either paste the new password into the password column using your GUI or
        run the below:
      </p>
      <p class="mt-4 p-2 font-mono bg-yellow-300" @click="copyThis">
        UPDATE `users`<br />SET password="{{ hashedPW }}"<br />WHERE id=<span
          class="
            px-1
            w-8
            min-w-min
            text-center
            inline-block
            align-middle
            border-solid border-b-2 border-gray-400
          "
          contenteditable="true"
          @click.prevent="prevent"
        ></span
        >;
      </p>
      <p class="mt-4">
        <span class="font-bold">Tip</span>: type in the user ID above and then
        click on the SQL statement to copy it.
      </p>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      password: '',
      hashedPW: '',
      errorMsg: '',
      fetching: false,
    }
  },
  methods: {
    prevent(event) {
      event.stopPropagation()
    },
    async fetch() {
      if (!this.password) {
        this.errorMsg = 'Please enter a password. e.g. password'
        setTimeout(() => {
          this.errorMsg = ''
        }, 5000)
        return
      }
      this.hashedPW = 'Fetching...'
      this.fetching = true
      this.errorMsg = ''
      const formData = new FormData()
      formData.append('pw', this.password)
      await this.$axios({
        method: 'post',
        url: 'tools/craftcmspwgen.php',
        data: formData,
        headers: { 'Content-Type': 'multipart/form-data' },
      })
        .then((res) => {
          if (!res.data.error) {
            this.hashedPW = res.data.message
          } else {
            this.hashedPW = ''
            this.errorMsg = res.data.message
          }
          this.fetching = false
        })
    },
    copyThis(event) {
      this.$nuxt.$emit('copyThis', event.target)
    },
  },
}
</script>
