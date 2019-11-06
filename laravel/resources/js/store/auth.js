import { OK, CREATED, UNPROCESSABLE_ENTITY } from '../util';

const state = {
  user: null,
  apiStatus: null,
  loginErrorMessages: null,
  registerErrorMessages: null
};

const getters = {
  isLoggedIn: state => !!state.user,
  username: state => (state.user ? state.user.name : '')
};

const mutations = {
  setUser(state, user) {
    state.user = user;
  },
  setApiStatus(state, status) {
    state.apiStatus = status;
  },
  setLoginErrorMessages(state, messages) {
    state.loginErrorMessages = messages;
  },
  setRegisterErrorMessages(state, messages) {
    state.registerErrorMessages = messages;
  }
};

const actions = {
  async register(context, data) {
    // apiStatus リセット
    context.commit('setApiStatus', null);

    // API 呼び出し
    const response = await axios.post('/api/register', data);

    // 成功
    if (response.status === CREATED) {
      context.commit('setApiStatus', true);
      context.commit('setUser', response.data);
      return false;
    }
    // 失敗
    context.commit('setApiStatus', false);
    if (response.status === UNPROCESSABLE_ENTITY) {
      context.commit('setRegisterErrorMessages', response.data.errors);
    } else {
      context.commit('error/setCode', response.status, { root: true });
    }
  },
  async login(context, data) {
    context.commit('setApiStatus', null);

    const response = await axios.post('/api/login', data);

    if (response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setUser', response.data);
      return false;
    }

    context.commit('setApiStatus', false);
    if (response.status === UNPROCESSABLE_ENTITY) {
      context.commit('setLoginErrorMessages', response.data.errors);
    } else {
      context.commit('error/setCode', response.status, { root: true });
    }
  },
  async logout(context) {
    context.commit('setApiStatus', null);

    const response = await axios.post('/api/logout');

    if (response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setUser', null);
      return false;
    }

    context.commit('setApiStatus', false);
    context.commit('error/setCode', response.status, { root: true });
  },
  async currentUser(context) {
    context.commit('setApiStatus', null);

    const response = await axios.get('/api/me');

    if (response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setUser', response.data || null);
      return false;
    }

    context.commit('setApiStatus', false);
    context.commit('error/setCode', response.status, { root: true });
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
