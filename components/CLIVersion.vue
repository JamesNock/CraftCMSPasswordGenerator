<template>
  <div class="p-4 border border-solid border-2 border-black">
    <h3 class="text-2xl font-semibold tracking-wide">CLI Version</h3>
    <p class="py-2">Prefer to do these things via CLI instead?</p>
    <p>Run the following in your terminal (click to copy):</p>
    <div class="mt-4 p-2 font-mono bg-yellow-300" @click="copyThis">
      cd ~<br>
      curl -O https://craftcmspwgen.james-nock.co.uk/craftcmspwgen.php<br>
      echo 'alias craftpwgen="php ~/craftcmspwgen.php"' >> ~/.bash_profile
    </div>
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
