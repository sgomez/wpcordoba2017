<template>
  <footer class="footer" v-if="listedCount > 0">
    <todo-count></todo-count>
    <ul class="filters">
      <li v-for="filter in filters" :key="filter">
        <filter-link :filter="filter" ></filter-link>
      </li>
    </ul>
    <clear-button v-if="completedCount"></clear-button>
  </footer>
</template>

<script>
  import { mapGetters } from 'vuex'

  import ClearButton from './ClearButton.vue'
  import FilterLink from './FilterLink.vue'
  import TodoCount from './TodoCount.vue'

  import { SHOW_ALL, SHOW_COMPLETED, SHOW_ACTIVE } from '../../store/mutation-types'

  export default {
    components: {
      ClearButton,
      FilterLink,
      TodoCount
    },

    computed: {
      filters: function () {
        return [ SHOW_ALL, SHOW_ACTIVE, SHOW_COMPLETED ]
      },

      ...mapGetters([
        'completedCount',
        'listedCount'
      ])
    }
  }
</script>
