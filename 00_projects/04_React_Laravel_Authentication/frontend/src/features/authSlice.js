import { createSlice } from '@reduxjs/toolkit'

const initialState = {
  token: localStorage.getItem('token') || ''
}

export const authSlice = createSlice({
  name: 'auth',
  initialState: initialState,
  reducers: {
    setUserToken: (state, action) => {
      state.token = action.payload;
      localStorage.setItem('token', action.payload);
    },
    unsetUserToken: (state, action) => {
      state.token = '';
      localStorage.removeItem('token');
    },

  },
})

export const { setUserToken, unsetUserToken } = authSlice.actions

export default authSlice.reducer