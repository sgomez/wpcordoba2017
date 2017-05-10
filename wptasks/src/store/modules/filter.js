import { SET_FILTER, SHOW_ALL } from '../mutation-types'

const state = {
  filter: SHOW_ALL
}

const getters = {
  getActiveFilter: state => state.filter
}

const actions = {
  setFilter ({ commit }, newFilter) {
    commit(SET_FILTER, { newFilter })
  }
}

const mutations = {
  [SET_FILTER] (state, { newFilter }) {
    state.filter = newFilter
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
