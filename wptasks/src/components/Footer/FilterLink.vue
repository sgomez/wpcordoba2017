<template>
  <a :class="classes" @click="handleClick">
    {{ statusTitle }}
  </a>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex'
  import { SHOW_ALL, SHOW_ACTIVE, SHOW_COMPLETED } from '../../store/mutation-types'

  const FILTER_TITLES = {
    [SHOW_ALL]: 'All',
    [SHOW_ACTIVE]: 'Active',
    [SHOW_COMPLETED]: 'Completed'
  }

  export default {
    computed: {
      ...mapGetters([
        'getActiveFilter'
      ]),

      classes: function () {
        return {
          selected: this.getActiveFilter === this.filter
        }
      },

      statusTitle: function () {
        return FILTER_TITLES[this.filter]
      }
    },

    methods: {
      ...mapActions([
        'setFilter'
      ]),

      handleClick: function (e) {
        this.setFilter(this.filter)
      }
    },

    props: {
      filter: String,
      selected: Boolean
    }
  }
</script>

<style scoped>
  a { cursor: pointer; }
</style>
