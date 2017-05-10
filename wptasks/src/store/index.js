import Vue from 'vue'
import Vuex from 'vuex'

import * as getters from './getters'
import filter from './modules/filter'
import tasks from './modules/tasks'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  getters,
  modules: {
    filter,
    tasks
  },
  string: debug
})
