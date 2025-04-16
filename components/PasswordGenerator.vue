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

<script setup>
import {useFetch} from "#app";
import { ref } from 'vue'

const password = ref('')
const hashedPW = ref('')
const errorMsg = ref('')
const fetching = ref(false)

const prevent = (event) => {
  event.stopPropagation()
}

const API_URL = 'https://www.james-nock.co.uk/tools/craftcmspwgen.php'

const generateHashedPassword = async (password) => {
  const formData = new FormData()
  formData.append('pw', password)

  const { data, error } = await useFetch(API_URL, {
    method: 'POST',
    body: formData,
  })

  if (error.value) {
    throw error.value
  }

  const res = JSON.parse(data.value)
  
  if (res.error) {
    throw new Error(res.message)
  }

  return res.message
}

const fetch = async () => {
  if (!password.value) {
    errorMsg.value = 'Please enter a password. e.g. password'
    setTimeout(() => {
      errorMsg.value = ''
    }, 5000)
    return
  }

  hashedPW.value = 'Fetching...'
  fetching.value = true
  errorMsg.value = ''

  try {
    hashedPW.value = await generateHashedPassword(password.value)
  } catch (error) {
    hashedPW.value = ''
    errorMsg.value = error.message || 'An error occurred while fetching the password'
  } finally {
    fetching.value = false
  }
}

const copyThis = (event) => {
  const { $bus } = useNuxtApp()
  $bus.emit('copyThis', event.target)
}
</script>
