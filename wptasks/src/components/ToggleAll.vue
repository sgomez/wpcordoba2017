<template>
  <span v-if="listedCount">
    <input
       type="checkbox"
       class="toggle-all"
       :checked="completedCount === listedCount"
    />
    <label @click="handleChange" for="toggle-all">Mark all as complete</label>
  </span>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'completedCount',
        'listedCount'
      ])
    },
    methods: {
      ...mapActions([
        'completeAll'
      ]),

      handleChange: function (e) {
        this.completeAll()
      }
    }
  }
</script>
